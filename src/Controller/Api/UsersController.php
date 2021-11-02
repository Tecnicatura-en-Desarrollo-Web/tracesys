<?php

declare(strict_types=1);

namespace App\Controller\api;

use App\Controller\AppController;
use App\Controller\Traits\ResponseTrait;
use Cake\Mailer\Mailer;

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

        $dataVue = $this->request->getData();
        $user = $this->Users->newEmptyEntity();
        $user = $this->Users->patchEntity($user, $this->request->getData());
        $result = $this->Users->save($user);
        if ($result !== false) {

            /* Este id es el ID del usuario que recien se acaba de registrar y se utilizara para activar su cuenta */
            $user_id_cargado = $result["user_id"];

            $mailer = new Mailer();
            $mailer->setTransport('gmail');
            $mailer
                ->setEmailFormat('html')
                ->setTo($dataVue["email"])
                ->setFrom(['tracesysapp@gmail.com' => 'Tracesys'])
                ->setSubject('Su cuenta ha sido activada')

                ->deliver('cuenta activada. Por favor ingrese a la siguiente url http://localhost:8765/activacion/'.$user_id_cargado);
            $mailer->deliver();

            return $this->setJsonResponse(
                [
                    'data' => $result,
                    'success' => true,
                    'url' => '/login',/*  */
                    'message' => __('The post has been saved.'),
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
                'contain' => ['Sectors.Stages'],
            ];
            $data['users'] = $this->paginate($this->Users);
            foreach ($data['users'] as $cadaUser) {
                if ($cadaUser["email"] == $dataVue["email"] && $cadaUser["password"] == $dataVue["contrasena"]) {
                    return $this->setJsonResponse(
                        [
                            'message' => true,
                            'user' => $cadaUser["nombre"] . " " . $cadaUser["apellido"],
                            'user_id' => $cadaUser["user_id"],
                            'nombre_sector' => $cadaUser["sector"]["nombre_sector"],
                            'sector_id' => $cadaUser["sector"]["sector_id"],
                            'nombre_etapa' => $cadaUser["sector"]["stage"]["nombre_etapa"],
                            'etapa_id' => $cadaUser["sector"]["stage"]["stage_id"],
                            'cuit' => $cadaUser["cuit"],
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

    public function activacionEmail()
    {
        $dataVue =  $this->request->getData();
        $user_id =  $dataVue["user_id"];

        $user = $this->Users->get($user_id);

        $newData = [
            "activo" => 1,
        ];

        $userActualizado = $this->Users->patchEntity($user, $newData);

        if ($this->Users->save($user)) {
            return $this->setJsonResponse(
                [
                    'success' => "true",
                ],
                201
            );
        }
    }
}
