<?php

declare(strict_types=1);

namespace App\Controller\api;

use App\Controller\AppController;
use App\Controller\Traits\ResponseTrait;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{
    use ResponseTrait;
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $data['users'] = $this->paginate($this->Users);
        return $this->setJsonResponse($data);
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => [],
        ]);

        return $this->setJsonResponse(['user' => $user]);
    }
    public function save()
    {
        if (!$this->request->is('post')) {
            return $this->setJsonResponse([
                'error' => true,
                'message' => 'Invalid request!',
            ]);
        }

        $user = $this->Users->newEmptyEntity();
        $user = $this->Users->patchEntity($user, $this->request->getData());
        // return $this->setJsonResponse([
        //     'aca jonaaaaaaaaaa' => $user,
        // ]);
        $result = $this->Users->save($user);
        if ($result !== false) {
            return $this->setJsonResponse(
                [
                    'data' => $result,
                    'success' => true,
                    'url' => '/login',
                    'message' => __('The post has been saved.'),
                ],
                201
            );
        }

        return $this->setJsonResponse(
            [
                'errors' => $user->getValidationErrors(),
                'message' => __('The post could not be saved. Please, try again.'),
            ],
            422
        );
    }
    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEmptyEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function login()
    {
        $dataVue =  $this->request->getData();

        if ($this->request->is('post')) {
            $this->paginate = [
                'contain' => ['Sectors'],
            ];
            $data['users'] = $this->paginate($this->Users);
            foreach ($data['users'] as $cadaUser) {
                if ($cadaUser["email"] == $dataVue["email"] && $cadaUser["password"] == $dataVue["contrasena"]) {
                    return $this->setJsonResponse(
                        [
                            'message' => true,
                            'user' => $cadaUser["nombre"]." ".$cadaUser["apellido"],
                            'user_id' => $cadaUser["user_id"],
                            'nombre_sector' => $cadaUser["sector"]["nombre_sector"],
                            'sector_id' => $cadaUser["sector"]["sector_id"],
                        ]
                    );
                }
            }
            return $this->setJsonResponse(
                [
                    'message' => false,
                ]
            );
        }
    }
}
