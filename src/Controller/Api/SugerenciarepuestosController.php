<?php

declare(strict_types=1);

namespace App\Controller\Api;

use App\Controller\AppController;

use App\Controller\Traits\ResponseTrait;
use App\Model\Table\ReplacementsTable;

/**
 * Sugerenciarepuestos Controller
 *
 * @property \App\Model\Table\SugerenciarepuestosTable $Sugerenciarepuestos
 * @method \App\Model\Entity\Sugerenciarepuesto[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SugerenciarepuestosController extends AppController
{
    use ResponseTrait;
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Sugerenciarepuestos', 'Replacements'],
        ];
        $sugerenciarepuestos = $this->paginate($this->Sugerenciarepuestos);

        $this->set(compact('sugerenciarepuestos'));
    }

    /**
     * View method
     *
     * @param string|null $id Sugerenciarepuesto id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function registrarBajaStock()
    {

        $dataVue = $this->request->getData();
        $sugerenciasAplicadasIds = explode(",", $dataVue['sugerenciasAplicadas']);
        $objReplacement = new ReplacementsTable();
        foreach ($sugerenciasAplicadasIds as $sugerenciaAplicadaId) {
            $sugerenciaRepuesto = $this->Sugerenciarepuestos->find()
                ->contain(['Replacements'])
                ->where(['sugerenciarepuestos_id' => $sugerenciaAplicadaId])
                ->first();
            if ($sugerenciaRepuesto != null) {
                $replacement = $sugerenciaRepuesto->replacement;
                $dataNueva = [
                    "cantidad" => ($replacement->cantidad) - 1,
                ];
                $replacement = $objReplacement->patchEntity($replacement, $dataNueva);
                $result = $objReplacement->save($replacement);
            }
        }
        return $this->setJsonResponse([
            'retorno registro baja stock' => $sugerenciasAplicadasIds,
            'sugerenciaRepuesto' => $sugerenciaRepuesto,
            'baja' => $result
        ]);
    }
    public function view($id = null)
    {
        $sugerenciarepuesto = $this->Sugerenciarepuestos->get($id, [
            'contain' => ['Sugerenciarepuestos', 'Replacements'],
        ]);

        $this->set(compact('sugerenciarepuesto'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $dataVue = $this->request->getData();

        $sugerenciarepuesto = $this->Sugerenciarepuestos->newEmptyEntity();
        if ($this->request->is('post')) {
            $sugerenciarepuesto = $this->Sugerenciarepuestos->patchEntity($sugerenciarepuesto, $this->request->getData());
            if ($this->Sugerenciarepuestos->save($sugerenciarepuesto)) {
                return $this->setJsonResponse([
                    'message' => true,
                ]);
            }
            $this->Flash->error(__('The sugerenciarepuesto could not be saved. Please, try again.'));
        }
        $sugerenciarepuestos = $this->Sugerenciarepuestos->Sugerenciarepuestos->find('list', ['limit' => 200]);
        $replacements = $this->Sugerenciarepuestos->Replacements->find('list', ['limit' => 200]);
        $this->set(compact('sugerenciarepuesto', 'sugerenciarepuestos', 'replacements'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Sugerenciarepuesto id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $sugerenciarepuesto = $this->Sugerenciarepuestos->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $sugerenciarepuesto = $this->Sugerenciarepuestos->patchEntity($sugerenciarepuesto, $this->request->getData());
            if ($this->Sugerenciarepuestos->save($sugerenciarepuesto)) {
                $this->Flash->success(__('The sugerenciarepuesto has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The sugerenciarepuesto could not be saved. Please, try again.'));
        }
        $sugerenciarepuestos = $this->Sugerenciarepuestos->Sugerenciarepuestos->find('list', ['limit' => 200]);
        $replacements = $this->Sugerenciarepuestos->Replacements->find('list', ['limit' => 200]);
        $this->set(compact('sugerenciarepuesto', 'sugerenciarepuestos', 'replacements'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Sugerenciarepuesto id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $sugerenciarepuesto = $this->Sugerenciarepuestos->get($id);
        if ($this->Sugerenciarepuestos->delete($sugerenciarepuesto)) {
            $this->Flash->success(__('The sugerenciarepuesto has been deleted.'));
        } else {
            $this->Flash->error(__('The sugerenciarepuesto could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}