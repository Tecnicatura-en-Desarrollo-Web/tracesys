<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Commentsclients Controller
 *
 * @property \App\Model\Table\CommentsclientsTable $Commentsclients
 * @method \App\Model\Entity\Commentsclient[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CommentsclientsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $commentsclients = $this->paginate($this->Commentsclients);

        $this->set(compact('commentsclients'));
    }

    /**
     * View method
     *
     * @param string|null $id Commentsclient id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $commentsclient = $this->Commentsclients->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('commentsclient'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $commentsclient = $this->Commentsclients->newEmptyEntity();
        if ($this->request->is('post')) {
            $commentsclient = $this->Commentsclients->patchEntity($commentsclient, $this->request->getData());
            if ($this->Commentsclients->save($commentsclient)) {
                $this->Flash->success(__('The commentsclient has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The commentsclient could not be saved. Please, try again.'));
        }
        $this->set(compact('commentsclient'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Commentsclient id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $commentsclient = $this->Commentsclients->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $commentsclient = $this->Commentsclients->patchEntity($commentsclient, $this->request->getData());
            if ($this->Commentsclients->save($commentsclient)) {
                $this->Flash->success(__('The commentsclient has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The commentsclient could not be saved. Please, try again.'));
        }
        $this->set(compact('commentsclient'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Commentsclient id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $commentsclient = $this->Commentsclients->get($id);
        if ($this->Commentsclients->delete($commentsclient)) {
            $this->Flash->success(__('The commentsclient has been deleted.'));
        } else {
            $this->Flash->error(__('The commentsclient could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
