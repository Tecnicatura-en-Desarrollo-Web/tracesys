<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * ClienteInformeComentario Controller
 *
 * @property \App\Model\Table\ClienteInformeComentarioTable $ClienteInformeComentario
 * @method \App\Model\Entity\ClienteInformeComentario[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ClienteInformeComentarioController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $clienteInformeComentario = $this->paginate($this->ClienteInformeComentario);

        $this->set(compact('clienteInformeComentario'));
    }

    /**
     * View method
     *
     * @param string|null $id Cliente Informe Comentario id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $clienteInformeComentario = $this->ClienteInformeComentario->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('clienteInformeComentario'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $clienteInformeComentario = $this->ClienteInformeComentario->newEmptyEntity();
        if ($this->request->is('post')) {
            $clienteInformeComentario = $this->ClienteInformeComentario->patchEntity($clienteInformeComentario, $this->request->getData());
            if ($this->ClienteInformeComentario->save($clienteInformeComentario)) {
                $this->Flash->success(__('The cliente informe comentario has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The cliente informe comentario could not be saved. Please, try again.'));
        }
        $this->set(compact('clienteInformeComentario'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Cliente Informe Comentario id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $clienteInformeComentario = $this->ClienteInformeComentario->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $clienteInformeComentario = $this->ClienteInformeComentario->patchEntity($clienteInformeComentario, $this->request->getData());
            if ($this->ClienteInformeComentario->save($clienteInformeComentario)) {
                $this->Flash->success(__('The cliente informe comentario has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The cliente informe comentario could not be saved. Please, try again.'));
        }
        $this->set(compact('clienteInformeComentario'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Cliente Informe Comentario id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $clienteInformeComentario = $this->ClienteInformeComentario->get($id);
        if ($this->ClienteInformeComentario->delete($clienteInformeComentario)) {
            $this->Flash->success(__('The cliente informe comentario has been deleted.'));
        } else {
            $this->Flash->error(__('The cliente informe comentario could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
