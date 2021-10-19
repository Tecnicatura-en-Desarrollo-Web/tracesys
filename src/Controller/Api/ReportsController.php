<?php

declare(strict_types=1);

namespace App\Controller\Api;

use App\Controller\AppController;
use App\Controller\Traits\ResponseTrait;

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

        $data['reports'] = $this->paginate($this->Reports);
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
        $report = $this->Reports->get($id, [
            'contain' => [],
        ]);

        return $this->setJsonResponse(['report' => $report]);
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


        $report = $this->Reports->newEmptyEntity();
        $report = $this->Reports->patchEntity($report, $this->request->getData());
        $result = $this->Reports->save($report);
        return $this->setJsonResponse(
            [
                'data' => $result
            ],
            201
        );
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