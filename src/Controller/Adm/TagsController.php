<?php
namespace App\Controller\Adm;

use App\Controller\AppController;
use Cake\Utility\Text;

class TagsController extends AppController
{
    
    public function initialize() {
        parent::initialize();
        $this->Auth->deny();
    }

    public function index() {
        $data = $this->paginate($this->Tags);
        $this->setData($data);
    }

    public function add() {
        
        $data = $this->Tags->newEntity();
        
        if ($this->request->is('post')) {

            $d =$this->request->getData();
            $d['slug'] = $d['slug']=='' ? strtolower(Text::slug(@$d['nome'])) : strtolower(Text::slug(@$d['slug']));
            
            $data = $this->Tags->patchEntity($data, $d);
            
            if ($this->Tags->save($data)) {
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
        
        $data = $this->Tags->get($id);
        
        if ($this->request->is(['patch', 'post', 'put'])) {
            
            $d =$this->request->getData();
            $d['slug'] = $d['slug']=='' ? strtolower(Text::slug(@$d['nome'])) : strtolower(Text::slug(@$d['slug']));

            $data = $this->Tags->patchEntity($data, $d);

            if ($this->Tags->save($data)) {
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
        $data = $this->Tags->get($id);
        if ($this->Tags->delete($data)) {
            $this->Flash->success('Ítem deletado com sucesso.');
        } else {
            $this->Flash->error('Ítem não pode ser deletado.');
            $this->error = $data->getError();
        }
        return $this->redirect(['action' => 'index']);
    }
}
