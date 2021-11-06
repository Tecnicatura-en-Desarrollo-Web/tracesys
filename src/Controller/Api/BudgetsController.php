<?php

declare(strict_types=1);

namespace App\Controller\api;

use App\Controller\Api\ProblemasugerenciasController;
use App\Controller\AppController;
use App\Controller\Traits\ResponseTrait;

use function React\Promise\all;

/**
 * Budgets Controller
 *
 * @property \App\Model\Table\BudgetsTable $Budgets
 * @method \App\Model\Entity\Budget[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class BudgetsController extends AppController
{
    use ResponseTrait;
    public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent('RequestHandler');
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $data['budgets'] = $this->paginate($this->Budgets);
        return $this->setJsonResponse($data);
    }

    /**
     * View method
     *
     * @param string|null $id Budget id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $budget = $this->Budgets->get($id, [
            'contain' => [],
        ]);

        return $this->setJsonResponse(['budget' => $budget]);
    }
    public function save()
    {
        if (!$this->request->is('post')) {
            return $this->setJsonResponse([
                'error' => true,
                'message' => 'Invalid request!',
            ]);
        }

        $budget = $this->Budgets->newEmptyEntity();
        $budget = $this->Budgets->patchEntity($budget, $this->request->getData());
        $result = $this->Budgets->save($budget);
        if ($result !== false) {
            return $this->setJsonResponse(
                [
                    'data' => $result,
                    'success' => true,
                    'url' => '/login',
                    'message' => __('The budget has been saved.'),
                ],
                201
            );
        }

        return $this->setJsonResponse(
            [
                'success' => false,
            ],
            201
        );
    }
    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $budget = $this->Budgets->newEmptyEntity();
        if ($this->request->is('post')) {
            $budget = $this->Budgets->patchEntity($budget, $this->request->getData());
            if ($this->Budgets->save($budget)) {
                $this->Flash->success(__('The budget has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The budget could not be saved. Please, try again.'));
        }
        $this->set(compact('budget'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Budget id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $budget = $this->Budgets->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $budget = $this->Budgets->patchEntity($budget, $this->request->getData());
            if ($this->Budgets->save($budget)) {
                $this->Flash->success(__('The budget has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The budget could not be saved. Please, try again.'));
        }
        $this->set(compact('budget'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Budget id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $budget = $this->Budgets->get($id);
        if ($this->Budgets->delete($budget)) {
            $this->Flash->success(__('The budget has been deleted.'));
        } else {
            $this->Flash->error(__('The budget could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * presupuesto method
     *
     * @param string|null $id Budget id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function presupuesto(){
        $valor =($this->request->getData());
        $id_producto = (int) $valor['id_producto'];
        $id_cliente = (int) $valor['id_cliente'];
        // $budget =$this->Budgets->find('all', [
        //     'contain' => ['Reports', 'Reports.Products'],
        //     'conditions'=>['client_id'=>$id_cliente, 'Reports.product_id'=>$id_producto]
        // ]);
        $budget =$this->Budgets->find()
        ->contain(['Reports.Products'])
        ->where(['client_id'=>$id_cliente, 'Reports.product_id'=>$id_producto])
        ->first();
        $id_informe = $budget->report_id;
        $sugerencia =new ProblemasugerenciasController;
        $res = $sugerencia->Problemasugerencias->find()
        ->contain(['Issues','Suggestions'])
        ->where(['Issues.report_id'=>$id_informe])
        ->first();
        return $this->setJsonResponse(['budget'=>$budget,'suggestion'=>$res]);
    }
}