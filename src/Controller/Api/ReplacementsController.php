<?php

declare(strict_types=1);

namespace App\Controller\Api;

use App\Controller\AppController;
use App\Controller\Traits\ResponseTrait;

/**
 * Replacements Controller
 *
 * @property \App\Model\Table\ReplacementsTable $Replacements
 * @method \App\Model\Entity\Replacement[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ReplacementsController extends AppController
{
    use ResponseTrait;
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $replacements = $this->paginate($this->Replacements);

        return $this->setJsonResponse($replacements);
    }

    /**
     * View method
     *
     * @param string|null $id Replacement id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $replacement = $this->Replacements->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('replacement'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $replacement = $this->Replacements->newEmptyEntity();
        if ($this->request->is('post')) {
            $replacement = $this->Replacements->patchEntity($replacement, $this->request->getData());
            if ($this->Replacements->save($replacement)) {
                return $this->setJsonResponse(
                    [
                        'message' => true,
                    ],
                );
            }
            $this->Flash->error(__('The replacement could not be saved. Please, try again.'));
        }
        $this->set(compact('replacement'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Replacement id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $replacement = $this->Replacements->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $replacement = $this->Replacements->patchEntity($replacement, $this->request->getData());
            if ($this->Replacements->save($replacement)) {
                $this->Flash->success(__('The replacement has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The replacement could not be saved. Please, try again.'));
        }
        $this->set(compact('replacement'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Replacement id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $replacement = $this->Replacements->get($id);
        if ($this->Replacements->delete($replacement)) {
            $this->Flash->success(__('The replacement has been deleted.'));
        } else {
            $this->Flash->error(__('The replacement could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}