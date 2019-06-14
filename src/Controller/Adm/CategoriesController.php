<?php
namespace App\Controller\Adm;

use App\Controller\AppController;
use Cake\Utility\Text;

class CategoriesController extends AppController
{
    
    public $paginate = [
        'limit' => 25,
        'sortWhitelist' => [
            'id', 'nome', 'Menus.ordem', 'ordem'
        ],
        'order' => [
            'Menus.ordem' => 'asc',
            'nome' => 'asc'
        ],
        'contain' => ['Menus'] 
    ];
    
    public function index() {
        $data = $this->paginate($this->Categories);
        $this->setData($data);
    }
   
    public function add() {
        
        $data = $this->Categories->newEntity();
        
        if ($this->request->is('post')) {

            $d =$this->request->getData();
            $d['slug'] = $d['slug']=='' ? strtolower(Text::slug(@$d['nome'])) : strtolower(Text::slug(@$d['slug']));
            if(empty($d['menu'])) $d['menu']=0;
            $d['ordem'] = empty($d['ordem']) ? 9999 : intval($d['ordem']);

            $data = $this->Categories->patchEntity($data, $d);
            
            if ($this->Categories->save($data)) {
                $this->Flash->success('Ítem salvo com sucesso');
                return $this->redirect(['action' => 'index']);
            }
            $this->error = $data->getErrors();
            $this->Flash->error('Erros de Validação encontrados.');
        }
        $menus = $this->Menus->find('list', ['limit' => 200]);
        $this->setData(['data'=> $data,'menus'=>$menus]);
        $this->render('edit');
    }

    public function edit($id = null)
    {
        $data = $this->Categories->get($id);
        
        if ($this->request->is(['patch', 'post', 'put'])) {
            
            $d = $this->request->getData();
            $d['slug'] = $d['slug']=='' ? strtolower(Text::slug(@$d['nome'])) : strtolower(Text::slug(@$d['slug']));
            if(empty($d['menu'])) $d['menu']=0;
            $d['ordem'] = empty($d['ordem']) ? 9999 : intval($d['ordem']);

            $data = $this->Categories->patchEntity($data, $d);
            
            if ($this->Categories->save($data)) {
                $this->Flash->success('Ítem salvo com sucesso');
                return $this->redirect(['action' => 'index']);
            }
            $this->error = $data->getErrors();
            $this->Flash->error('Erros de Validação encontrados.');
            
        }
        $menus = $this->Menus->find('list', ['limit' => 200]);
        $this->setData(['data'=> $data,'menus'=>$menus]);
      
    }

    public function delete($id = null) {
        
        $this->request->allowMethod(['post', 'delete']);
        $data = $this->Categories->get($id);
        try{
            if ($this->Categories->delete($data)) {
                $this->Flash->success('Ítem deletado com sucesso.');
            } else {
                $this->Flash->error('Ítem não pode ser deletado.');
                $this->error = $data->getError();
            }
        } catch (\PDOException $e) {
            $this->Flash->error('Esse ítem não pode ser deletado');
        }
        
        return $this->redirect(['action' => 'index']);
    }
}
