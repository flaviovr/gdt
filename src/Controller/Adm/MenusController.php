<?php
namespace App\Controller\Adm;

use App\Controller\AppController;
use Cake\Utility\Text;
/**
 * Menus Controller
 *
 * @property \App\Model\Table\MenusTable $Menus
 *
 * @method \App\Model\Entity\Menu[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class MenusController extends AppController
{
    
    public $paginate = [
        'limit' => 25,
        'sortWhitelist' => [
            'id', 'nome',  'ordem'
        ],
        'order' => [
            'ordem' => 'asc'
        ],
        'contain' => ['Regions']
    ];
    
    public function initialize() {
        parent::initialize();
        $this->Auth->deny();
    }

    public function index(){
        $data = $this->paginate($this->Menus);
        $this->setData($data);
    }

    public function add(){

        $data = $this->Menus->newEntity();
        
        if ($this->request->is('post')) {
            
            $d =$this->request->getData();
            $d['slug'] = $d['slug']=='' ? strtolower(Text::slug(@$d['nome'])) : strtolower(Text::slug(@$d['slug']));

            $data = $this->Menus->patchEntity($data, $d);
            
            if ($this->Menus->save($data)) {
                $this->Flash->success('Ítem salvo com sucesso');
                return $this->redirect(['action' => 'index']);
            }
            $this->error = $data->getErrors();
            $this->Flash->error('Erros de Validação encontrados.');
        }
//        

        $this->setData($data);
        $this->render('edit');
    }



    public function edit($id = null) {

        $data = $this->Menus->get($id);
        
        if ($this->request->is(['patch', 'post', 'put'])) {
            
            $d =$this->request->getData();
            $d['slug'] = $d['slug']=='' ? strtolower(Text::slug(@$d['nome'])) : strtolower(Text::slug(@$d['slug']));
            if(empty($d['imagem']) ) unset($d['imagem']);
            
            $data = $this->Menus->patchEntity($data, $d);

            if ($this->Menus->save($data)) {
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
        $data = $this->Menus->get($id);
        try{
            if ($this->Menus->delete($data)) {
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
