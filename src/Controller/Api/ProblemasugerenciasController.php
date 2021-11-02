<?php
declare(strict_types=1);

namespace App\Controller\Api;
use App\Controller\AppController;
use App\Controller\Traits\ResponseTrait;

/**
 * Problemasugerencias Controller
 *
 * @property \App\Model\Table\ProblemasugerenciasTable $Problemasugerencias
 * @method \App\Model\Entity\Problemasugerencia[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ProblemasugerenciasController extends AppController
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
            'contain' => ['Suggestions','Issues'],
        ];
        $Problemasugerencias['suggestions'] = $this->paginate($this->Problemasugerencias);
        return $this->setJsonResponse($Problemasugerencias);
    }

    /**
     * View method
     *
     * @param string|null $id Problemasugerencia id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function issuesByReport($id = null){
        $this->paginate = [
            'contain' => [
                'Suggestions','Issues'],
            'conditions'=>['Issues.report_id' => $id , 'activo'=>0]
        ];
        $problemasugerencia ['suggestions'] = $this->paginate($this->Problemasugerencias);
        return $this->setJsonResponse($problemasugerencia);

    }
    public function sugerenciasParaAplicar($id = null){
        $this->paginate = [
            'contain' => [
                'Suggestions','Issues.Reports'],
            'conditions'=>['Issues.report_id' => $id , 'activo'=>1]
        ];
        $problemasugerencia ['suggestions'] = $this->paginate($this->Problemasugerencias);
        return $this->setJsonResponse($problemasugerencia);

    }

    public function view($id = null)
    {
        $problemasugerencia = $this->Problemasugerencias->get($id, [
            'contain' => ['Problemasugerencias', 'Suggestions'],
        ]);

        $this->set(compact('problemasugerencia'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $problemasugerencia = $this->Problemasugerencias->newEmptyEntity();
        if ($this->request->is('post')) {
            $problemasugerencia = $this->Problemasugerencias->patchEntity($problemasugerencia, $this->request->getData());
            if ($this->Problemasugerencias->save($problemasugerencia)) {
                $this->Flash->success(__('The problemasugerencia has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The problemasugerencia could not be saved. Please, try again.'));
        }
        $problemasugerencias = $this->Problemasugerencias->Problemasugerencias->find('list', ['limit' => 200]);
        $suggestions = $this->Problemasugerencias->Suggestions->find('list', ['limit' => 200]);
        $this->set(compact('problemasugerencia', 'problemasugerencias', 'suggestions'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Problemasugerencia id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit()
    {
        // Probando nueva version del metodo
        $dataVue =  $this->request->getData();
        if($dataVue['sugerenciasSeleccionadas']==null){
            return $this->setJsonResponse([
                'probandoinfo' => "nohaysugerencias"
            ]);
        }else{
            $sugerenciasIds=explode(",", $dataVue['sugerenciasSeleccionadas']);
            foreach ($sugerenciasIds as $unIdSugerencia) {

                $problemasugerencia = $this->Problemasugerencias->get([$dataVue['idIssueReport'],$dataVue['selectSugerencia']]);
                $dataNueva = [
                    "problemasugerencia_id" => (int)$dataVue['idIssueReport'],
                    "suggestion_id" => (int)$unIdSugerencia,
                    "activo" => 1,
                ];
                $problemasugerencia = $this->Problemasugerencias->patchEntity($problemasugerencia, $dataNueva);
                $result = $this->Problemasugerencias->save($problemasugerencia);
            }
            return $this->setJsonResponse([
                'probandoinfo' => $result
            ]);
        }

    }
    public function editarSugerenciasAplicadas()
    {
        // Probando nueva version del metodo
        $dataVue =  $this->request->getData();
        if($dataVue['sugerenciasAplicadas']==null){
            return $this->setJsonResponse([
                'probandoinfo' => "nohaysugerencias"
        ]);
        }else{
            $sugerenciasIds=explode(",", $dataVue['sugerenciasAplicadas']);
            //el contain hace un innerjoin , por lo tanto en condition ya tengo disponible todas las columnas
            //de las tablas que hice innerjoin en contain
            $this->paginate = [
                'contain' => ['Suggestions.Sectors','Issues'],
                'conditions' => ['stage_id' => 3]
            ];
            $problemasugerencias=$this->paginate($this->Problemasugerencias);

            // $problemasugerencias = $this->Problemasugerencias->find('all')
            // ->contain(['Sectors','Issues'])
            // ->where(['Suggestions.Sectors.stage_id' => 3]);
            // ['contain' => ['Suggestions.Sectors','Issues'],
            // 'conditions' => ['Issues.Reports' => 4]
            // // 'Issues.report_id' , 'Problemasugerencias.activo'=>1]]
            // ]);
            // return $this->setJsonResponse([
            //     'probandoinfo' => $problemasugerencias
            // ]);
            foreach ($problemasugerencias as $problemasugerencia) {
                $i=0;
                $encontrado=false;
                while($i<count($sugerenciasIds) && !$encontrado){
                    if($problemasugerencia->suggestion_id==$sugerenciasIds[$i]){
                        $encontrado=true;
                    }
                    $i++;
                }
                if($encontrado==false){
                    $dataNueva = [
                        "activo" => 0,
                    ];
                    $problemasugerencia = $this->Problemasugerencias->patchEntity($problemasugerencia, $dataNueva);
                    $result = $this->Problemasugerencias->save($problemasugerencia);
                }

            }
            return $this->setJsonResponse([
                'probandoinfo' => "terminooo"
            ]);
        }

    }

    /**
     * Delete method
     *
     * @param string|null $id Problemasugerencia id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $problemasugerencia = $this->Problemasugerencias->get($id);
        if ($this->Problemasugerencias->delete($problemasugerencia)) {
            $this->Flash->success(__('The problemasugerencia has been deleted.'));
        } else {
            $this->Flash->error(__('The problemasugerencia could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
