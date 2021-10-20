<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * SugerenciaRepuesto Controller
 *
 * @property \App\Model\Table\SugerenciaRepuestoTable $SugerenciaRepuesto
 * @method \App\Model\Entity\SugerenciaRepuesto[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SugerenciaRepuestoController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $sugerenciaRepuesto = $this->paginate($this->SugerenciaRepuesto);

        $this->set(compact('sugerenciaRepuesto'));
    }

    /**
     * View method
     *
     * @param string|null $id Sugerencia Repuesto id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $sugerenciaRepuesto = $this->SugerenciaRepuesto->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('sugerenciaRepuesto'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $sugerenciaRepuesto = $this->SugerenciaRepuesto->newEmptyEntity();
        if ($this->request->is('post')) {
            $sugerenciaRepuesto = $this->SugerenciaRepuesto->patchEntity($sugerenciaRepuesto, $this->request->getData());
            if ($this->SugerenciaRepuesto->save($sugerenciaRepuesto)) {
                $this->Flash->success(__('The sugerencia repuesto has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The sugerencia repuesto could not be saved. Please, try again.'));
        }
        $this->set(compact('sugerenciaRepuesto'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Sugerencia Repuesto id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $sugerenciaRepuesto = $this->SugerenciaRepuesto->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $sugerenciaRepuesto = $this->SugerenciaRepuesto->patchEntity($sugerenciaRepuesto, $this->request->getData());
            if ($this->SugerenciaRepuesto->save($sugerenciaRepuesto)) {
                $this->Flash->success(__('The sugerencia repuesto has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The sugerencia repuesto could not be saved. Please, try again.'));
        }
        $this->set(compact('sugerenciaRepuesto'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Sugerencia Repuesto id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $sugerenciaRepuesto = $this->SugerenciaRepuesto->get($id);
        if ($this->SugerenciaRepuesto->delete($sugerenciaRepuesto)) {
            $this->Flash->success(__('The sugerencia repuesto has been deleted.'));
        } else {
            $this->Flash->error(__('The sugerencia repuesto could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
