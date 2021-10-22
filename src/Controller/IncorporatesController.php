<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Incorporates Controller
 *
 * @property \App\Model\Table\IncorporatesTable $Incorporates
 * @method \App\Model\Entity\Incorporate[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class IncorporatesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Incorporates', 'Replacements'],
        ];
        $incorporates = $this->paginate($this->Incorporates);

        $this->set(compact('incorporates'));
    }

    /**
     * View method
     *
     * @param string|null $id Incorporate id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $incorporate = $this->Incorporates->get($id, [
            'contain' => ['Incorporates', 'Replacements'],
        ]);

        $this->set(compact('incorporate'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $incorporate = $this->Incorporates->newEmptyEntity();
        if ($this->request->is('post')) {
            $incorporate = $this->Incorporates->patchEntity($incorporate, $this->request->getData());
            if ($this->Incorporates->save($incorporate)) {
                $this->Flash->success(__('The incorporate has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The incorporate could not be saved. Please, try again.'));
        }
        $incorporates = $this->Incorporates->Incorporates->find('list', ['limit' => 200]);
        $replacements = $this->Incorporates->Replacements->find('list', ['limit' => 200]);
        $this->set(compact('incorporate', 'incorporates', 'replacements'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Incorporate id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $incorporate = $this->Incorporates->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $incorporate = $this->Incorporates->patchEntity($incorporate, $this->request->getData());
            if ($this->Incorporates->save($incorporate)) {
                $this->Flash->success(__('The incorporate has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The incorporate could not be saved. Please, try again.'));
        }
        $incorporates = $this->Incorporates->Incorporates->find('list', ['limit' => 200]);
        $replacements = $this->Incorporates->Replacements->find('list', ['limit' => 200]);
        $this->set(compact('incorporate', 'incorporates', 'replacements'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Incorporate id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $incorporate = $this->Incorporates->get($id);
        if ($this->Incorporates->delete($incorporate)) {
            $this->Flash->success(__('The incorporate has been deleted.'));
        } else {
            $this->Flash->error(__('The incorporate could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
