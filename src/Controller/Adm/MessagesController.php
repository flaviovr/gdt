<?php
namespace App\Controller\Adm;

use App\Controller\AppController;

/**
 * Messages Controller
 *
 * @property \App\Model\Table\MessagesTable $Messages
 *
 * @method \App\Model\Entity\Message[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class MessagesController extends AppController
{
    public $paginate = [
        'limit' => 25,
        'order' => [
            'lida' => 'asc',
            'data'=> 'asc'
        ]
    ];
    public function initialize() {
        parent::initialize();
        $this->Auth->deny();
    }

    public function index() {
        $data = $this->paginate($this->Messages);
        $this->setData($data);
    }
    public function view($id = null)
    {
        $message = $this->Messages->get($id, [
            'contain' => []
        ]);
        $message->lida = true;
        $this->Messages->save($message);

        $this->setData( $message);
    }

   
    public function delete($id = null) {
        
        $this->request->allowMethod(['post', 'delete']);
        $data = $this->Messages->get($id);
        if ($this->Messages->delete($data)) {
            $this->Flash->success('Ítem deletado com sucesso.');
        } else {
            $this->Flash->error('Ítem não pode ser deletado.');
            $this->error = $data->getError();
        }
        return $this->redirect(['action' => 'index']);
    }
}
