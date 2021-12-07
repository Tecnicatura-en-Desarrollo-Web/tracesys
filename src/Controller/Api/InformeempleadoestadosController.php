<?php

declare(strict_types=1);

namespace App\Controller\Api;

use App\Controller\AppController;
use App\Controller\Traits\ResponseTrait;
use App\Model\Entity\Informeempleadocomentario;
use App\Model\Table\InformeempleadocomentariosTable;
use App\Model\Table\SectorsTable;
use App\Test\TestCase\Controller\InformeEmpleadoComentarioControllerTest;
use App\Test\TestCase\Model\Table\InformeEmpleadoComentarioTableTest;
use App\Model\Table\ReportsTable;
use Cake\Mailer\Mailer;

/**
 * Informeempleadoestados Controller
 *
 * @property \App\Model\Table\InformeempleadoestadosTable $Informeempleadoestados
 * @method \App\Model\Entity\Informeempleadoestado[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class InformeempleadoestadosController extends AppController
{

    use ResponseTrait;
    public function initialize(): void
    {
        parent::initialize();

        $this->viewBuilder()->setLayout('');
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Employees.Users.Sectors.Stages', 'States', 'Reports', 'Reports.Products', 'Sectors'],
            'conditions' => ['ultimoEstado' => 1]
        ];
        $informeempleadoestados['reports'] = $this->paginate($this->Informeempleadoestados);
        foreach ($informeempleadoestados['reports'] as $cambioEstadoInforme) {
            $datetime = $cambioEstadoInforme->created;
            $phpdate = strtotime((string)$datetime);
            if ($phpdate == false) {
                $phpdate = 12;
            }
            $cambioEstadoInforme->{"fecha"} = date('d-m-y', $phpdate);
            $cambioEstadoInforme->{"fechaConDia"} = date('D-m-y', $phpdate);
            $cambioEstadoInforme->{"hora"} = date('H:i:s', $phpdate);
        }


        return $this->setJsonResponse($informeempleadoestados);
    }
    public function obtenerInformesDerivados($idEmpleado)
    {
        $this->paginate = [
            'contain' => ['Employees.Users.Sectors.Stages', 'States', 'Reports', 'Reports.Products', 'Sectors'],
            'conditions' => ['Employees.employee_id' => $idEmpleado]
        ];
        $objInformeEmpleadoComentarios = new InformeempleadocomentariosTable();
        $informeempleadoestados = $this->paginate($this->Informeempleadoestados);
        foreach ($informeempleadoestados as $cambioEstadoInforme) {
            $comentario = $objInformeEmpleadoComentarios->find()
                ->contain(['Commentsemployees'])
                //->where(['report_id' => $cambioEstadoInforme->report->report_id])
                ->where(['informeempleadocomentario_id' => $idEmpleado, 'report_id' => $cambioEstadoInforme->report->report_id])
                ->first();
            $cambioEstadoInforme->{"comentario"} = $comentario;
            $datetime = $cambioEstadoInforme->created;
            $phpdate = strtotime((string)$datetime);
            if ($phpdate == false) {
                $phpdate = 12;
            }
            $cambioEstadoInforme->{"fecha"} = date('d-m-y', $phpdate);
            $cambioEstadoInforme->{"hora"} = date('H:i:s', $phpdate);
        }
        return $this->setJsonResponse($informeempleadoestados);
    }
    public function cantInformesPorEmpleado($idEmpleado)
    {

        $conditions = [
            ['estaSemana', 'created > DATE_SUB(NOW(), INTERVAL 1 WEEK)'],
            ['semanaPasada', 'created < DATE_SUB(NOW(), INTERVAL 1 WEEK)'],
            ['esteMes', 'created > DATE_SUB(NOW(), INTERVAL 1 MONTH)'],
            ['mesPasado', 'created < DATE_SUB(NOW(), INTERVAL 1 MONTH)']
        ];
        foreach ($conditions as $condition) {
            $cantInformes = $this->Informeempleadoestados->find()
                ->where([$condition[1], ['employee_id' => $idEmpleado]])
                ->count();
            $infoCantInformes[$condition[0]] = $cantInformes;
        }
        setlocale(LC_TIME, "spanish");
        $mesPasado = ucfirst(strftime('%B', strtotime("last month")));
        $mesActual = ucfirst(strftime('%B'));
        return $this->setJsonResponse([
            'data' => $infoCantInformes,
            'options' => [$mesPasado, $mesActual]
        ]);
    }
    public function cantInformesPorSector()
    {
        $objSector = new SectorsTable();
        $sectores = $objSector->find('all')
            ->where(["stage_id" => 3]);
        $nombresSectores = [];
        $cantPorSector = [];
        foreach ($sectores as $sector) {
            $cantInformes = $this->Informeempleadoestados->find()
                ->where(['sector_id' => $sector->sector_id, 'ultimoEstado' => 1])
                ->count();
            array_push($nombresSectores, $sector->nombre_sector);
            array_push($cantPorSector, $cantInformes);
        }
        return $this->setJsonResponse([
            'data' => $cantPorSector,
            'labels' => $nombresSectores
        ]);
    }
    public function informesCambiosEstados($id = null)
    {

        $this->paginate = [
            'contain' => ['Reports.Products', 'Employees.Users', 'States', 'Sectors'],
            'conditions' => ['informeempleadoestado_id' => $id],
            'sortableFields' => [
                'created'
            ],
            'order' => [
                'created' => 'asc',
            ],
        ];
        //JONAAAAAAAAAAAA NO FUNCIONA PORQUE NO SETEAS EL COMENTARIO DEFAULT DE Se envia a sector diagnostico""""""
        $cambiosEstadoInforme['cambiosEstadoInforme'] = $this->paginate($this->Informeempleadoestados);
        $objComentario = new InformeempleadocomentariosTable();
        $comentarios = $objComentario->find('all', ['contain' => ['Commentsemployees'], 'conditions' => ['report_id' => $id]])
            ->order(['comment_employee_id' => 'ASC']);

        $comentarios = json_encode($comentarios);
        $i = 0;
        foreach ($cambiosEstadoInforme['cambiosEstadoInforme'] as $cambioEstadoInforme) {
            $cambioEstadoInforme->{"comentarioEmpleado"} = json_decode($comentarios)[$i];
            $datetime = $cambioEstadoInforme->created;
            $phpdate = strtotime((string)$datetime);
            if ($phpdate == false) {
                $phpdate = 12;
            }
            $cambioEstadoInforme->{"fecha"} = date('d-m-y', $phpdate);
            $cambioEstadoInforme->{"hora"} = date('H:i:s', $phpdate);
            $i++;
        }
        return $this->setJsonResponse($cambiosEstadoInforme);
    }
    /**
     * View method
     *
     * @param string|null $id Informeempleadoestado id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $informeempleadoestado = $this->Informeempleadoestados->get($id, [
            'contain' => ['Informeempleadoestados', 'Employees', 'States'],
        ]);

        /* $this->set(compact('informeempleadoestado')); */
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function editInformeempleadoestados()
    {
        $dataVue = $this->request->getData();
        $idReport = $dataVue["idInforme"];
        $idEmpleado = $dataVue["idEmpleado"];
        $idState = $dataVue["idEstado"];
        $idSector = $dataVue["idSector"];
        // $informeempleadoestado = $this->Informeempleadoestados->get(
        //     [$idReport, $idEmpleado, $idState],
        //     [
        //         'contain' => [],
        //     ]
        // );
        $informeempleadoestado = $this->Informeempleadoestados->find('all')
            ->where([
                'informeempleadoestado_id' => $idReport,
                'employee_id' => $idEmpleado,
                'state_id' => $idState,
                'sector_id' => $idSector,

            ]);
        // return $this->setJsonResponse([
        //     'idReport' => $idReport,
        //     'idEMpleado' =>$idEmpleado,
        //     'idState' =>$idState,
        //     'idSector' =>$idSector
        // ]);
        foreach ($informeempleadoestado as $unInforme) {
            if ($unInforme->ultimoEstado == 1) {
                $informeBuscado = $unInforme;
            }
        }

        $dataNueva = [
            "ultimoEstado" => 0,
        ];
        $informeempleadoestado = $this->Informeempleadoestados->patchEntity($informeBuscado, $dataNueva);
        $result = $this->Informeempleadoestados->save($informeempleadoestado);
        return $this->setJsonResponse([
            'mensaje' => $result,
        ]);
    }
    public function save()
    {
        $dataVue =  $this->request->getData();
        $idReport = (int)$dataVue['idInforme'];
        $idEmpleado = (int)$dataVue['idEmpleado'];
        $idSector = (int)$dataVue['selectSector'];
        //descomentar esto , ya que es de franco para que funcione al app mobile
        // if (((int)$dataVue['idEstado']) == 2) {
        //     $idState = 6;
        // } else {
            $objSectors = new SectorsTable();
            $sector = $objSectors->find()
                ->where(['sector_id' => $idSector])
                ->first();
            $idState = $sector->stage_id;
        // }
        $informeempleadoestado = $this->Informeempleadoestados->newEmptyEntity();

        $dataNueva = [
            "informeempleadoestado_id" => $idReport,
            "employee_id" =>  $idEmpleado,
            "state_id" => $idState,
            "sector_id" => $idSector,
            "ultimoEstado" => 1,
        ];
        $informeempleadoestado = $this->Informeempleadoestados->newEntity($dataNueva);
        $result = $this->Informeempleadoestados->save($informeempleadoestado, ['checkExisting' => false]);

        $this->envioEmail($idState, $idReport, $idEmpleado);
        return $this->setJsonResponse([
            'datosEntidad' => $result,
            'message' => true,
        ]);
        // return $this->setJsonResponse([
        //     'resultado' => $estadosActuales,
        // ]);
    }
    public function envioEmail($idState, $idReport, $idEmpleado)
    {

        $estadosActuales = $this->Informeempleadoestados->Informeempleadoestados->find('all')
            ->contain(['States', 'Reports.Products'])
            ->where(['Informeempleadoestados.state_id' => $idState, "Informeempleadoestados.informeempleadoestado_id" => $idReport, "Informeempleadoestados.employee_id" =>  $idEmpleado])
            ->all();
        foreach ($estadosActuales as $estado) {
            $tipoProducto = $estado->report->product->tipo;
            $marcaProducto = $estado->report->product->marca;
            $modeloProducto = $estado->report->product->modelo;
            $estadoActual = $estado->state->nombre_estado;
        }

        $reports = new ReportsTable();
        $report = $reports->get($idReport, [
            'contain' => ['Products.Clients'],
        ]);

        $product = $report['product'];
        $client = $product['client'];

        $mailer = new Mailer();
        $mailer->setTransport('gmail');
        $mailer
            ->setEmailFormat('html')
            ->setTo($client['email'])
            ->setFrom(['tracesysapp@gmail.com' => 'Tracesys'])
            ->setSubject('Su producto cambio de estado')

            ->deliver('
                            <table>
                            <tr>
                            <img src="https://i.ibb.co/jZcV0Lb/logo-Tracesysy-Chiquito.png" alt="Logo del sistema" />
                                    <hr>
                                    <p>Se le envia este email para notificarle que su "<b>' . $tipoProducto . ' ' . $marcaProducto . ' ' . $modeloProducto . ' "</b>
                                     paso a la etapa de "<b>' . $estadoActual . '"</b></p>
                            </tr>
                            </table>
                    ');


        $mailer->deliver();
    }
    public function add($idReport, $idEmpleado, $idState)
    {
        $informeempleadoestado = $this->Informeempleadoestados->newEmptyEntity();
        $dataNueva = [
            "informeempleadoestado_id" => $idReport,
            "employee_id" =>  $idEmpleado,
            "state_id" => $idState,
        ];
        $informeempleadoestado = $this->Informeempleadoestados->patchEntity($informeempleadoestado, $dataNueva);
        $result = $this->Informeempleadoestados->save($informeempleadoestado);

        $this->envioEmail($idState, $idReport, $idEmpleado);
        return $this->setJsonResponse([
            'datosReporte' => $result,
        ]);
    }


    /**
     * Edit method
     *
     * @param string|null $id Informeempleadoestado id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $informeempleadoestado = $this->Informeempleadoestados->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $informeempleadoestado = $this->Informeempleadoestados->patchEntity($informeempleadoestado, $this->request->getData());
            if ($this->Informeempleadoestados->save($informeempleadoestado)) {
                $this->Flash->success(__('The informeempleadoestado has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The informeempleadoestado could not be saved. Please, try again.'));
        }
        $informeempleadoestados = $this->Informeempleadoestados->Informeempleadoestados->find('list', ['limit' => 200]);
        $employees = $this->Informeempleadoestados->Employees->find('list', ['limit' => 200]);
        $states = $this->Informeempleadoestados->States->find('list', ['limit' => 200]);
        $this->set(compact('informeempleadoestado', 'informeempleadoestados', 'employees', 'states'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Informeempleadoestado id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $informeempleadoestado = $this->Informeempleadoestados->get($id);
        if ($this->Informeempleadoestados->delete($informeempleadoestado)) {
            $this->Flash->success(__('The informeempleadoestado has been deleted.'));
        } else {
            $this->Flash->error(__('The informeempleadoestado could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function verInforme()
    {
        //ingresa los datos del cliente que solicita del el seguimiento del producto
        $datos = $this->request->getData();
        $informe = $this->Informeempleadoestados->find()
            ->contain(['Reports.Products', 'States'])
            ->where([
                'Reports.product_id' => $datos['id_product'],
                'client_id' => $datos['id_client'], 'ultimoEstado' => 1
            ])
            ->first();
        $fechaHora = strtotime((string)$informe['created']);
        $product = [
            'nombre' => $informe->report->product['tipo'] . ' ' . $informe->report->product['marca'] . ' ' . $informe->report->product['marca'],
            'codigo' => $informe->report['product_id'],
            'motivo' => $informe->report->product['motivo'],
            'fecha' => date('d-m-y', $fechaHora),
            'hora' => date('H:i:s', $fechaHora),
            'estado' => $informe->state['nombre_estado']
        ];
        return $this->setJsonResponse(['product' => $product]);
    }

    /**
     * Al decidir el cliente llegara el dato de si acepta o rechaza el presupuesto de dicho informe
     * buscamos el obj en la tabla y cambiamos el ultimo estado y luego agregamos un nuevo estado
     * dependiendo la decision del cliente y retornamos si se logro con exito el cambio o no
     */
    public function decisionPresupuesto()
    {
        $datos = $this->request->getData();
        $informe = $this->Informeempleadoestados->find()
            ->contain(['Employees'])
            ->where(['informeempleadoestado_id' => $datos['idInforme'], 'ultimoEstado' => 1])
            ->first();
        $dataNueva = [
            "ultimoEstado" => 0,
        ];
        $informeempleadoestado = $this->Informeempleadoestados->patchEntity($informe, $dataNueva);
        $result = $this->Informeempleadoestados->save($informeempleadoestado);
        if ($datos['decision'] == 'aprobado') {
            $informeempleadoestado2 = $this->Informeempleadoestados->newEmptyEntity();
            $dataNueva = [
                "informeempleadoestado_id" => $datos['idInforme'],
                "employee_id" =>  $informeempleadoestado->employee_id,
                "state_id" => 3,
                "sector_id" => 3,
                "ultimoEstado" => 1,
            ];
            $informeempleadoestado2 = $this->Informeempleadoestados->newEntity($dataNueva);
            $result2 = $this->Informeempleadoestados->save($informeempleadoestado2, ['checkExisting' => false]);
            $comentar = new CommentsemployeesController;
            $commentsemployees = $comentar->Commentsemployees->newEmptyEntity();
            $dataNueva2 = [
                "descripcion" => 'El cliente acepto el presupuesto estimado',
            ];
            $commentsemployees = $comentar->Commentsemployees->patchEntity($commentsemployees, $dataNueva2);
            $resultx = $comentar->Commentsemployees->save($commentsemployees);
            $idComentarioEmpleado = $comentar->Commentsemployees->find()->select(['commentsemployee_id'])->last()['commentsemployee_id'];
            $comentario = $comentar->Commentsemployees->find()->select(['descripcion'])->last()['descripcion'];
            if ($resultx !== false) {
                $result3 = ([
                    'idComentarioEmpleado' => $idComentarioEmpleado,
                    'comentario' => $comentario,
                    'success' => true
                ]);
            }
            $comentarioInforme = new InformeempleadocomentariosController;
            $informeComentado = $comentarioInforme->Informeempleadocomentarios->newEmptyEntity();
            $dataNueva = [
                "informeempleadocomentario_id" => $informe->employee->employee_id,
                "comment_employee_id" => $idComentarioEmpleado,
                "report_id" => $datos['idInforme'],
                "cuit" => $informe->employee->cuit
            ];
            $informeComentado = $comentarioInforme->Informeempleadocomentarios->patchEntity($informeComentado, $dataNueva);
            $result4 = $comentarioInforme->Informeempleadocomentarios->save($informeComentado);
            $this->envioEmail(3, $datos['idInforme'], $informe->employee->employee_id);
        } else {
            $informeempleadoestado2 = $this->Informeempleadoestados->newEmptyEntity();
            $dataNueva = [
                "informeempleadoestado_id" => $datos['idInforme'],
                "employee_id" =>  $informeempleadoestado->employee_id,
                "state_id" => 5,
                "sector_id" => 1,
                "ultimoEstado" => 1,
            ];
            $informeempleadoestado2 = $this->Informeempleadoestados->newEntity($dataNueva);
            $result2 = $this->Informeempleadoestados->save($informeempleadoestado2, ['checkExisting' => false]);
            $comentar = new CommentsemployeesController;
            $commentsemployees = $comentar->Commentsemployees->newEmptyEntity();
            $dataNueva2 = [
                "descripcion" => 'No acepto el presupuesto estimado',
            ];
            $commentsemployees = $comentar->Commentsemployees->patchEntity($commentsemployees, $dataNueva2);
            $result = $comentar->Commentsemployees->save($commentsemployees);
            $idComentarioEmpleado = $comentar->Commentsemployees->find()->select(['commentsemployee_id'])->last()['commentsemployee_id'];
            $comentario = $comentar->Commentsemployees->find()->select(['descripcion'])->last()['descripcion'];
            if ($result !== false) {
                $result3 = ([
                    'idComentarioEmpleado' => $idComentarioEmpleado,
                    'comentario' => $comentario,
                    'success' => true
                ]);
            }
            $comentarioInforme = new InformeempleadocomentariosController;
            $informeComentado = $comentarioInforme->Informeempleadocomentarios->newEmptyEntity();
            $dataNueva = [
                "informeempleadocomentario_id" => $informe->employee->employee_id,
                "comment_employee_id" => $idComentarioEmpleado,
                "report_id" => $datos['idInforme'],
                "cuit" => $informe->employee->cuit
            ];
            $informeComentado = $comentarioInforme->Informeempleadocomentarios->patchEntity($informeComentado, $dataNueva);
            $result4 = $comentarioInforme->Informeempleadocomentarios->save($informeComentado);
            $this->envioEmail(5, $datos['idInforme'], $informe->employee->employee_id);
        }
        return $this->setJsonResponse([
            'resultado1' => $result,
            'resultado2' => $result2,
            'resultado3' => $result3,
            'resultado4' => $result4,
            'message' => true,
        ]);
    }
}
