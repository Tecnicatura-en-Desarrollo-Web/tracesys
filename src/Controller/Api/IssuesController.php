<?php

declare(strict_types=1);

namespace App\Controller\Api;

use App\Controller\AppController;
use App\Controller\Traits\ResponseTrait;

/**
 * Issues Controller
 *
 * @property \App\Model\Table\IssuesTable $Issues
 * @method \App\Model\Entity\Issue[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class IssuesController extends AppController
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
            'contain' => ['Suggestions'],
        ];
        $issues['issues'] = $this->paginate($this->Issues);
        return $this->setJsonResponse($issues);
    }

    /**
     * View method
     *
     * @param string|null $id Issue id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $issue = $this->Issues->get($id, [
            'contain' => ['Reports'],
        ]);

        $this->set(compact('issue'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $issue = $this->Issues->newEmptyEntity();
        if ($this->request->is('post')) {
            $issue = $this->Issues->patchEntity($issue, $this->request->getData());
            if ($this->Issues->save($issue)) {
                $this->Flash->success(__('The issue has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The issue could not be saved. Please, try again.'));
        }
        $reports = $this->Issues->Reports->find('list', ['limit' => 200]);
        $this->set(compact('issue', 'reports'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Issue id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $issue = $this->Issues->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $issue = $this->Issues->patchEntity($issue, $this->request->getData());
            if ($this->Issues->save($issue)) {
                $this->Flash->success(__('The issue has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The issue could not be saved. Please, try again.'));
        }
        $reports = $this->Issues->Reports->find('list', ['limit' => 200]);
        $this->set(compact('issue', 'reports'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Issue id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $issue = $this->Issues->get($id);
        if ($this->Issues->delete($issue)) {
            $this->Flash->success(__('The issue has been deleted.'));
        } else {
            $this->Flash->error(__('The issue could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function obtenerProblemas()
    {
        $this->paginate = [
            'contain' => '',
        ];
        $issues['issues'] = $this->paginate($this->Issues);
        return $this->setJsonResponse($issues);
    }
    public function verificarExistencia($stringMotivo = ""){
        //convertimos el string del motivo ingresado en un arreglo , donde cada palabra es una posicion del array
        $motivosArray=explode(" ", strtolower($stringMotivo));

        $issuesOcurrenciasSinonimos=[];
        foreach ($motivosArray as $palabraMotivo) {
            //obtenemos un json de sinonimos de una de las palabras del motivo ingresado
            $sinonimos = json_decode(file_get_contents("http://sesat.fdi.ucm.es:8080/servicios/rest/sinonimos/json/".$palabraMotivo));

            if(is_array($sinonimos->sinonimos)==true){
                array_unshift($sinonimos->sinonimos,(object)['sinonimo' => $palabraMotivo]);

            }else{
                $sinonimos->sinonimos=[(object)['sinonimo' => $palabraMotivo]];

            }
            //creamos una condicion sql dinamica basada en los sinonimos obtenidos , para realizar la consulta a la BD utilizando LIKE
            $conditionOr=[];

            foreach ($sinonimos->sinonimos as $sinonimo) {

                $sinonimoObtenido=$sinonimo->sinonimo;
                $terminacion=substr($sinonimo->sinonimo, -2);
                //si se trata de un verbo le quitamos la ultima letra (r)
                if($terminacion=="er" || $terminacion=="ir" || $terminacion=="ar"){
                    $sinonimoObtenido=$terminacion=substr($sinonimo->sinonimo,0,-1);
                }
                array_push($conditionOr,['titulo LIKE'=>'%'.$sinonimoObtenido.'%']);
            }

            //realizamos la busqueda de problemas en BD basados en los sinonimos de la palabra
            $issuesBD = $this->Issues->find('all')
            ->where(['OR'=>$conditionOr
            ])
            ;
            //determinamos la cantidad de ocurrencias de sinonimos del motivo en cada problema de BD
            if($issuesBD!=null){
                foreach ($issuesBD as $issueBD) {
                    $claveIssue=array_search($issueBD,array_column($issuesOcurrenciasSinonimos, 'issue'));
                    if($claveIssue===false){
                        array_push($issuesOcurrenciasSinonimos,['issue'=>$issueBD , 'cantOcurrencias'=>1]);
                    }else{
                        $issuesOcurrenciasSinonimos[$claveIssue]['cantOcurrencias']++;
                    }
                }
            }

        }
        // Si los sinonimos del motivo ingresado coinciden con las palabras de alguno de los problemas de la BD , entonces
        //asignamos dicho arreglo de sinonimos al array resultante
        $arrayResultante=$issuesOcurrenciasSinonimos;
        return $this->setJsonResponse([
            'sinonimos' => $arrayResultante
        ]);
    }

}
