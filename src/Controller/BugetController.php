<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Buget Controller
 *
 * @property \App\Model\Table\BugetTable $Buget
 * @method \App\Model\Entity\Buget[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class BugetController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $buget = $this->paginate($this->Buget);

        $this->set(compact('buget'));
    }

    /**
     * View method
     *
     * @param string|null $id Buget id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $buget = $this->Buget->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('buget'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $buget = $this->Buget->newEmptyEntity();
        if ($this->request->is('post')) {
            $buget = $this->Buget->patchEntity($buget, $this->request->getData());
            if ($this->Buget->save($buget)) {
                $this->Flash->success(__('The buget has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The buget could not be saved. Please, try again.'));
        }
        $this->set(compact('buget'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Buget id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $buget = $this->Buget->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $buget = $this->Buget->patchEntity($buget, $this->request->getData());
            if ($this->Buget->save($buget)) {
                $this->Flash->success(__('The buget has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The buget could not be saved. Please, try again.'));
        }
        $this->set(compact('buget'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Buget id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $buget = $this->Buget->get($id);
        if ($this->Buget->delete($buget)) {
            $this->Flash->success(__('The buget has been deleted.'));
        } else {
            $this->Flash->error(__('The buget could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
