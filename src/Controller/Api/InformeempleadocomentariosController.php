<?php
declare(strict_types=1);

namespace App\Controller\Api;

use App\Controller\AppController;
use App\Controller\Traits\ResponseTrait;

/**
 * Informeempleadocomentarios Controller
 *
 * @property \App\Model\Table\InformeempleadocomentariosTable $Informeempleadocomentarios
 * @method \App\Model\Entity\Informeempleadocomentario[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class InformeempleadocomentariosController extends AppController
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
            'contain' => ['Informeempleadocomentarios', 'Commentsemployees', 'Reports'],
        ];
        $informeempleadocomentarios = $this->paginate($this->Informeempleadocomentarios);
        $this->set(compact('informeempleadocomentarios'));
    }

    /**
     * View method
     *
     * @param string|null $id Informeempleadocomentario id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $informeempleadocomentario = $this->Informeempleadocomentarios->get($id, [
            'contain' => ['Informeempleadocomentarios', 'Commentsemployees', 'Reports'],
        ]);

        $this->set(compact('informeempleadocomentario'));
    }
    public function save(){
        $dataVue =  $this->request->getData();
        $informeempleadocomentario = $this->Informeempleadocomentarios->newEmptyEntity();
        $dataNueva = [
            "informeempleadocomentario_id" => (int)$dataVue['idEmpleado'],
            "comment_employee_id" => (int)$dataVue['idComentarioEmpleado'],
            "report_id" => (int)$dataVue['idInforme'],
            "cuit" =>$dataVue['cuitEmpleado']
        ];
        $informeempleadocomentario = $this->Informeempleadocomentarios->patchEntity($informeempleadocomentario, $dataNueva);
        $result = $this->Informeempleadocomentarios->save($informeempleadocomentario);
        return $this->setJsonResponse([
            'traemeElresult' => $result,
        ]);
        // return $this->setJsonResponse([
        //     'success' => $result,
        // ]);
    }
    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $informeempleadocomentario = $this->Informeempleadocomentarios->newEmptyEntity();
        if ($this->request->is('post')) {
            $informeempleadocomentario = $this->Informeempleadocomentarios->patchEntity($informeempleadocomentario, $this->request->getData());
            if ($this->Informeempleadocomentarios->save($informeempleadocomentario)) {
                $this->Flash->success(__('The informeempleadocomentario has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The informeempleadocomentario could not be saved. Please, try again.'));
        }
        $informeempleadocomentarios = $this->Informeempleadocomentarios->Informeempleadocomentarios->find('list', ['limit' => 200]);
        $commentsemployees = $this->Informeempleadocomentarios->Commentsemployees->find('list', ['limit' => 200]);
        $reports = $this->Informeempleadocomentarios->Reports->find('list', ['limit' => 200]);
        $this->set(compact('informeempleadocomentario', 'informeempleadocomentarios', 'commentsemployees', 'reports'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Informeempleadocomentario id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $informeempleadocomentario = $this->Informeempleadocomentarios->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $informeempleadocomentario = $this->Informeempleadocomentarios->patchEntity($informeempleadocomentario, $this->request->getData());
            if ($this->Informeempleadocomentarios->save($informeempleadocomentario)) {
                $this->Flash->success(__('The informeempleadocomentario has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The informeempleadocomentario could not be saved. Please, try again.'));
        }
        $informeempleadocomentarios = $this->Informeempleadocomentarios->Informeempleadocomentarios->find('list', ['limit' => 200]);
        $commentsemployees = $this->Informeempleadocomentarios->Commentsemployees->find('list', ['limit' => 200]);
        $reports = $this->Informeempleadocomentarios->Reports->find('list', ['limit' => 200]);
        $this->set(compact('informeempleadocomentario', 'informeempleadocomentarios', 'commentsemployees', 'reports'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Informeempleadocomentario id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $informeempleadocomentario = $this->Informeempleadocomentarios->get($id);
        if ($this->Informeempleadocomentarios->delete($informeempleadocomentario)) {
            $this->Flash->success(__('The informeempleadocomentario has been deleted.'));
        } else {
            $this->Flash->error(__('The informeempleadocomentario could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
