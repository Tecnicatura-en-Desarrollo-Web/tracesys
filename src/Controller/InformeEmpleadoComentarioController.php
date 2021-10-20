<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * InformeEmpleadoComentario Controller
 *
 * @property \App\Model\Table\InformeEmpleadoComentarioTable $InformeEmpleadoComentario
 * @method \App\Model\Entity\InformeEmpleadoComentario[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class InformeEmpleadoComentarioController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $informeEmpleadoComentario = $this->paginate($this->InformeEmpleadoComentario);

        $this->set(compact('informeEmpleadoComentario'));
    }

    /**
     * View method
     *
     * @param string|null $id Informe Empleado Comentario id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $informeEmpleadoComentario = $this->InformeEmpleadoComentario->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('informeEmpleadoComentario'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $informeEmpleadoComentario = $this->InformeEmpleadoComentario->newEmptyEntity();
        if ($this->request->is('post')) {
            $informeEmpleadoComentario = $this->InformeEmpleadoComentario->patchEntity($informeEmpleadoComentario, $this->request->getData());
            if ($this->InformeEmpleadoComentario->save($informeEmpleadoComentario)) {
                $this->Flash->success(__('The informe empleado comentario has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The informe empleado comentario could not be saved. Please, try again.'));
        }
        $this->set(compact('informeEmpleadoComentario'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Informe Empleado Comentario id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $informeEmpleadoComentario = $this->InformeEmpleadoComentario->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $informeEmpleadoComentario = $this->InformeEmpleadoComentario->patchEntity($informeEmpleadoComentario, $this->request->getData());
            if ($this->InformeEmpleadoComentario->save($informeEmpleadoComentario)) {
                $this->Flash->success(__('The informe empleado comentario has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The informe empleado comentario could not be saved. Please, try again.'));
        }
        $this->set(compact('informeEmpleadoComentario'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Informe Empleado Comentario id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $informeEmpleadoComentario = $this->InformeEmpleadoComentario->get($id);
        if ($this->InformeEmpleadoComentario->delete($informeEmpleadoComentario)) {
            $this->Flash->success(__('The informe empleado comentario has been deleted.'));
        } else {
            $this->Flash->error(__('The informe empleado comentario could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
