<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Issue Controller
 *
 * @property \App\Model\Table\IssueTable $Issue
 * @method \App\Model\Entity\Issue[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class IssueController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $issue = $this->paginate($this->Issue);

        $this->set(compact('issue'));
    }

    /**
     * View method
     *
     * @param string|null $id Issue id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $issue = $this->Issue->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('issue'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $issue = $this->Issue->newEmptyEntity();
        if ($this->request->is('post')) {
            $issue = $this->Issue->patchEntity($issue, $this->request->getData());
            if ($this->Issue->save($issue)) {
                $this->Flash->success(__('The issue has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The issue could not be saved. Please, try again.'));
        }
        $this->set(compact('issue'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Issue id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $issue = $this->Issue->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $issue = $this->Issue->patchEntity($issue, $this->request->getData());
            if ($this->Issue->save($issue)) {
                $this->Flash->success(__('The issue has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The issue could not be saved. Please, try again.'));
        }
        $this->set(compact('issue'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Issue id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $issue = $this->Issue->get($id);
        if ($this->Issue->delete($issue)) {
            $this->Flash->success(__('The issue has been deleted.'));
        } else {
            $this->Flash->error(__('The issue could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
