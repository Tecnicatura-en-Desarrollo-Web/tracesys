<?php

declare(strict_types=1);

namespace App\Controller\Api;

use App\Controller\AppController;
use App\Controller\Traits\ResponseTrait;
use Cake\Mailer\Mailer;

/**
 * Providers Controller
 *
 * @property \App\Model\Table\ProvidersTable $Providers
 * @method \App\Model\Entity\Provider[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ProvidersController extends AppController
{
    use ResponseTrait;
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $providers = $this->paginate($this->Providers);

        $this->set(compact('providers'));
    }

    /**
     * View method
     *
     * @param string|null $id Provider id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $provider = $this->Providers->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('provider'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $provider = $this->Providers->newEmptyEntity();
        if ($this->request->is('post')) {
            $provider = $this->Providers->patchEntity($provider, $this->request->getData());
            $proveedor = $this->Providers->save($provider);
            if ($proveedor) {
                return $this->setJsonResponse(
                    [
                        'message' => true,
                        'idProveedor' => $proveedor["provider_id"],
                    ],
                );
            }
            $this->Flash->error(__('The provider could not be saved. Please, try again.'));
        }
        $this->set(compact('provider'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Provider id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $provider = $this->Providers->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $provider = $this->Providers->patchEntity($provider, $this->request->getData());
            if ($this->Providers->save($provider)) {
                $this->Flash->success(__('The provider has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The provider could not be saved. Please, try again.'));
        }
        $this->set(compact('provider'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Provider id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $provider = $this->Providers->get($id);
        if ($this->Providers->delete($provider)) {
            $this->Flash->success(__('The provider has been deleted.'));
        } else {
            $this->Flash->error(__('The provider could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function solicitarPresupuesto()
    {
        $dataVue = $this->request->getData();

        $proveedor = $this->Providers->get($dataVue['proveedor']);

        $mailer = new Mailer();
        $mailer->setTransport('gmail');
        $mailer
            ->setEmailFormat('html')
            ->setTo($proveedor['email'])

            ->setFrom(['tracesysapp@gmail.com' => 'Tracesys'])
            ->setSubject('Solicitud de presupuesto de producto')

            ->deliver('
                        <table>
                        <tr>
                        <img src="https://i.ibb.co/jZcV0Lb/logo-Tracesysy-Chiquito.png" alt="Logo del sistema" />
                                <hr>
                                <p>Hola ' . $proveedor['nombre'] . '! Somos del equipo de TraceSYS.</p>
                                <hr>
                                <p>' . $dataVue['mensaje'] . '.</p>
                                <p>En esta ocasión le solicitamos la cantidad del producto en mencion de: ' . $dataVue['cantidad'] . '</p>
                                <p>Desde ya muchas gracias. Saludos coordiales.</p>
                        </tr>
                        </table>
                ');
        $mailer->deliver();

        return $this->setJsonResponse(
            [
                'message' => true,
            ],
        );
    }
}