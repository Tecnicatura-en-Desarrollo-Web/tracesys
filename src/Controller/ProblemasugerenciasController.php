<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Problemasugerencias Controller
 *
 * @property \App\Model\Table\ProblemasugerenciasTable $Problemasugerencias
 * @method \App\Model\Entity\Problemasugerencia[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ProblemasugerenciasController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Problemasugerencias', 'Suggestions'],
        ];
        $problemasugerencias = $this->paginate($this->Problemasugerencias);

        $this->set(compact('problemasugerencias'));
    }

    /**
     * View method
     *
     * @param string|null $id Problemasugerencia id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $problemasugerencia = $this->Problemasugerencias->get($id, [
            'contain' => ['Problemasugerencias', 'Suggestions'],
        ]);

        $this->set(compact('problemasugerencia'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $problemasugerencia = $this->Problemasugerencias->newEmptyEntity();
        if ($this->request->is('post')) {
            $problemasugerencia = $this->Problemasugerencias->patchEntity($problemasugerencia, $this->request->getData());
            if ($this->Problemasugerencias->save($problemasugerencia)) {
                $this->Flash->success(__('The problemasugerencia has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The problemasugerencia could not be saved. Please, try again.'));
        }
        $problemasugerencias = $this->Problemasugerencias->Problemasugerencias->find('list', ['limit' => 200]);
        $suggestions = $this->Problemasugerencias->Suggestions->find('list', ['limit' => 200]);
        $this->set(compact('problemasugerencia', 'problemasugerencias', 'suggestions'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Problemasugerencia id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $problemasugerencia = $this->Problemasugerencias->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $problemasugerencia = $this->Problemasugerencias->patchEntity($problemasugerencia, $this->request->getData());
            if ($this->Problemasugerencias->save($problemasugerencia)) {
                $this->Flash->success(__('The problemasugerencia has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The problemasugerencia could not be saved. Please, try again.'));
        }
        $problemasugerencias = $this->Problemasugerencias->Problemasugerencias->find('list', ['limit' => 200]);
        $suggestions = $this->Problemasugerencias->Suggestions->find('list', ['limit' => 200]);
        $this->set(compact('problemasugerencia', 'problemasugerencias', 'suggestions'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Problemasugerencia id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $problemasugerencia = $this->Problemasugerencias->get($id);
        if ($this->Problemasugerencias->delete($problemasugerencia)) {
            $this->Flash->success(__('The problemasugerencia has been deleted.'));
        } else {
            $this->Flash->error(__('The problemasugerencia could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}