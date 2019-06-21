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

use Cake\Core\Configure;
use Cake\Http\Exception\ForbiddenException;
use Cake\Http\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;



/**
 * Static content controller
 *
 * This controller will render views from Template/Pages/
 *
 * @link https://book.cakephp.org/3.0/en/controllers/pages-controller.html
 */
class PagesController extends AppController
{

    /**
     * Displays a view
     *
     * @param array ...$path Path segments.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Http\Exception\ForbiddenException When a directory traversal attempt.
     * @throws \Cake\Http\Exception\NotFoundException When the view file could not
     *   be found or \Cake\View\Exception\MissingTemplateException in debug mode.
     */
    public function display(...$path)
    {
        $count = count($path);
        if (!$count) {
            return $this->redirect('/');
        }
        if (in_array('..', $path, true) || in_array('.', $path, true)) {
            throw new ForbiddenException();
        }
        $page = $subpage = null;

        if (!empty($path[0])) {
            $page = $path[0];
        }
        if (!empty($path[1])) {
            $subpage = $path[1];
        }
        $this->set(compact('page', 'subpage'));

        try {
            $this->render(implode('/', $path));
        } catch (MissingTemplateException $exception) {
            if (Configure::read('debug')) {
                throw $exception;
            }
            throw new NotFoundException();
        }
    }

    public function home(){
        $this->page['titulo'] = 'Home';
        
        $posts = $this->Posts->find('ativo')->limit(8)->where(['Posts.destaque'=>1])->order(['Posts.alterado_em'=>"DESC"])->toArray();
        $this->setData($posts);
        
    }

    public function buscar() {
        $termo = h($this->request->getQuery('termo'));
        $this->page['titulo'] = 'Buscar';
        $this->loadModel('Posts');
        $posts = $this->Posts->find('ativo')->limit(100)->where(['titulo like'=>'%'.$termo.'%'])->order(['Posts.menu_id'=>"ASC", 'Posts.alterado_em'=>'DESC'])->toArray();
        $this->setData($posts);
    }

    public function destinos($menu = null, $region = null, $location = null){
        
        if($menu) {
            $this->loadModel('Menus');          
            $menu = $this->Menus->findBySlug($menu);
            if( !$menu->count() ) return $this->redirect('/home');
            $menu = $menu->first();            
            $this->page['menu'] = $menu->slug ;
            $this->page['titulo'] .= " ".$menu->nome ;
            $this->page['imagem'] = $menu->imagem ;
            $where['Regions.menu_id']= $menu->id ;
        }  

        if($region) {
            //debug($region);
            $this->loadModel('Regions');            
            $regiao = $this->Regions->findBySlug($region);
            //if( !$regiao->count() ) return $this->redirect('/'.$menu->slug);
            $regiao = $regiao->first();            
            $this->page['regiao'] = $regiao->slug ;
            $this->page['titulo'] .= " > ".$regiao->nome ;
            $this->page['imagem'] = $regiao->imagem ;
            $where['Regions.id']= $regiao->id ;
        } 

        if($location) {
            $this->loadModel('Locations');
            $local = $this->Locations->find('all',['contain'=>'Regions'])->where(['Locations.slug'=>$location, 'Regions.id'=>$regiao->id]);
            //if( !$local->count() ) return $this->redirect('/'.$menu->slug.'/'.$regiao->slug);
            $local = $local->first();
            $this->page['local'] = $local->slug;
            $this->page['titulo'] .= ' > '.$local->nome ;
            $this->page['imagem'] = $local->imagem ;
            $where['Locations.id']= $local->id ;
        }

        $this->loadModel('Categories');
        
        if($category = $this->request->getQuery('category')){
            //debug($category);
            $category = $this->Categories->find('all',['contain'=>'Menus'])->where(['Categories.slug'=>$category, 'Menus.id'=>$menu->id]);
            if( !$category->count() ) return $this->redirect('/'.$menu->slug);
            $category = $category->first();
            $this->page['categoria'] = $category->slug;
            $this->page['titulo'] .= ' > '.$category->nome ;
            $where['Categories.id']= $category->id ;
        }
        $categorias = $this->Categories->find()->select(['Categories.nome','Categories.id','Categories.slug'])->contain('Menus')->where(['Menus.id'=>$menu->id])->enableHydration(false)->toArray();
        
        $this->loadModel('Posts');
        $posts = $this->Posts->find('ativo')->contain(['Menus','Regions','Locations','Categories'])->where($where)->order(['Posts.alterado_em'=>'desc']);
        if($category && $posts->count()==0) {
            $this->Flash->warning('Nenhum ítem na categoria selecionada.');
            $slug = $menu ? '/'.$menu->slug: '';
            $slug .= @$regiao ? '/'.$regiao->slug: '';
            $slug .= @$local ? '/'.$local->slug: '';
            return $this->redirect($slug);           
        }
        
        $posts = $this->paginate($posts);

        $this->setData(['posts'=>$posts, 'categorias'=>$categorias]);
        
    }
    public function artigo($id,$slug){
        
        
        $this->loadModel('Messages');
        $this->loadModel('Posts');
        $message = $this->Messages->newEntity();

        if ($this->request->is('post')) {
            $r = $this->request->getData();
            $message = $this->Messages->patchEntity($message,$r);
            if ($this->Messages->save($message)) {
                $this->Flash->success('Mensagem enviada com sucesso.');
                //$this->enviaEmail($message);
            }
            $this->error = $message->getErrors();
            $this->Flash->error('Erros ao enviar. Tente novamente..');
        }

        try {
            $data = $this->Posts->get($id, ['contain'=>['Menus','Regions', 'Locations', 'Categories', 'Discounts']]);
            $this->page['titulo'] = $data->titulo;
            $this->setData(['data'=>$data,'message'=>$message]);
        } catch (\Exception $e ){
            debug($e);
        }
       
    }
    public function sobre(){
        $this->page['titulo'] = 'Sobre o Guia de Trips';
        $this->setData([]);
    }

    public function contato(){
        $this->loadModel('Messages');
        $data = $this->Messages->newEntity();
       
        if ($this->request->is('post')) {
            $r = $this->request->getData();
            $data = $this->Messages->patchEntity($data,$r);
            if ($this->Messages->save($data)) {
                $this->Flash->success('Mensagem enviada com sucesso.');
                //$this->enviaEmail($message);
                return $this->redirect(['action' => 'contato']);
            }
            $this->error = $data->getErrors();
            $this->Flash->error('Erros ao enviar. Tente novamente..');
        }
        $this->page['titulo'] = 'Fale com a Gente';
        $this->setData($data);
    }


    public function tapume(){
        $this->viewBuilder()->setLayout(false);
    }

   
}
