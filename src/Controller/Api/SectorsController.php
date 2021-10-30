<?php

declare(strict_types=1);

namespace App\Controller\Api;

use App\Controller\AppController;
use App\Controller\Traits\ResponseTrait;

/**
 * Sectors Controller
 *
 * @property \App\Model\Table\SectorsTable $Sectors
 * @method \App\Model\Entity\Sector[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SectorsController extends AppController
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
            'contain' => ['Stages'],
        ];
        $sectors = $this->paginate($this->Sectors);
        return $this->setJsonResponse(['sectors' => $sectors]);
    }

    /**
     * View method
     *
     * @param string|null $id Sector id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function obtenerSectoresPorEtapa($idEtapa)
    {

        switch ($idEtapa) {
            case 2:
                $this->paginate = [
                    'contain' => ['Stages'],
                    'conditions' => ["Sectors.stage_id" => 3]
                ];
                break;
            case 3:
                $this->paginate = [
                    'contain' => ['Stages'],
                    'conditions' => [["Sectors.stage_id !=" => 3], ["Sectors.stage_id !=" => 1]]
                ];
                break;
            case 4:
                $this->paginate = [
                    'contain' => ['Stages'],
                    'conditions' => [["Sectors.stage_id !=" => 3], ["Sectors.stage_id !=" => 1]]
                ];
                break;
        }
        $sectors = $this->paginate($this->Sectors);
        return $this->setJsonResponse(['sectors' => $sectors]);
    }
    public function view($id = null)
    {
        $sector = $this->Sectors->get($id, [
            'contain' => ['Stages'],
        ]);

        $this->set(compact('sector'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function save()
    {
        $sector = $this->Sectors->newEmptyEntity();
        if ($this->request->is('post')) {
            $sector = $this->Sectors->patchEntity($sector, $this->request->getData());
            if ($this->Sectors->save($sector)) {
                return $this->setJsonResponse([
                    'message' => true,
                ]);
            }
            /*  $sector = $this->Sectors->patchEntity($sector, $this->request->getData());
            if ($this->Sectors->save($sector)) {
                $this->Flash->success(__('The sector has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The sector could not be saved. Please, try again.')); */
        }
        /* $stages = $this->Sectors->Stages->find('list', ['limit' => 200]);
        $this->set(compact('sector', 'stages')); */
    }

    /**
     * Edit method
     *
     * @param string|null $id Sector id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $sector = $this->Sectors->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $sector = $this->Sectors->patchEntity($sector, $this->request->getData());
            if ($this->Sectors->save($sector)) {
                $this->Flash->success(__('The sector has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The sector could not be saved. Please, try again.'));
        }
        $stages = $this->Sectors->Stages->find('list', ['limit' => 200]);
        $this->set(compact('sector', 'stages'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Sector id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $sector = $this->Sectors->get($id);
        if ($this->Sectors->delete($sector)) {
            $this->Flash->success(__('The sector has been deleted.'));
        } else {
            $this->Flash->error(__('The sector could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function obtenerEstadosDeEtapa($id = null)
    {
        $this->paginate = [
            'conditions' => ['stage_id' => $id]
        ];
        $SectoresDeEtapa['sectores'] = $this->paginate($this->Sectors);
        return $this->setJsonResponse($SectoresDeEtapa);
    }

    public function actualizarOrden()
    {
        /* $sectores = $this->obtenerEstadosDeEtapa(3); */
        $this->paginate = [
            'conditions' => ['stage_id' => 3]
        ];
        $SectoresDeEtapa['sectores'] = $this->paginate($this->Sectors);

        $dataVue = $this->request->getData()["seleccionado"];

        $i = 0;
        foreach ($SectoresDeEtapa["sectores"] as $key => $value) {
            $sectorArray = [];
            $arrayCorroboracion = [];

            $sectorArray["sector_id"] = $value["sector_id"];
            $sectorArray["nombre_sector"] = $value["nombre_sector"];
            $sectorArray["orden"] = $dataVue[$i];
            $sectorArray["stage_id"] = $value["stage_id"];

            $sector = $this->Sectors->newEmptyEntity();
            $sector = $this->Sectors->patchEntity($sector, $sectorArray);

            $this->Sectors->save($sector);

            $i++;
        }
        return $this->setJsonResponse([
            'message' => true,
        ]);
    }
}