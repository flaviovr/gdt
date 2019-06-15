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
        'limit' => 4,
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
    public function initialize()
    {
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
            if($item['region_id']) $where['Regions.id']=$item['region_id'];
            if($item['location_id']) $where['Locations.id']=$item['location_id'];
            if($item['category_id']) $where['Categories.id']=$item['category_id'];
            if($item['destaques']) $where['Posts.destaque']=$item['destaques'];
            $posts= $this->Posts->find('All')->contain(['Regions','Locations','Categories'])->where($where)->limit(4)->enableHydration(false)->toArray();
            $destaques[]=[
                'item' => $item,
                'posts'=> $posts
            ];
            
        }
        
        
        $banners = $this->Banners->find('ativo')->enableHydration(false)->toArray();
        
        $menus = $this->Menus->find()
        ->contain(['Regions'=>['sort'=>['Regions.ordem'=>'ASC']]])
        ->contain(['Regions.Locations'=>['sort'=>['Locations.ordem'=>'ASC']]])
        ->order(['Menus.ordem'=>'ASC'])
        ->enableHydration(false)->toArray();

        $descontos = $this->Discounts->find('ativo')->enableHydration(false)->toArray();
       

        $youtube = $this->Videos->find('all')->limit(4)->enableHydration(false)->toArray();
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
                'Videos' => 'Videos'
            ],
            'action' => [
                'add' => 'Novo Ítem',
                'edit' => 'Editar ítem',
                'delete' => 'Deletar',
                'login' => 'Login',
                'logout' => 'Logout',
                'index' => 'index'
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
        //$this->getInstagram();
        $f = new Folder('img');
        $file = new File($f->pwd().DS.'instagram.json',  true);
        $instagram = json_decode($file->read());
        
        return $instagram;
    }

    public function getInstagram($user='guiadetrips') {
        $instaFeed = 'https://rsshub.app/instagram/user/'.$user.'/?limit=8';
        $http = new Client();
        $response = $http->get($instaFeed);
        //debug($response);
        if($response->getStatusCode()==200) {
            $response = $response->getXml();
            $response = Xml::toArray($response->channel);
            $response = $response['channel']['item'];
            
            foreach($response as $k=>$post) {
                $ini = strpos( $post['description'] ,'<br><img referrerpolicy="no-referrer" src="') + strlen('<br><img referrerpolicy="no-referrer" src="');
                $img = substr($post['description'],$ini,-6) ;
                $response[$k]['imagem'] = $img;                
            }
            $f = new Folder('img');
            $file = new File($f->pwd().DS.'instagram.json',  true);
            $file->write(json_encode($response));
            $file->close();
            return true;
        }
        return false;
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
