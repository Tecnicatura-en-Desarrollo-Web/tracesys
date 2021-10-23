<?php

declare(strict_types=1);

namespace App\Controller\Api;

use App\Controller\AppController;
use App\Controller\Traits\ResponseTrait;

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
        ];
        $informeempleadoestados['reports'] = $this->paginate($this->Informeempleadoestados);
        /* return $this->setJsonResponse(
            [
                'success' => $informeempleadoestados,
            ],
            201
        ); */


        return $this->setJsonResponse($informeempleadoestados);
    }
    public function informesCambiosEstados($id = null)
    {
        $this->paginate = [
            'contain' => ['Employees.Users', 'Reports.Products', 'States'],
            'conditions' => ['informeempleadoestado_id' => $id]
        ];

        $cambiosEstadoInforme['cambiosEstadoInforme'] = $this->paginate($this->Informeempleadoestados);
        return $this->setJsonResponse($cambiosEstadoInforme);

        // $cambiosEstadoInforme=$this->Informeempleadoestados->get($id, [
        //     'contain' => ['Employees.Users','Reports.Products','States'],
        //     'conditions' => ['informeempleadoestados_id' => $id]
        //     ]);
        // return $this->setJsonResponse(['cambiosEstadoInforme' => $cambiosEstadoInforme]);
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




        // if (! $this->request->is('post')) {
        //     return $this->setJsonResponse([
        //         'error' => true,
        //         'message' => 'Invalid request!',
        //     ]);
        // }

        // $informeempleadoestado = $this->Informeempleadoestados->newEmptyEntity();
        // $informeempleadoestado = $this->Informeempleadoestados->patchEntity($informeempleadoestado, $this->request->getData());
        // $result = $this->Informeempleadoestados->save($informeempleadoestado);
        // return $this->setJsonResponse(
        //     [
        //         'datos' => $result,
        //     ],
        // );

        // return $this->setJsonResponse([
        //     'datosEntidad' => $post,
        // ]);
        // if ($result !== false) {
        //     return $this->setJsonResponse(
        //         [
        //             'data' => $result,
        //             'success' => true,
        //             'url' => '/posts',
        //             'message' => __('The post has been saved.'),
        //         ],
        //         201
        //     );
        // }

        // return $this->setJsonResponse(
        //     [
        //         'errors' => $post->getValidationErrors(),
        //         'message' => __('The post could not be saved. Please, try again.'),
        //     ],
        //     422
        // );
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