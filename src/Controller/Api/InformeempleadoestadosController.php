<?php

declare(strict_types=1);

namespace App\Controller\Api;

use App\Controller\AppController;
use App\Controller\Traits\ResponseTrait;
use App\Model\Entity\Informeempleadocomentario;
use App\Model\Table\InformeempleadocomentariosTable;
use App\Model\Table\SectorsTable;
use App\Test\TestCase\Model\Table\InformeEmpleadoComentarioTableTest;
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

        return $this->setJsonResponse($informeempleadoestados);
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
        $objSectors = new SectorsTable();
        $sector = $objSectors->find()
            ->where(['sector_id' => $idSector])
            ->first();
        $idState = $sector->stage_id;
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
        // $mailer = new Mailer('default');
        // $mailer->setTransport('gmail');
        // $mailer->setFrom(['me@example.com' => 'My Site'])
        //     ->setTo('maximiliano.villalba@est.fi.uncoma.edu.ar')
        //     ->setSubject('About')
        //     ->deliver('maxi jefe negrero deja descansar a los pibes');
        //$dato="Reparacioooon naziiiiiii";
        $mailer = new Mailer();
        $mailer->setTransport('gmail');
        $mailer
            ->setEmailFormat('html')
            ->setTo('yonamixlfr@gmail.com')
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
}
