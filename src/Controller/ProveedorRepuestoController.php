<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * ProveedorRepuesto Controller
 *
 * @property \App\Model\Table\ProveedorRepuestoTable $ProveedorRepuesto
 * @method \App\Model\Entity\ProveedorRepuesto[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ProveedorRepuestoController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $proveedorRepuesto = $this->paginate($this->ProveedorRepuesto);

        $this->set(compact('proveedorRepuesto'));
    }

    /**
     * View method
     *
     * @param string|null $id Proveedor Repuesto id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $proveedorRepuesto = $this->ProveedorRepuesto->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('proveedorRepuesto'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $proveedorRepuesto = $this->ProveedorRepuesto->newEmptyEntity();
        if ($this->request->is('post')) {
            $proveedorRepuesto = $this->ProveedorRepuesto->patchEntity($proveedorRepuesto, $this->request->getData());
            if ($this->ProveedorRepuesto->save($proveedorRepuesto)) {
                $this->Flash->success(__('The proveedor repuesto has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The proveedor repuesto could not be saved. Please, try again.'));
        }
        $this->set(compact('proveedorRepuesto'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Proveedor Repuesto id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $proveedorRepuesto = $this->ProveedorRepuesto->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $proveedorRepuesto = $this->ProveedorRepuesto->patchEntity($proveedorRepuesto, $this->request->getData());
            if ($this->ProveedorRepuesto->save($proveedorRepuesto)) {
                $this->Flash->success(__('The proveedor repuesto has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The proveedor repuesto could not be saved. Please, try again.'));
        }
        $this->set(compact('proveedorRepuesto'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Proveedor Repuesto id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $proveedorRepuesto = $this->ProveedorRepuesto->get($id);
        if ($this->ProveedorRepuesto->delete($proveedorRepuesto)) {
            $this->Flash->success(__('The proveedor repuesto has been deleted.'));
        } else {
            $this->Flash->error(__('The proveedor repuesto could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
