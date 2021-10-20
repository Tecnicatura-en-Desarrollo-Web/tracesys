<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * ComentsClients Controller
 *
 * @property \App\Model\Table\ComentsClientsTable $ComentsClients
 * @method \App\Model\Entity\ComentsClient[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ComentsClientsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $comentsClients = $this->paginate($this->ComentsClients);

        $this->set(compact('comentsClients'));
    }

    /**
     * View method
     *
     * @param string|null $id Coments Client id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $comentsClient = $this->ComentsClients->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('comentsClient'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $comentsClient = $this->ComentsClients->newEmptyEntity();
        if ($this->request->is('post')) {
            $comentsClient = $this->ComentsClients->patchEntity($comentsClient, $this->request->getData());
            if ($this->ComentsClients->save($comentsClient)) {
                $this->Flash->success(__('The coments client has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The coments client could not be saved. Please, try again.'));
        }
        $this->set(compact('comentsClient'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Coments Client id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $comentsClient = $this->ComentsClients->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $comentsClient = $this->ComentsClients->patchEntity($comentsClient, $this->request->getData());
            if ($this->ComentsClients->save($comentsClient)) {
                $this->Flash->success(__('The coments client has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The coments client could not be saved. Please, try again.'));
        }
        $this->set(compact('comentsClient'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Coments Client id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $comentsClient = $this->ComentsClients->get($id);
        if ($this->ComentsClients->delete($comentsClient)) {
            $this->Flash->success(__('The coments client has been deleted.'));
        } else {
            $this->Flash->error(__('The coments client could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
