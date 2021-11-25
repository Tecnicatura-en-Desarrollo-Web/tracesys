<?php

declare(strict_types=1);

namespace App\Controller\Api;

use App\Controller\AppController;
use App\Controller\Traits\ResponseTrait;
use App\Model\Entity\Employee;
use App\Model\Entity\Product;
use App\Model\Table\BillsTable;
use App\Model\Table\BillTable;
use App\Model\Table\EmployeeTable;
use App\Model\Table\ProductsTable;
use App\Model\Table\StateTable;
use App\Model\Table\ClientsTable;
use App\Model\Table\EmployeesTable;
use App\Model\Table\InformeempleadoestadosTable;
use App\Model\Table\IssuesTable;
use App\Model\Table\UsersTable;
use Cake\Mailer\Mailer;

/**
 * Reports Controller
 *
 * @property \App\Model\Table\ReportsTable $Reports
 * @method \App\Model\Entity\Report[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ReportsController extends AppController
{
    use ResponseTrait;

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Employees', 'States', 'Products', 'Bills'],
        ];
        $reports['reports'] = $this->paginate($this->Reports);
        return $this->setJsonResponse($reports);

        /* $this->paginate = [
            'contain' => ['Employees.Users','Reports.Products','States'],
            'conditions'=>['informeempleadoestados_id' => $id]
        ];
        $cambiosEstadoInforme['cambiosEstadoInforme'] = $this->paginate($this->Informeempleadoestados);
        return $this->setJsonResponse($cambiosEstadoInforme); */
    }

    /**
     * View method
     *
     * @param string|null $id Report id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $report = $this->Reports->get($id, [
            'contain' => ['Employees', 'States', 'Products.Clients', 'Bills', 'Employees.Users'],
        ]);
        $motivo = $this->Reports->get($report[0]['id_producto'])['motivo'];

        //****Usuario encargado y usuarios a derivar*****/
        // $objUser=new UsersTable();
        // $userEncargado=$objUser
        //     ->find()
        //     ->where(['user_id =' => $report['employee_id']])
        //     ->first();
        // $usersDerivar=$objUser
        //     ->find();

        // $report['userEncargado']=$userEncargado;
        // $report['usersDerivar']=$usersDerivar;
        /************************************************/

        return $this->setJsonResponse(['report' => $report]);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        if (!$this->request->is('post')) {
            return $this->setJsonResponse([
                'error' => true,
                'message' => 'Invalid request!',
            ]);
        }

        $dataVue =  $this->request->getData();

        $classClients = new ClientsTable();
        $client = $classClients->newEmptyEntity();
        $cuentaCliente = $this->crearCuentaCliente($dataVue["denominacion"], $dataVue["cuit"]);
        $dataClients = [
            "cuit" => $dataVue["cuit"],
            "denominacion" => $dataVue["denominacion"],
            "domicilio" => $dataVue["direccion"],
            "email" => $dataVue["email"],
            "password" => $cuentaCliente["password"],
            "usuario" => $cuentaCliente["usuario"],
            "telefono" =>  $dataVue["codigo_pais"] . $dataVue["codigo_area"] . $dataVue["telefono"],
        ];
        $client = $classClients->patchEntity($client, $dataClients);

        $resultUser = $classClients->save($client);

        $this->envioEmail($resultUser["usuario"], $resultUser["password"], $dataVue["email"]);
        $idCliente = $resultUser["client_id"];


        if ($resultUser !== false) {

            $classProduct = new ProductsTable();
            $product = $classProduct->newEmptyEntity();
            $dataProduct = [
                "tipo" => $dataVue["tipo"],
                "modelo" => $dataVue["modelo"],
                "marca" => $dataVue["marca"],
                "motivo" => $dataVue["motivo"],
                "prioridad" => $dataVue["prioridad"],
                "descripcion" => $dataVue["descripcion"],
                "client_id" => $idCliente,
            ];

            $product = $classProduct->patchEntity($product, $dataProduct);

            $resultProduct = $classProduct->save($product);

            $idProduct = $resultProduct["product_id"];

            if ($resultProduct !== false) {

                $classBill = new BillsTable();
                $bill = $classBill->newEmptyEntity();
                $dataBill = [
                    "descripcion" => "Factura generada",
                    "monto" => 0,
                    "url_factura" => "/facturas",
                ];

                $bill = $classBill->patchEntity($bill, $dataBill);
                $resultBill = $classBill->save($bill);
                $idBill = $resultBill["bill_id"];
                $idEmpleado = (int)$dataVue["user_id_loggin"];
                if ($resultBill !== false) {
                    $report = $this->Reports->newEmptyEntity();

                    $dataInforme = [
                        "employee_id" => $idEmpleado,
                        "state_id" => 2,
                        "product_id" => $idProduct,
                        "bill_id" => $idBill,
                    ];

                    $report = $this->Reports->patchEntity($report, $dataInforme, [
                        'contain' => ["Employees"]
                    ]);
                    $resultReport = $this->Reports->save($report);
                    $idReport = $resultReport["report_id"];

                    if ($resultReport !== false) {

                        $classIssue = new IssuesTable();
                        $issue = $classIssue->newEmptyEntity();

                        $dataIssue = [
                            "titulo" => $dataVue["motivo"],
                            "descripcion" => $dataVue["descripcion"],
                            "report_id" => $idReport,
                        ];

                        $issue = $classIssue->patchEntity($issue, $dataIssue);
                        $resultIssue = $classIssue->save($issue);

                        $classEmployee = new EmployeesTable();
                        //$empleado=$classEmployee->find('all' , ['conditions' => ["employee_id"=>$idEmpleado]]);
                        $empleado = $classEmployee->get(
                            $idEmpleado,
                            [
                                'conditions' => ["employee_id" => $idEmpleado],
                            ]
                        );

                        if ($resultIssue !== false) {
                            return $this->setJsonResponse(
                                [
                                    'idReporte' => $idReport,
                                    'idEmpleado' => $idEmpleado,
                                    'idEstado' => 2,
                                    'cuitEmpleado' => $empleado->cuit,
                                ],
                            );
                        }
                    }
                }
            }
        }
    }
    public function crearCuentaCliente($nombreCliente, $cuitCliente)
    {
        $arrayNombre = explode(" ", strtolower($nombreCliente));
        $nombreUsuario = "";
        if ($arrayNombre != null) {
            $mitadPalabra = strlen($arrayNombre[0]) / 2;
            $parte1Palabra = substr($arrayNombre[0], 0, intval($mitadPalabra));
            $nombreUsuario .= $parte1Palabra;
        }
        if (count($arrayNombre) > 1) {
            $mitadPalabra = strlen($arrayNombre[1]) / 2;
            $parte1Palabra = substr($arrayNombre[1], 0, intval($mitadPalabra));
            $nombreUsuario .= $parte1Palabra;
        }
        $arrayPassword = explode("-", $cuitCliente);
        $nombreUsuario .= substr($arrayPassword[1], 0, 2);;
        $cuentaUsuario["usuario"] = $nombreUsuario;
        $cuentaUsuario["password"] = $arrayPassword[1];

        return $cuentaUsuario;
    }
    public function envioEmail($user, $pass, $email)
    {

        $mailer = new Mailer();
        $mailer->setTransport('gmail');
        $mailer
            ->setEmailFormat('html')
            ->setTo($email)
            ->setFrom(['tracesysapp@gmail.com' => 'Tracesys'])
            ->setSubject('Usuario para utilizar la app Tracesys')

            ->deliver('
                            <table>
                            <tr>
                            <img src="https://i.ibb.co/jZcV0Lb/logo-Tracesysy-Chiquito.png" alt="Logo del sistema" />
                                    <hr>
                                    <p>Se le envia este email para notificarle que ya tiene disponible su cuenta para utilizar nuestra app de Tracesys
                                    <hr>
                                    <b>Usuario:</b> "' . $user . '"
                                    <b>Contraseña:</b> "' . $pass . '"
                                     </p>
                            </tr>
                            </table>
                    ');


        $mailer->deliver();
    }
    /**
     * Edit method
     *
     * @param string|null $id Report id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $report = $this->Reports->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $report = $this->Reports->patchEntity($report, $this->request->getData());
            if ($this->Reports->save($report)) {
                $this->Flash->success(__('The report has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The report could not be saved. Please, try again.'));
        }
        $employees = $this->Reports->Employees->find('list', ['limit' => 200]);
        $states = $this->Reports->States->find('list', ['limit' => 200]);
        $products = $this->Reports->Products->find('list', ['limit' => 200]);
        $bills = $this->Reports->Bills->find('list', ['limit' => 200]);
        $this->set(compact('report', 'employees', 'states', 'products', 'bills'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Report id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $report = $this->Reports->get($id);
        if ($this->Reports->delete($report)) {
            $this->Flash->success(__('The report has been deleted.'));
        } else {
            $this->Flash->error(__('The report could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function obtenerCliente($id)
    {
        $report = $this->Reports->get($id, [
            'contain' => ['Products.Clients'],
        ]);

        return $this->setJsonResponse(
            [
                'client' => $report["product"]["client"],
            ],
        );
    }
}