<?php
namespace App\Controller\Adm;

use App\Controller\AppController;
use Cake\Utility\Text;

class RegionsController extends AppController
{
    
    public function initialize() {
        parent::initialize();
        $this->Auth->deny();
    }

    public function index(){
        $this->paginate = [ 'contain' => ['Menus'] ];
        $data = $this->paginate($this->Regions);
        $this->setData($data);
    }

    public function add(){

        $data = $this->Regions->newEntity();
        
        if ($this->request->is('post')) {
            
            $d =$this->request->getData();
            $d['slug'] = $d['slug']=='' ? strtolower(Text::slug(@$d['nome'])) : strtolower(Text::slug(@$d['slug']));

            $data = $this->Regions->patchEntity($data, $d);
            
            if ($this->Regions->save($data)) {
                $this->Flash->success('Ítem salvo com sucesso');
                return $this->redirect(['action' => 'index']);
            }
            $this->error = $data->getErrors();
            $this->Flash->error('Erros de Validação encontrados.');
        }
        $menus = $this->Menus->find('list', ['limit' => 200]);
        $this->setData(['data'=> $data,'menu'=>$menus]);

      //  $this->setData($data);
        $this->render('edit');
    }
    
    public function edit($id = null) {

        $data = $this->Regions->get($id);
        
        if ($this->request->is(['patch', 'post', 'put'])) {
            
            $d =$this->request->getData();
            $d['slug'] = $d['slug']=='' ? strtolower(Text::slug(@$d['nome'])) : strtolower(Text::slug(@$d['slug']));
            if(empty($d['imagem']) ) unset($d['imagem']);
            
            $data = $this->Regions->patchEntity($data, $d);

            if ($this->Regions->save($data)) {
                $this->Flash->success('Ítem salvo com sucesso');
                return $this->redirect(['action' => 'index']);
            }
            $this->error = $data->getErrors();
            $this->Flash->error('Erros de Validação encontrados.');
        }
        $menus = $this->Menus->find('list', ['limit' => 200]);
        $this->setData(['data'=> $data,'menu'=>$menus]);
        //$this->setData($data);
    }

    public function delete($id = null) {
        
        $this->request->allowMethod(['post', 'delete']);
        $data = $this->Regions->get($id);
        try{
            if ($this->Regions->delete($data)) {
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
