<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Proveedorrepuestos Controller
 *
 * @property \App\Model\Table\ProveedorrepuestosTable $Proveedorrepuestos
 * @method \App\Model\Entity\Proveedorrepuesto[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ProveedorrepuestosController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Proveedorrepuestos', 'Providers'],
        ];
        $proveedorrepuestos = $this->paginate($this->Proveedorrepuestos);

        $this->set(compact('proveedorrepuestos'));
    }

    /**
     * View method
     *
     * @param string|null $id Proveedorrepuesto id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $proveedorrepuesto = $this->Proveedorrepuestos->get($id, [
            'contain' => ['Proveedorrepuestos', 'Providers'],
        ]);

        $this->set(compact('proveedorrepuesto'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $proveedorrepuesto = $this->Proveedorrepuestos->newEmptyEntity();
        if ($this->request->is('post')) {
            $proveedorrepuesto = $this->Proveedorrepuestos->patchEntity($proveedorrepuesto, $this->request->getData());
            if ($this->Proveedorrepuestos->save($proveedorrepuesto)) {
                $this->Flash->success(__('The proveedorrepuesto has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The proveedorrepuesto could not be saved. Please, try again.'));
        }
        $proveedorrepuestos = $this->Proveedorrepuestos->Proveedorrepuestos->find('list', ['limit' => 200]);
        $providers = $this->Proveedorrepuestos->Providers->find('list', ['limit' => 200]);
        $this->set(compact('proveedorrepuesto', 'proveedorrepuestos', 'providers'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Proveedorrepuesto id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $proveedorrepuesto = $this->Proveedorrepuestos->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $proveedorrepuesto = $this->Proveedorrepuestos->patchEntity($proveedorrepuesto, $this->request->getData());
            if ($this->Proveedorrepuestos->save($proveedorrepuesto)) {
                $this->Flash->success(__('The proveedorrepuesto has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The proveedorrepuesto could not be saved. Please, try again.'));
        }
        $proveedorrepuestos = $this->Proveedorrepuestos->Proveedorrepuestos->find('list', ['limit' => 200]);
        $providers = $this->Proveedorrepuestos->Providers->find('list', ['limit' => 200]);
        $this->set(compact('proveedorrepuesto', 'proveedorrepuestos', 'providers'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Proveedorrepuesto id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $proveedorrepuesto = $this->Proveedorrepuestos->get($id);
        if ($this->Proveedorrepuestos->delete($proveedorrepuesto)) {
            $this->Flash->success(__('The proveedorrepuesto has been deleted.'));
        } else {
            $this->Flash->error(__('The proveedorrepuesto could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
