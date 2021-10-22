<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Informeempleadoestados Controller
 *
 * @property \App\Model\Table\InformeempleadoestadosTable $Informeempleadoestados
 * @method \App\Model\Entity\Informeempleadoestado[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class InformeempleadoestadosController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Informeempleadoestados', 'Employees', 'States'],
        ];
        $informeempleadoestados = $this->paginate($this->Informeempleadoestados);

        $this->set(compact('informeempleadoestados'));
    }

    /**
     * View method
     *
     * @param string|null $id Informeempleadoestado id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $informeempleadoestado = $this->Informeempleadoestados->get($id, [
            'contain' => ['Informeempleadoestados', 'Employees', 'States'],
        ]);

        $this->set(compact('informeempleadoestado'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $informeempleadoestado = $this->Informeempleadoestados->newEmptyEntity();
        if ($this->request->is('post')) {
            $informeempleadoestado = $this->Informeempleadoestados->patchEntity($informeempleadoestado, $this->request->getData());
            if ($this->Informeempleadoestados->save($informeempleadoestado)) {
                $this->Flash->success(__('The informeempleadoestado has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The informeempleadoestado could not be saved. Please, try again.'));
        }
        $informeempleadoestados = $this->Informeempleadoestados->Informeempleadoestados->find('list', ['limit' => 200]);
        $employees = $this->Informeempleadoestados->Employees->find('list', ['limit' => 200]);
        $states = $this->Informeempleadoestados->States->find('list', ['limit' => 200]);
        $this->set(compact('informeempleadoestado', 'informeempleadoestados', 'employees', 'states'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Informeempleadoestado id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $informeempleadoestado = $this->Informeempleadoestados->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $informeempleadoestado = $this->Informeempleadoestados->patchEntity($informeempleadoestado, $this->request->getData());
            if ($this->Informeempleadoestados->save($informeempleadoestado)) {
                $this->Flash->success(__('The informeempleadoestado has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The informeempleadoestado could not be saved. Please, try again.'));
        }
        $informeempleadoestados = $this->Informeempleadoestados->Informeempleadoestados->find('list', ['limit' => 200]);
        $employees = $this->Informeempleadoestados->Employees->find('list', ['limit' => 200]);
        $states = $this->Informeempleadoestados->States->find('list', ['limit' => 200]);
        $this->set(compact('informeempleadoestado', 'informeempleadoestados', 'employees', 'states'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Informeempleadoestado id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $informeempleadoestado = $this->Informeempleadoestados->get($id);
        if ($this->Informeempleadoestados->delete($informeempleadoestado)) {
            $this->Flash->success(__('The informeempleadoestado has been deleted.'));
        } else {
            $this->Flash->error(__('The informeempleadoestado could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
