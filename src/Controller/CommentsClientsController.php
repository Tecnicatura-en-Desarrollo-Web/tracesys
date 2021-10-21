<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * CommentsClients Controller
 *
 * @property \App\Model\Table\CommentsClientsTable $CommentsClients
 * @method \App\Model\Entity\CommentsClient[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CommentsClientsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $commentsClients = $this->paginate($this->CommentsClients);

        $this->set(compact('commentsClients'));
    }

    /**
     * View method
     *
     * @param string|null $id Comments Client id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $commentsClient = $this->CommentsClients->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('commentsClient'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $commentsClient = $this->CommentsClients->newEmptyEntity();
        if ($this->request->is('post')) {
            $commentsClient = $this->CommentsClients->patchEntity($commentsClient, $this->request->getData());
            if ($this->CommentsClients->save($commentsClient)) {
                $this->Flash->success(__('The comments client has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The comments client could not be saved. Please, try again.'));
        }
        $this->set(compact('commentsClient'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Comments Client id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $commentsClient = $this->CommentsClients->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $commentsClient = $this->CommentsClients->patchEntity($commentsClient, $this->request->getData());
            if ($this->CommentsClients->save($commentsClient)) {
                $this->Flash->success(__('The comments client has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The comments client could not be saved. Please, try again.'));
        }
        $this->set(compact('commentsClient'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Comments Client id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $commentsClient = $this->CommentsClients->get($id);
        if ($this->CommentsClients->delete($commentsClient)) {
            $this->Flash->success(__('The comments client has been deleted.'));
        } else {
            $this->Flash->error(__('The comments client could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
