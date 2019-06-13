<?php
namespace App\Controller\Adm;

use App\Controller\AppController;
use Cake\Utility\Text;
/**
 * Posts Controller
 *
 * @property \App\Model\Table\PostsTable $Posts
 *
 * @method \App\Model\Entity\Post[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PostsController extends AppController
{
  
    
    public function index(){
        $this->paginate = [ 'contain' => ['Regions', 'Locations', 'Categories', 'Discounts'] ];
        $data = $this->paginate($this->Posts);
        $this->setData($data);
    }

    public function add()
    {
        $data = $this->Posts->newEntity();
        
        if ($this->request->is('post')) {
            $d = $this->request->getData();
            $data = $this->Posts->patchEntity($data, $d);

           if ($this->Posts->save($data)) {
                $this->Flash->success('Ítem salvo com sucesso');
                return $this->redirect(['action' => 'index']);
            }
            $this->error = $data->getErrors();
            $this->Flash->error('Erros de Validação encontrados.');
        }
        $regions = $this->Posts->Regions->find('list', ['limit' => 200]);
        $locations = $this->Posts->Locations->find('list', ['limit' => 200]);
        $categories = $this->Posts->Categories->find('list', ['limit' => 200]);
        $discounts = $this->Posts->Discounts->find('list', ['limit' => 200]);
        $this->setData( ['data'=> $data,'regions'=>$regions,'locations'=>$locations,'categories'=>$categories,'discounts'=>$discounts] );
        $this->render('edit');
    }

    public function edit($id = null)
    {
        $data = $this->Posts->get($id);
        
        if ($this->request->is(['patch', 'post', 'put'])) {
            $d = $this->request->getData();
            $d['slug'] = $d['slug']=='' ? strtolower(Text::slug(@$d['titulo'])) : strtolower(Text::slug(@$d['slug']));
            if(empty($d['menu'])) $d['menu']=0;
            if(empty($d['ativo'])) $d['ativo']=0;
            if(empty($d['destaque'])) $d['destaque']=0;
            
            $data = $this->Posts->patchEntity($data, $d);
            //debug($data);
            if ($this->Posts->save($data)) {
                $this->Flash->success('Ítem salvo com sucesso');
                return $this->redirect(['action' => 'index']);
            }
            $this->error = $data->getErrors();
            $this->Flash->error('Erros de Validação encontrados.');
        }
        $regions = $this->Posts->Regions->find('list', ['limit' => 200]);
        $locations = $this->Posts->Locations->find('list', ['limit' => 200]);
        $categories = $this->Posts->Categories->find('list', ['limit' => 200]);
        $discounts = $this->Posts->Discounts->find('list', ['limit' => 200]);
        $this->setData( ['data'=> $data,'regions'=>$regions,'locations'=>$locations,'categories'=>$categories,'discounts'=>$discounts] );
    }

    
    public function delete($id = null) {
        
        $this->request->allowMethod(['post', 'delete']);
        $data = $this->Posts->get($id);
        if ($this->Posts->delete($data)) {
            $this->Flash->success('Ítem deletado com sucesso.');
        } else {
            $this->Flash->error('Ítem não pode ser deletado.');
            $this->error = $data->getError();
        }
        return $this->redirect(['action' => 'index']);
    }
}
