<?php
namespace App\Controller\Adm;

use App\Controller\AppController;

/**
 * Pages Controller
 *
 *
 * @method \App\Model\Entity\Page[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PagesController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->Auth->deny();
    }
    public function home(){
        $this->loadModel('Configurations');
        if ($this->request->is('post')) {
            
            try {
                
                $data=$this->request->getData('socialMedia');       
                $config1 = $this->Configurations->get(1);
                $json=json_decode($config1->data,true);
                $entity=[];
                foreach($json as $k=>$v) $entity[$k] = !empty($data[$k]) ? $data[$k] : $v ;      
                $json = json_encode($entity);
                $config1['data'] = $json;
                
                $data=$this->request->getData('destaques');
                $config2 = $this->Configurations->get(2);
                $json=json_decode($config2->data,true);
                $entity=[];
                foreach($json as $key=>$value) foreach($value as $k=>$v) $entity[$key][$k] = !empty($data[$k]) ? $data[$k] : $v ;
                $json = json_encode($entity);
                $config2['data'] = $json;
                
                $data=$this->request->getData('site');
                $config3 = $this->Configurations->get(3);
                $json=json_decode($config3->data,true);
                $entity=[];
                foreach($json as $k=>$v) $entity[$k] = !empty($data[$k]) ? $data[$k] : $v ;
                $json = json_encode($entity);
                $config3['data'] = $json;
                
                
                // debug($config1);
                //debug($config2);

                if ($this->Configurations->saveMany([$config1,$config2,$config3])) {
                    $this->Flash->success('Configurações salvas.');
                    return $this->redirect(['action' => 'home']);
                } else {
                    $this->Flash->error("Erro ao salvar Configurações");
                }          
                
            } catch (\Cake\Datasource\Exception\RecordNotFoundException $e){
                
                $data = [
                    'success' => false,
                    'msg'=> 'Registro id:'.$id.' não encontrado',
                    'errors'=>   [$e->getMessage()]
                ];
               
            }


        
        }
        $menus = $this->Menus->find('list', ['limit' => 200]);
        $regions = $this->Posts->Regions->find()->select(['Menus.nome','Regions.nome','Regions.menu_id','Regions.id'])->limit(200)->contain('Menus');
        $locations = $this->Posts->Locations->find()->select(['Regions.nome','Locations.nome','Locations.region_id','Locations.id'])->limit(200)->contain('Regions');
        $categories = $this->Posts->Categories->find()->select(['Menus.nome','Categories.nome','Categories.menu_id','Categories.id'])->limit(200)->contain('Menus');
        $discounts = $this->Posts->Discounts->find('list', ['limit' => 200]);
        $this->setData( ['data'=> [],'menus'=>$menus,'regions'=>$regions,'locations'=>$locations,'categories'=>$categories,'discounts'=>$discounts] );
        
    }
}
