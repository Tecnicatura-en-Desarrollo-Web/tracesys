<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * InformeEmpleadoEstado Controller
 *
 * @property \App\Model\Table\InformeEmpleadoEstadoTable $InformeEmpleadoEstado
 * @method \App\Model\Entity\InformeEmpleadoEstado[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class InformeEmpleadoEstadoController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $informeEmpleadoEstado = $this->paginate($this->InformeEmpleadoEstado);

        $this->set(compact('informeEmpleadoEstado'));
    }

    /**
     * View method
     *
     * @param string|null $id Informe Empleado Estado id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $informeEmpleadoEstado = $this->InformeEmpleadoEstado->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('informeEmpleadoEstado'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $informeEmpleadoEstado = $this->InformeEmpleadoEstado->newEmptyEntity();
        if ($this->request->is('post')) {
            $informeEmpleadoEstado = $this->InformeEmpleadoEstado->patchEntity($informeEmpleadoEstado, $this->request->getData());
            if ($this->InformeEmpleadoEstado->save($informeEmpleadoEstado)) {
                $this->Flash->success(__('The informe empleado estado has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The informe empleado estado could not be saved. Please, try again.'));
        }
        $this->set(compact('informeEmpleadoEstado'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Informe Empleado Estado id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $informeEmpleadoEstado = $this->InformeEmpleadoEstado->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $informeEmpleadoEstado = $this->InformeEmpleadoEstado->patchEntity($informeEmpleadoEstado, $this->request->getData());
            if ($this->InformeEmpleadoEstado->save($informeEmpleadoEstado)) {
                $this->Flash->success(__('The informe empleado estado has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The informe empleado estado could not be saved. Please, try again.'));
        }
        $this->set(compact('informeEmpleadoEstado'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Informe Empleado Estado id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $informeEmpleadoEstado = $this->InformeEmpleadoEstado->get($id);
        if ($this->InformeEmpleadoEstado->delete($informeEmpleadoEstado)) {
            $this->Flash->success(__('The informe empleado estado has been deleted.'));
        } else {
            $this->Flash->error(__('The informe empleado estado could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
