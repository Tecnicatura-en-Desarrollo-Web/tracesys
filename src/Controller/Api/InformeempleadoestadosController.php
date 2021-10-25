<?php

declare(strict_types=1);

namespace App\Controller\Api;

use App\Controller\AppController;
use App\Controller\Traits\ResponseTrait;
use App\Model\Entity\Informeempleadocomentario;
use App\Model\Table\InformeempleadocomentariosTable;
use App\Test\TestCase\Model\Table\InformeEmpleadoComentarioTableTest;

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
            'contain' => ['Employees', 'States', 'Reports', 'Reports.Products'],
            'conditions' => ['ultimoEstado' => 1]
        ];
        $informeempleadoestados['reports'] = $this->paginate($this->Informeempleadoestados);

        //$query['reports'] = $this->Informeempleadoestados->find();


        //$query['reports']->where(['state_id'=>2]);
        // $informeempleadoestados['reports']=$this->Informeempleadoestados
        // ->find()
        // ->where(['state_id' => 2])
        // ->last();

        return $this->setJsonResponse($informeempleadoestados);
    }
    public function informesCambiosEstados($id = null)
    {

        $this->paginate = [
            'contain' => ['Employees.Users', 'Reports.Products', 'States'],
            'conditions' => ['informeempleadoestado_id' => $id]
        ];
        $cambiosEstadoInforme['cambiosEstadoInforme'] = $this->paginate($this->Informeempleadoestados);
        $objComentario=new InformeempleadocomentariosTable();
        $comentarios = $objComentario->find('all', ['contain'=>['Commentsemployees'],'conditions' => ['report_id' => $id]]);
        $comentarios=json_encode($comentarios);
        $i=0;
        foreach ($cambiosEstadoInforme['cambiosEstadoInforme'] as $cambioEstadoInforme) {
            $cambioEstadoInforme->{"comentarioEmpleado"}=json_decode($comentarios)[$i];
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
    public function editInformeempleadoestados(){
        $dataVue=$this->request->getData();
        $idReport=$dataVue["idInforme"];
        $idEmpleado=$dataVue["idEmpleado"];
        $idState=$dataVue["idEstado"];
        $informeempleadoestado = $this->Informeempleadoestados->get([$idReport,$idEmpleado,$idState],
        [
            'contain' => [],
        ]);

        $dataNueva = [
            "ultimoEstado" => 0,
        ];
        $informeempleadoestado=$this->Informeempleadoestados->patchEntity($informeempleadoestado, $dataNueva);
        $result = $this->Informeempleadoestados->save($informeempleadoestado);
        return $this->setJsonResponse([
            'mensaje' => $result,
        ]);

    }
    public function save()
    {
        $dataVue =  $this->request->getData();
        $informeempleadoestado = $this->Informeempleadoestados->newEmptyEntity();
        $dataNueva = [
            "informeempleadoestado_id" => (int)$dataVue['idInforme'],
            "employee_id" => (int)$dataVue['idEmpleado'],
            "state_id" => (int)$dataVue['selectSector'],
        ];
        $informeempleadoestado = $this->Informeempleadoestados->patchEntity($informeempleadoestado, $dataNueva);
        $result = $this->Informeempleadoestados->save($informeempleadoestado);
        return $this->setJsonResponse([
            'datosEntidad' => $result,
        ]);
    }
    public function add()
    {
        $informeempleadoestado = $this->Informeempleadoestados->newEmptyEntity();
        if ($this->request->is('post')) {
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

        // $formu['formularioinfo'] = "llego jonaaaaaaaaaaa";
        // return $this->setJsonResponse($formu);
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
