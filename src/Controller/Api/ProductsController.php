<?php
declare(strict_types=1);

namespace App\Controller\Api;
use App\Controller\AppController;
use App\Controller\Traits\ResponseTrait;

/**
 * Products Controller
 *
 * @property \App\Model\Table\ProductsTable $Products
 * @method \App\Model\Entity\Product[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ProductsController extends AppController
{
    use ResponseTrait;
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Products->find('all')->contain(['Clients'])->all();
        // $data['users'] = $this->paginate($this->Users);
        $data['reports']=$query;
        return $this->setJsonResponse($data['reports']);
    }

    /**
     * View method
     *
     * @param string|null $id Product id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $product = $this->Products->get($id, [
            'contain' => [],
        ]);
        $fechaHora = date("Y-m-d H:i:s",strtotime(str_replace('/','-',$product['created'])));
        $informe = new ReportsController;
        $report = $informe->Reports->find()
        ->contain(['States'])
        ->where(['product_id'=>$id])
        ->first();
        $producto = [
            'codigo'=>$product['product_id'],
            'nombre'=>$product['tipo'],
            'motivo'=>$product['motivo'],
            'fecha'=>explode(' ',$fechaHora)[0],
            'hora'=>explode(' ',$fechaHora)[1],
            'estado'=>$report->state['nombre_estado']
        ];
        return $this->setJsonResponse([
            'product' => $producto
        ]);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $product = $this->Products->newEmptyEntity();
        if ($this->request->is('post')) {
            $product = $this->Products->patchEntity($product, $this->request->getData());
            if ($this->Products->save($product)) {
                $this->Flash->success(__('The product has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The product could not be saved. Please, try again.'));
        }
        $this->set(compact('product'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Product id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $product = $this->Products->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $product = $this->Products->patchEntity($product, $this->request->getData());
            if ($this->Products->save($product)) {
                $this->Flash->success(__('The product has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The product could not be saved. Please, try again.'));
        }
        $this->set(compact('product'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Product id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $product = $this->Products->get($id);
        if ($this->Products->delete($product)) {
            $this->Flash->success(__('The product has been deleted.'));
        } else {
            $this->Flash->error(__('The product could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function productsClient(){
        $data = $this->request->getData();
        $productos = [];
        $products = $this->Products->find()
        ->contain([])
        ->where(['client_id'=>$data['idCliente']]);
        foreach($products as $producto){
            $fechaHora = $fechaHora = strtotime((string)$producto['created']);;
            $productos[] = [
                'codigo'=>$producto['product_id'],
                'nombre'=>$producto['tipo'].' '.$producto['marca'].' '.$producto['modelo'],
                'fecha'=>date('d-m-y',$fechaHora)
            ];
        }
        return $this->setJsonResponse($productos);
    }
}
