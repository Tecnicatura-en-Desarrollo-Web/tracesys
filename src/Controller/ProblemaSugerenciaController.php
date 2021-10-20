<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * ProblemaSugerencia Controller
 *
 * @property \App\Model\Table\ProblemaSugerenciaTable $ProblemaSugerencia
 * @method \App\Model\Entity\ProblemaSugerencium[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ProblemaSugerenciaController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $problemaSugerencia = $this->paginate($this->ProblemaSugerencia);

        $this->set(compact('problemaSugerencia'));
    }

    /**
     * View method
     *
     * @param string|null $id Problema Sugerencium id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $problemaSugerencium = $this->ProblemaSugerencia->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('problemaSugerencium'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $problemaSugerencium = $this->ProblemaSugerencia->newEmptyEntity();
        if ($this->request->is('post')) {
            $problemaSugerencium = $this->ProblemaSugerencia->patchEntity($problemaSugerencium, $this->request->getData());
            if ($this->ProblemaSugerencia->save($problemaSugerencium)) {
                $this->Flash->success(__('The problema sugerencium has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The problema sugerencium could not be saved. Please, try again.'));
        }
        $this->set(compact('problemaSugerencium'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Problema Sugerencium id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $problemaSugerencium = $this->ProblemaSugerencia->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $problemaSugerencium = $this->ProblemaSugerencia->patchEntity($problemaSugerencium, $this->request->getData());
            if ($this->ProblemaSugerencia->save($problemaSugerencium)) {
                $this->Flash->success(__('The problema sugerencium has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The problema sugerencium could not be saved. Please, try again.'));
        }
        $this->set(compact('problemaSugerencium'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Problema Sugerencium id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $problemaSugerencium = $this->ProblemaSugerencia->get($id);
        if ($this->ProblemaSugerencia->delete($problemaSugerencium)) {
            $this->Flash->success(__('The problema sugerencium has been deleted.'));
        } else {
            $this->Flash->error(__('The problema sugerencium could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
