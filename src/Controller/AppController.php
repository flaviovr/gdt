<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\Utility\Xml;

use Cake\Http\Client;
use Cake\Filesystem\File;
use Cake\Filesystem\Folder;
use Cake\I18n\Time;
//use Vinkla\Instagram\Instagram;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{

    public $paginate = [
        'limit' => 24,
        // 'order' => [
        //     'Articles.title' => 'asc'
        // ]
    ];
    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    public function initialize() {
        parent::initialize();
        
        $this->loadComponent('Paginator');
        $this->loadComponent('Flash');

        $this->loadComponent('RequestHandler', [
            'enableBeforeRedirect' => false,
        ]);
       

        if($this->request->getParam('prefix') =='adm') {
            $this->loadComponent('Auth', [
                'authenticate' => [
                    'Form' => [ 
                        'userModel' => 'Users',
                     ],
                ],
                'loginAction' =>  [
                    'controller' => 'Users',
                    'action' => 'login',
                    'prefix'=>'adm'
                ],
                'checkAuthIn' => 'Controller.initialize',
            ]);
            $this->viewBuilder()->setLayout('adm');
        } 
        
        $this->getConfigData();
                
        
        
        /*
         * Enable the following component for recommended CakePHP security settings.
         * see https://book.cakephp.org/3.0/en/controllers/components/security.html
         */
        //$this->loadComponent('Security');
    }

    private function getConfigData(){
        

        $this->loadModel('Configurations');
        $this->loadModel('Banners');
        $this->loadModel('Discounts');
        $this->loadModel('Regions');
        $this->loadModel('Posts');
        $this->loadModel('Menus');
        $this->loadModel('Videos');

      
        $socialMedia = $this->Configurations->findByNome('socialMedia')->first();
        $site = $this->Configurations->findByNome('site')->first();
        $home = $this->Configurations->findByNome('home')->first();
        $configHome = json_decode($home['data'],true);

        $destaques=[];
        foreach($configHome['destaques'] as $item) {
           
            //$where = [];
            if(@$item['menu_id']>0) $where['Menus.id']=$item['menu_id'];
            if(@$item['region_id']>0) $where['Regions.id']=$item['region_id'];
            if(@$item['location_id']>0) $where['Locations.id']=$item['location_id'];
            if(@$item['category_id']>0) $where['Categories.id']=$item['category_id'];
            if(@$item['destaques']>0) $where['Posts.destaque']=$item['destaques'];
           
            $posts= $this->Posts->find('ativo')->contain(['Menus','Regions','Locations','Categories'])->where($where)->order(['alterado_em'=>'desc'])->limit(4)->enableHydration(false)->toArray();
            $destaques[]=[
                'item' => $item,
                'posts'=> $posts
            ];
            
        }
        
        
        $banners = $this->Banners->find('ativo')->order(['Banners.ordem'=>'ASC'])->enableHydration(false)->toArray();
        
        $menus = $this->Menus->find()
        ->contain(['Regions'=>['sort'=>['Regions.ordem'=>'ASC']]])
        ->contain(['Regions.Locations'=>['sort'=>['Locations.ordem'=>'ASC']]])
        ->where('id not in(3)')
        ->order(['Menus.ordem'=>'ASC'])
        ->enableHydration(false)->toArray();
        
        //debug($ms);

        
        $servicos = $this->Posts->findByMenuId(3)->enableHydration(false)->toArray();
        
        $descontos = $this->Discounts->find('ativo')->order(['validade'=>'asc'])->enableHydration(false)->toArray();
       
        $youtube = $this->Videos->find('all')->order(['Videos.id'=>"DESC"])->limit(4)->enableHydration(false)->toArray();
        $instagram = $this->loadInstagram();

        $this->config =  [
            'site' =>  json_decode($site->data,true),
            'topbar' => [
                'socialMedia' => json_decode($socialMedia->data,true),
                'descontos' => $descontos, 
            ],
            'navbar' => [
                'rota' => $this->request->getParam('_matchedRoute'), 
                //'destinos' => $destinos,
                'categorias' => null,
                'menus'=>$menus,
                'servicos'=>$servicos
            ],
            'banners' => $banners,
            'home' => ['destaques'=> $destaques],
            'instagram' =>  $instagram,
            'youtube' => $youtube
        ];
        $referencias = [
            'controller' =>[
                'Banners' =>'Banners',
                'Regions' => 'Regiões',
                'Locations' => 'Locais',
                'Categories'=> 'Categorias',
                'Tags' =>'Tags',
                'Users'=> 'Usuários',
                'Posts'=> 'Posts',
                'Menus' => 'Menus',
                'Discounts' => 'Descontos',
                'Videos' => 'Videos',
                'Messages' => 'Mensagens',
                'Emails' => 'Mail List'
            ],
            'action' => [
                'add' => 'Novo Ítem',
                'edit' => 'Editar ítem',
                'delete' => 'Deletar',
                'login' => 'Login',
                'logout' => 'Logout',
                'index' => 'index',
                'view'=> 'Ver Ítem'
            ]
        ];
        
        $this->page = [ 
            'controller'=> $this->request->getParam('controller'),
            'action'=> $this->request->getParam('action'),
            'prefix' =>$this->request->getParam('prefix'),
            'pagina'=> $this->request->getParam('action'),
            'imagem'=>null,
            'titulo' => null,
            'menu'=> $this->request->getParam('menu'),
            'local'=> $this->request->getParam('location'),
            'regiao' => $this->request->getParam('region'),
            'categoria'=>$this->request->getParam('category'),
        ];

        if($this->request->getParam('prefix')=='adm') {
            if($this->request->getParam('action')=='home'){
                $this->page['titulo'] = 'Início';
            } else if ($this->request->getParam('action')=='index'){
                $this->page['titulo'] = $referencias['controller'][$this->page['controller']];
            } else {
                $this->page['titulo'] = $referencias['controller'][$this->page['controller']].' > '.$referencias['action'][$this->page['action']];
            }  
        } 
    }

    public function loadInstagram(){

        $f = new Folder('img');
        $file = new File($f->pwd().DS.'instagram.json',  true);
        $instagram = json_decode($file->read());
        
        return $instagram;
    }

    public function setData($data = []){
        $data = [
            'page' => $this->page,
            'config' => $this->config,
            'data' => $data
        ];
        if(@$this->error) $data['error'] = $this->error;
        $this->set($data);
    }
}
