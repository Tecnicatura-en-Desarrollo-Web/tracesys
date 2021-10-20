<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Replacement Controller
 *
 * @property \App\Model\Table\ReplacementTable $Replacement
 * @method \App\Model\Entity\Replacement[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ReplacementController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $replacement = $this->paginate($this->Replacement);

        $this->set(compact('replacement'));
    }

    /**
     * View method
     *
     * @param string|null $id Replacement id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $replacement = $this->Replacement->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('replacement'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $replacement = $this->Replacement->newEmptyEntity();
        if ($this->request->is('post')) {
            $replacement = $this->Replacement->patchEntity($replacement, $this->request->getData());
            if ($this->Replacement->save($replacement)) {
                $this->Flash->success(__('The replacement has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The replacement could not be saved. Please, try again.'));
        }
        $this->set(compact('replacement'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Replacement id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $replacement = $this->Replacement->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $replacement = $this->Replacement->patchEntity($replacement, $this->request->getData());
            if ($this->Replacement->save($replacement)) {
                $this->Flash->success(__('The replacement has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The replacement could not be saved. Please, try again.'));
        }
        $this->set(compact('replacement'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Replacement id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $replacement = $this->Replacement->get($id);
        if ($this->Replacement->delete($replacement)) {
            $this->Flash->success(__('The replacement has been deleted.'));
        } else {
            $this->Flash->error(__('The replacement could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
