<?php
declare(strict_types=1);

namespace App\Controller\Api;
use App\Controller\AppController;
use App\Controller\ProductsController;
use App\Controller\Traits\ResponseTrait;
use App\Model\Entity\Product;
use App\Model\Table\BillTable;
use App\Model\Table\EmployeeTable;
use App\Model\Table\ProductsTable;
use App\Model\Table\StateTable;

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
        // $data['query'] = [
        //     'id' => [
        //         'sort' => 'id',
        //         'direction' => 'asc',
        //     ],
        //     'fecha' => [
        //         'sort' => 'title',
        //         'direction' => 'asc',
        //     ],
        //     'motivo' => [
        //         'sort' => 'created',
        //         'direction' => 'asc',
        //     ],
        //     'estado' => [
        //         'sort' => 'modified',
        //         'direction' => 'asc',
        //     ],
        // ];

        // if ($this->getRequest()->getQuery()) {
        //     $direction = 'asc';
        //     if ($this->getRequest()->getQuery('direction') === 'asc') {
        //         $direction = 'desc';
        //     }

        //     $data['query'][$this->getRequest()->getQuery('sort')]['direction'] = $direction;
        // }
        $objProducto=new ProductsTable();
        $objEmpleado=new EmployeeTable();
        $objEstado=new StateTable();
        $objFactura=new BillTable();
        $reports=$this->paginate($this->Reports);
        $data['reports']=array();
        foreach ($reports as $report) {
            $producto=$objProducto
                ->find()
                ->where(['id_producto' => $report['id_producto']])
                ->first();
            $empleado=$objEmpleado
                ->find()
                ->where(['cuit' => $report['id_empleado']])
                ->first();
            $estado=$objEstado
                ->find()
                ->where(['id_estado' => $report['id_estado']])
                ->first();
            $factura=$objFactura
                ->find()
                ->where(['id_factura' => $report['id_factura']])
                ->first();
            $infoReport=[
                        'id_informe'=>$report['id_informe'],
                        'producto'=>$producto,
                        'empleado'=>$empleado,
                        'estado'=>$estado,
                        'factura'=>$factura
            ];
            array_push($data['reports'],$infoReport);
        }
        return $this->setJsonResponse($data);
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
        $motivo=$this->Reports->get($report[0]['id_producto'])['motivo'];

        //return $this->setJsonResponse(['report' => $report]);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function save()
    {
        if (! $this->request->is('post')) {
            return $this->setJsonResponse([
                'error' => true,
                'message' => 'Invalid request!',
            ]);
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

        return $this->setJsonResponse(
            [
                'errors' => $report->getValidationErrors(),
                'message' => __('The post could not be saved. Please, try again.'),
            ],
            422
        );
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
