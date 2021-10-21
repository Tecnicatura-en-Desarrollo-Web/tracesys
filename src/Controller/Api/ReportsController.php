<?php

declare(strict_types=1);

namespace App\Controller\Api;

use App\Controller\AppController;
use App\Controller\ProductsController;
use App\Controller\Traits\ResponseTrait;
use App\Model\Entity\Employee;
use App\Model\Entity\Product;
use App\Model\Table\BillTable;
use App\Model\Table\EmployeeTable;
use App\Model\Table\ProductsTable;
use App\Model\Table\StateTable;
use App\Model\Table\ClientsTable;
use App\Model\Table\UsersTable;

/**
 * Reports Controller
 *
 * @property \App\Model\Table\ReportsTable $Reports
 * @method \App\Model\Entity\Report[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ReportsController extends AppController
{
    use ResponseTrait;
    public function initialize(): void
    {
        parent::initialize();

        $this->viewBuilder()->setLayout('');
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {

        //     $data['query'][$this->getRequest()->getQuery('sort')]['direction'] = $direction;
        // }
        //$reports = $this->Reports->find('all');
        //$query = $this->Reports->find('all', ['contain' => ['Products','States']]);
        // $query = $this->paginate = [
        //     'contain' => ['Employees', 'States', 'Products', 'Bills'],
        // ];
        // $data['reports']=$query;
        // return $this->setJsonResponse($data['reports']);

        $this->paginate = [
            'contain' => ['Employees', 'States', 'Products', 'Bills'],
        ];
        $data['reports'] = $this->paginate($this->Reports);

        return $this->setJsonResponse($data['reports']);
    }

    /**
     * View method
     *
     * @param string|null $id Report id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {

        return $this->setJsonResponse([
            'MOtivoooooo' => "jonaaaaaaaaaa"
        ]);
        $report = $this->Reports->get($id, [
            'contain' => [],
        ]);
        $motivo = $this->Reports->get($report[0]['id_producto'])['motivo'];

        //return $this->setJsonResponse(['report' => $report]);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function save()
    {
        if (!$this->request->is('post')) {
            return $this->setJsonResponse([
                'error' => true,
                'message' => 'Invalid request!',
            ]);
        }

        $dataVue =  $this->request->getData();

        $classClients = new ClientsTable();
        $user = $classClients->newEmptyEntity();
        $dataClients = [
            "cuit" => $dataVue["cuit"],
            "denominacion" => $dataVue["denominacion"],
            "direccion" => $dataVue["denominacion"],
            "email" => $dataVue["email"],
            "password" => "123",
            "usuario" => "prueba",
            "telefono" => 1112,
        ];

        $user = $classClients->patchEntity($user, $dataClients);

        $resultUser = $classClients->save($user);

        if ($resultUser !== false) {

            $classProduct = new ProductsTable();
            $product = $classProduct->newEmptyEntity();
            $dataProduct = [
                "tipo" => $dataVue["tipo"],
                "modelo" => $dataVue["modelo"],
                "marca" => $dataVue["marca"],
                "motivo" => $dataVue["motivo"],
                "prioridad" => $dataVue["prioridad"],
                "descripcion" => $dataVue["descripcion"],
                "cuit_user" => $dataVue["cuit"],
            ];

            $product = $classProduct->patchEntity($product, $dataProduct);

            $resultProduct = $classProduct->save($product);

            if ($resultProduct !== false) {

                $dataInforme = [];

                return $this->setJsonResponse(
                    [
                        "message" =>  $resultProduct,
                    ]
                );
            }
        }

        $report = $this->Reports->newEmptyEntity();
        $report = $this->Reports->patchEntity($report, $this->request->getData());
        $result = $this->Reports->save($report);
        if ($result !== false) {
            return $this->setJsonResponse(
                [
                    'data' => $result,
                    'success' => true,
                    'url' => '/reports',
                    'message' => __('The post has been saved.'),
                ],
                201
            );
        }
    }

    /**
     * Edit method
     *
     * @param string|null $id Report id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $report = $this->Reports->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $report = $this->Reports->patchEntity($report, $this->request->getData());
            if ($this->Reports->save($report)) {
                $this->Flash->success(__('The report has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The report could not be saved. Please, try again.'));
        }
        $this->set(compact('report'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Report id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $report = $this->Reports->get($id);
        if ($this->Reports->delete($report)) {
            $this->Flash->success(__('The report has been deleted.'));
        } else {
            $this->Flash->error(__('The report could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}