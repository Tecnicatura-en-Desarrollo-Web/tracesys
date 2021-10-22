<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Suggestions Controller
 *
 * @property \App\Model\Table\SuggestionsTable $Suggestions
 * @method \App\Model\Entity\Suggestion[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SuggestionsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Sectors'],
        ];
        $suggestions = $this->paginate($this->Suggestions);

        $this->set(compact('suggestions'));
    }

    /**
     * View method
     *
     * @param string|null $id Suggestion id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $suggestion = $this->Suggestions->get($id, [
            'contain' => ['Sectors'],
        ]);

        $this->set(compact('suggestion'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $suggestion = $this->Suggestions->newEmptyEntity();
        if ($this->request->is('post')) {
            $suggestion = $this->Suggestions->patchEntity($suggestion, $this->request->getData());
            if ($this->Suggestions->save($suggestion)) {
                $this->Flash->success(__('The suggestion has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The suggestion could not be saved. Please, try again.'));
        }
        $sectors = $this->Suggestions->Sectors->find('list', ['limit' => 200]);
        $this->set(compact('suggestion', 'sectors'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Suggestion id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $suggestion = $this->Suggestions->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $suggestion = $this->Suggestions->patchEntity($suggestion, $this->request->getData());
            if ($this->Suggestions->save($suggestion)) {
                $this->Flash->success(__('The suggestion has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The suggestion could not be saved. Please, try again.'));
        }
        $sectors = $this->Suggestions->Sectors->find('list', ['limit' => 200]);
        $this->set(compact('suggestion', 'sectors'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Suggestion id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $suggestion = $this->Suggestions->get($id);
        if ($this->Suggestions->delete($suggestion)) {
            $this->Flash->success(__('The suggestion has been deleted.'));
        } else {
            $this->Flash->error(__('The suggestion could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
