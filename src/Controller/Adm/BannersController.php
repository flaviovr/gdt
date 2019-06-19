<?php
namespace App\Controller\Adm;

use App\Controller\AppController;
use Cake\Utility\Text;

class BannersController extends AppController
{
    public $paginate = [ 'limit' => 25, 'order' => [ 'ordem' => 'asc' ], ];
    
    public function initialize() {
        parent::initialize();
        $this->Auth->deny();
    }

    public function index(){
        $data = $this->paginate($this->Banners);
        $this->setData($data);
    }

    public function add() {
        
        $data = $this->Banners->newEntity();
        
        if ($this->request->is('post')) {

            $d =$this->request->getData();
            if(empty($d['ativo']) ) $d['ativo']=0;
            if(empty($d['externo']) ) $d['externo']=0;

            $data = $this->Banners->patchEntity($data, $d);
            
            if ($this->Banners->save($data)) {
                $this->Flash->success('Ítem salvo com sucesso');
                return $this->redirect(['action' => 'index']);
            }
            $this->error = $data->getErrors();
            $this->Flash->error('Erros de Validação encontrados.');
        }
        $this->setData($data);
        $this->render('edit');
    }

    public function edit($id = null) {
        
        $data = $this->Banners->get($id);
        
        if ($this->request->is(['patch', 'post', 'put'])) {
            
            $d =$this->request->getData();
            if(empty($d['ativo']) ) $d['ativo']=0;
            if(empty($d['externo']) ) $d['externo']=0;
            
            $data = $this->Banners->patchEntity($data, $d);

            if ($this->Banners->save($data)) {
                $this->Flash->success('Ítem salvo com sucesso');
                return $this->redirect(['action' => 'index']);
            }
            $this->error = $data->getErrors();
            $this->Flash->error('Erros de Validação encontrados.');
        }
        $this->setData($data);
    }

    public function delete($id = null) {
        
        $this->request->allowMethod(['post', 'delete']);
        $data = $this->Banners->get($id);
        if ($this->Banners->delete($data)) {
            $this->Flash->success('Ítem deletado com sucesso.');
        } else {
            $this->Flash->error('Ítem não pode ser deletado.');
            $this->error = $data->getError();
        }
        return $this->redirect(['action' => 'index']);
    }
}
