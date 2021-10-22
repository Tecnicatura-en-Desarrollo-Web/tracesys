<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Commentsemployees Controller
 *
 * @property \App\Model\Table\CommentsemployeesTable $Commentsemployees
 * @method \App\Model\Entity\Commentsemployee[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CommentsemployeesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $commentsemployees = $this->paginate($this->Commentsemployees);

        $this->set(compact('commentsemployees'));
    }

    /**
     * View method
     *
     * @param string|null $id Commentsemployee id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $commentsemployee = $this->Commentsemployees->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('commentsemployee'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $commentsemployee = $this->Commentsemployees->newEmptyEntity();
        if ($this->request->is('post')) {
            $commentsemployee = $this->Commentsemployees->patchEntity($commentsemployee, $this->request->getData());
            if ($this->Commentsemployees->save($commentsemployee)) {
                $this->Flash->success(__('The commentsemployee has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The commentsemployee could not be saved. Please, try again.'));
        }
        $this->set(compact('commentsemployee'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Commentsemployee id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $commentsemployee = $this->Commentsemployees->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $commentsemployee = $this->Commentsemployees->patchEntity($commentsemployee, $this->request->getData());
            if ($this->Commentsemployees->save($commentsemployee)) {
                $this->Flash->success(__('The commentsemployee has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The commentsemployee could not be saved. Please, try again.'));
        }
        $this->set(compact('commentsemployee'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Commentsemployee id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $commentsemployee = $this->Commentsemployees->get($id);
        if ($this->Commentsemployees->delete($commentsemployee)) {
            $this->Flash->success(__('The commentsemployee has been deleted.'));
        } else {
            $this->Flash->error(__('The commentsemployee could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
