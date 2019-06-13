<?php
namespace App\Controller\Adm;

use App\Controller\AppController;
use Cake\Utility\Text;
/**
 * Locations Controller
 *
 * @property \App\Model\Table\LocationsTable $Locations
 *
 * @method \App\Model\Entity\Location[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class LocationsController extends AppController
{
    
    public function initialize() {
        parent::initialize();
        $this->Auth->deny();
    }
    
    public function index(){
        $this->paginate = [ 'contain' => ['Regions.Menus'] ];
        $data = $this->paginate($this->Locations);
        $this->setData($data);
    }

    public function add() {
        $data = $this->Locations->newEntity();
        
        if ($this->request->is('post')) {

            $d =$this->request->getData();
            $d['slug'] = $d['slug']=='' ? strtolower(Text::slug(@$d['nome'])) : strtolower(Text::slug(@$d['slug']));

            $data = $this->Locations->patchEntity($data, $d);
            
            if ($this->Locations->save($data)) {
                $this->Flash->success('Ítem salvo com sucesso');
                return $this->redirect(['action' => 'index']);
            }
            $this->error = $data->getErrors();
            $this->Flash->error('Erros de Validação encontrados.');
        }
        $regions = $this->Locations->Regions->find('list', ['limit' => 200]);
        $this->setData(['data'=> $data,'regions'=>$regions]);
        $this->render('edit');
      
    }
 
    public function edit($id = null) {
        $data = $this->Locations->get($id);

        if ($this->request->is(['patch', 'post', 'put'])) {
            
            $d = $this->request->getData();
            $d['slug'] = $d['slug']=='' ? strtolower(Text::slug(@$d['nome'])) : strtolower(Text::slug(@$d['slug']));
            
            $data = $this->Locations->patchEntity($data, $d);
            
            if ($this->Locations->save($data)) {
                $this->Flash->success('Ítem salvo com sucesso');
                return $this->redirect(['action' => 'index']);
            }
            $this->error = $data->getErrors();
            $this->Flash->error('Erros de Validação encontrados.');
            
        }
        $regions = $this->Locations->Regions->find('list', ['limit' => 200]);
        $this->setData(['data'=> $data,'regions'=>$regions]);
    }

    
    public function delete($id = null) {
        
        $this->request->allowMethod(['post', 'delete']);
        $data = $this->Locations->get($id);
        try{
            if ($this->Locations->delete($data)) {
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
