<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Clienteinformecomentarios Controller
 *
 * @property \App\Model\Table\ClienteinformecomentariosTable $Clienteinformecomentarios
 * @method \App\Model\Entity\Clienteinformecomentario[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ClienteinformecomentariosController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Clienteinformecomentarios', 'Commentsclients', 'Reports'],
        ];
        $clienteinformecomentarios = $this->paginate($this->Clienteinformecomentarios);

        $this->set(compact('clienteinformecomentarios'));
    }

    /**
     * View method
     *
     * @param string|null $id Clienteinformecomentario id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $clienteinformecomentario = $this->Clienteinformecomentarios->get($id, [
            'contain' => ['Clienteinformecomentarios', 'Commentsclients', 'Reports'],
        ]);

        $this->set(compact('clienteinformecomentario'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $clienteinformecomentario = $this->Clienteinformecomentarios->newEmptyEntity();
        if ($this->request->is('post')) {
            $clienteinformecomentario = $this->Clienteinformecomentarios->patchEntity($clienteinformecomentario, $this->request->getData());
            if ($this->Clienteinformecomentarios->save($clienteinformecomentario)) {
                $this->Flash->success(__('The clienteinformecomentario has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The clienteinformecomentario could not be saved. Please, try again.'));
        }
        $clienteinformecomentarios = $this->Clienteinformecomentarios->Clienteinformecomentarios->find('list', ['limit' => 200]);
        $commentsclients = $this->Clienteinformecomentarios->Commentsclients->find('list', ['limit' => 200]);
        $reports = $this->Clienteinformecomentarios->Reports->find('list', ['limit' => 200]);
        $this->set(compact('clienteinformecomentario', 'clienteinformecomentarios', 'commentsclients', 'reports'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Clienteinformecomentario id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $clienteinformecomentario = $this->Clienteinformecomentarios->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $clienteinformecomentario = $this->Clienteinformecomentarios->patchEntity($clienteinformecomentario, $this->request->getData());
            if ($this->Clienteinformecomentarios->save($clienteinformecomentario)) {
                $this->Flash->success(__('The clienteinformecomentario has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The clienteinformecomentario could not be saved. Please, try again.'));
        }
        $clienteinformecomentarios = $this->Clienteinformecomentarios->Clienteinformecomentarios->find('list', ['limit' => 200]);
        $commentsclients = $this->Clienteinformecomentarios->Commentsclients->find('list', ['limit' => 200]);
        $reports = $this->Clienteinformecomentarios->Reports->find('list', ['limit' => 200]);
        $this->set(compact('clienteinformecomentario', 'clienteinformecomentarios', 'commentsclients', 'reports'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Clienteinformecomentario id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $clienteinformecomentario = $this->Clienteinformecomentarios->get($id);
        if ($this->Clienteinformecomentarios->delete($clienteinformecomentario)) {
            $this->Flash->success(__('The clienteinformecomentario has been deleted.'));
        } else {
            $this->Flash->error(__('The clienteinformecomentario could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
