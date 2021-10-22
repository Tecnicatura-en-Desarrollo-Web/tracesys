<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Permisoetapas Controller
 *
 * @property \App\Model\Table\PermisoetapasTable $Permisoetapas
 * @method \App\Model\Entity\Permisoetapa[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PermisoetapasController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Permisoetapas', 'Stages'],
        ];
        $permisoetapas = $this->paginate($this->Permisoetapas);

        $this->set(compact('permisoetapas'));
    }

    /**
     * View method
     *
     * @param string|null $id Permisoetapa id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $permisoetapa = $this->Permisoetapas->get($id, [
            'contain' => ['Permisoetapas', 'Stages'],
        ]);

        $this->set(compact('permisoetapa'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $permisoetapa = $this->Permisoetapas->newEmptyEntity();
        if ($this->request->is('post')) {
            $permisoetapa = $this->Permisoetapas->patchEntity($permisoetapa, $this->request->getData());
            if ($this->Permisoetapas->save($permisoetapa)) {
                $this->Flash->success(__('The permisoetapa has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The permisoetapa could not be saved. Please, try again.'));
        }
        $permisoetapas = $this->Permisoetapas->Permisoetapas->find('list', ['limit' => 200]);
        $stages = $this->Permisoetapas->Stages->find('list', ['limit' => 200]);
        $this->set(compact('permisoetapa', 'permisoetapas', 'stages'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Permisoetapa id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $permisoetapa = $this->Permisoetapas->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $permisoetapa = $this->Permisoetapas->patchEntity($permisoetapa, $this->request->getData());
            if ($this->Permisoetapas->save($permisoetapa)) {
                $this->Flash->success(__('The permisoetapa has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The permisoetapa could not be saved. Please, try again.'));
        }
        $permisoetapas = $this->Permisoetapas->Permisoetapas->find('list', ['limit' => 200]);
        $stages = $this->Permisoetapas->Stages->find('list', ['limit' => 200]);
        $this->set(compact('permisoetapa', 'permisoetapas', 'stages'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Permisoetapa id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $permisoetapa = $this->Permisoetapas->get($id);
        if ($this->Permisoetapas->delete($permisoetapa)) {
            $this->Flash->success(__('The permisoetapa has been deleted.'));
        } else {
            $this->Flash->error(__('The permisoetapa could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
