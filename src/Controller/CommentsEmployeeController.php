<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * CommentsEmployee Controller
 *
 * @property \App\Model\Table\CommentsEmployeeTable $CommentsEmployee
 * @method \App\Model\Entity\CommentsEmployee[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CommentsEmployeeController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $commentsEmployee = $this->paginate($this->CommentsEmployee);

        $this->set(compact('commentsEmployee'));
    }

    /**
     * View method
     *
     * @param string|null $id Comments Employee id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $commentsEmployee = $this->CommentsEmployee->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('commentsEmployee'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $commentsEmployee = $this->CommentsEmployee->newEmptyEntity();
        if ($this->request->is('post')) {
            $commentsEmployee = $this->CommentsEmployee->patchEntity($commentsEmployee, $this->request->getData());
            if ($this->CommentsEmployee->save($commentsEmployee)) {
                $this->Flash->success(__('The comments employee has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The comments employee could not be saved. Please, try again.'));
        }
        $this->set(compact('commentsEmployee'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Comments Employee id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $commentsEmployee = $this->CommentsEmployee->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $commentsEmployee = $this->CommentsEmployee->patchEntity($commentsEmployee, $this->request->getData());
            if ($this->CommentsEmployee->save($commentsEmployee)) {
                $this->Flash->success(__('The comments employee has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The comments employee could not be saved. Please, try again.'));
        }
        $this->set(compact('commentsEmployee'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Comments Employee id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $commentsEmployee = $this->CommentsEmployee->get($id);
        if ($this->CommentsEmployee->delete($commentsEmployee)) {
            $this->Flash->success(__('The comments employee has been deleted.'));
        } else {
            $this->Flash->error(__('The comments employee could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
