<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * PermisoEtapa Controller
 *
 * @property \App\Model\Table\PermisoEtapaTable $PermisoEtapa
 * @method \App\Model\Entity\PermisoEtapa[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PermisoEtapaController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $permisoEtapa = $this->paginate($this->PermisoEtapa);

        $this->set(compact('permisoEtapa'));
    }

    /**
     * View method
     *
     * @param string|null $id Permiso Etapa id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $permisoEtapa = $this->PermisoEtapa->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('permisoEtapa'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $permisoEtapa = $this->PermisoEtapa->newEmptyEntity();
        if ($this->request->is('post')) {
            $permisoEtapa = $this->PermisoEtapa->patchEntity($permisoEtapa, $this->request->getData());
            if ($this->PermisoEtapa->save($permisoEtapa)) {
                $this->Flash->success(__('The permiso etapa has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The permiso etapa could not be saved. Please, try again.'));
        }
        $this->set(compact('permisoEtapa'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Permiso Etapa id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $permisoEtapa = $this->PermisoEtapa->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $permisoEtapa = $this->PermisoEtapa->patchEntity($permisoEtapa, $this->request->getData());
            if ($this->PermisoEtapa->save($permisoEtapa)) {
                $this->Flash->success(__('The permiso etapa has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The permiso etapa could not be saved. Please, try again.'));
        }
        $this->set(compact('permisoEtapa'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Permiso Etapa id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $permisoEtapa = $this->PermisoEtapa->get($id);
        if ($this->PermisoEtapa->delete($permisoEtapa)) {
            $this->Flash->success(__('The permiso etapa has been deleted.'));
        } else {
            $this->Flash->error(__('The permiso etapa could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
