<?php
namespace App\Controller\Adm;

use App\Controller\AppController;


class UsersController extends AppController
{
    
    public function initialize() {
        parent::initialize();
        $this->Auth->allow(['login','logout']);
    }


    public function index(){
        $data = $this->paginate($this->Users);
        $this->setData($data);
    }


    public function login() {
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            
            if ($user) {
                $this->Auth->setUser($user);
                $r = $this->request->getQuery('redirect');
                // return $this->redirect(['controller'=>'Pages','action'=>'home','prefix'=>'adm']);
                return $this->redirect($r);
            }
            $this->Flash->error('Username ou password está incorreto.');
        }
        $this->viewBuilder()->setLayout(false);
    }


    public function logout() {
        $this->Flash->success('Logout efetuado com sucesso.');
        return $this->redirect($this->Auth->logout());
    }

   
   public function delete($id = null) {
        
        $this->request->allowMethod(['post', 'delete']);
        $data = $this->Users->get($id);
        if ($this->Users->delete($data)) {
            $this->Flash->success('Ítem deletado com sucesso.');
        } else {
            $this->Flash->error('Ítem não pode ser deletado.');
            $this->error = $data->getError();
        }
        return $this->redirect(['action' => 'index']);
    }
}
