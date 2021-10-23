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
use App\Model\Table\IssuesTable;
use App\Model\Table\UsersTable;

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
        $dataClients = [
            "cuit" => $dataVue["cuit"],
            "denominacion" => $dataVue["denominacion"],
            "direccion" => $dataVue["direccion"],
            "email" => $dataVue["email"],
            "password" => "123",
            "usuario" => "prueba",
            "telefono" => $dataVue["telefono"],
        ];

        $client = $classClients->patchEntity($client, $dataClients);

        $resultUser = $classClients->save($client);
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

                if ($resultBill !== false) {
                    $report = $this->Reports->newEmptyEntity();

                    $dataInforme = [
                        "employee_id" => (int)$dataVue["user_id_loggin"],
                        "state_id" => 1,
                        "product_id" => $idProduct,
                        "bill_id" => $idBill,
                    ];

                    $report = $this->Reports->patchEntity($report, $dataInforme);
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

                        if ($resultIssue !== false) {
                            return $this->setJsonResponse(
                                [
                                    'success' => true,
                                    'url' => '/reports',
                                    'message' => __('The post has been saved.'),
                                ],
                                201
                            );
                        }
                    }
                }
            }
        }
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
}