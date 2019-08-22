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
use Cake\Filesystem\File;
use Cake\Filesystem\Folder;
use Cake\I18n\Time;
use Cake\Http\Client;
use Cake\Utility\Xml;
use Cake\Mailer\Email;


/**
 * Static content controller
 *
 * This controller will render views from Template/Pages/
 *
 * @link https://book.cakephp.org/3.0/en/controllers/pages-controller.html
 */
class PagesController extends AppController
{

   
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
            if( !$menu->count() ) return $this->redirect('/');
            $menu = $menu->first();            
            $this->page['menu'] = $menu->slug ;
            $this->page['titulo'] .= " ".$menu->nome ;
            $this->page['imagem'] = $menu->imagem ;
            $where['Menus.id']= $menu->id ;
        }  

        if($region) {
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
        
        $posts = $this->Posts->find('ativo')->contain(['Tags','Menus','Regions','Locations','Categories'])->where($where)->order(['Posts.alterado_em'=>'desc']);
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

    public function tags($tag){
        $this->loadModel('Posts');
        $this->loadModel('Tags');
        $tag = $this->Tags->find('all')->where(['Tags.slug'=>$tag])->first();
       ;
        if($tag) {
            $posts = $this->Posts->find('ativo')->contain(['Tags','Menus','Regions','Locations','Categories'])->order(['Posts.alterado_em'=>'desc']);
            $posts->matching('Tags', function ($q) use ($tag){ return $q->where( ['Tags.id' =>$tag->id ] ) ;} );
            $posts = $this->paginate($posts);
            $this->page['titulo'] = 'Tag: ';
            $this->setData($posts);
        } else {
            $this->Flash->error('Tag não existe.');
            return $this->redirect('/');
        }       
        
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
            $data = $this->Posts->get($id, ['contain'=>['Tags','Menus','Regions', 'Locations', 'Categories', 'Discounts']]);
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

    public function mandaEmail($data){
        
        $email = new Email('default');
        
        $email->from([$data['email'] => $data['nome']]);  
        $email->to('flaviovr@gmail.com');
        $email->subject($data['assunto']);
        $email->send($data['message']);
       
    }


    public function contato(){
        $this->loadModel('Messages');
        $data = $this->Messages->newEntity();
        
        if ($this->request->is('post')) {
            $r = $this->request->getData();
            $data = $this->Messages->patchEntity($data,$r);
            $this->mandaEmail($r);
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

    public function newsletter() {
        
        if ($this->request->is('post')) {
            $email = $this->request->getData('news_email');
            $data = [ 'success'=>true, 'erro' =>'Email vazio' ];
            if($email) {
                $this->loadModel('Emails');
                $new= $this->Emails->newEntity(['email'=>$email]);
                if($this->Emails->save($new)) {
                    $data = [ 'success'=>true, 'erro' =>false ];
                } else {
                    $data = [ 'success'=>false, 'erro' => 'Email já cadastrado' ];
                }
            } 
        } else {
            $data = [ 'success'=>false, 'erro' => 'Erro ao enviar. Tente novamente!' ];
        }
        $response = $this->response;
        $response = $response->withType('application/json')->withStringBody(json_encode($data));
        return $response;
        
    }

    public function tapume(){
        $this->viewBuilder()->setLayout(false);
    }

    public function clean(){
        $this->loadModel('Banners');
        $this->loadModel('Descontos');
        $this->loadModel('Posts');
        $banners = $this->Banners->find('list', ['valueField'=>'imagem'])->enableHydration(false)->toArray();
        $descontos = $this->Discounts->find('list', ['valueField'=>'imagem'])->enableHydration(false)->toArray();
        
        //debug($banners);
        

        $f = new Folder('img/banners');
        $a = new Folder('img/banners/arquivo');
        $files = $f->find('.*\.*');
        foreach($files as $file) {
            if(!in_array($file, $banners)) {
                $file = new File($f->pwd() . DS . $file);
                $file->copy($a->pwd().DS.$file->name, true);
                $file->delete();
            }
        }

        $f = new Folder('img/descontos');
        $a = new Folder('img/descontos/arquivo');
        $files = $f->find('.*\.*');
        foreach($files as $file) {
            if(!in_array($file, $descontos)) {
                $file = new File($f->pwd() . DS . $file);
                $file->copy($a->pwd().DS.$file->name, true);
                $file->delete();
            }
        }
        
        $posts = $this->Posts->find('list', ['valueField'=>'imagem'])->enableHydration(false)->toArray();
        $f = new Folder('img/posts');
        $a = new Folder('img/posts/arquivo');
        $files = $f->find('.*\.*');
        foreach($files as $file) {
            if(!in_array($file, $posts)) {
                $file = new File($f->pwd() . DS . $file);
                $file->copy($a->pwd().DS.$file->name, true);
                $file->delete();
            }
        }

        
        $thumb = $this->Posts->find('list', ['valueField'=>'thumb'])->enableHydration(false)->toArray();
        $f = new Folder('img/posts/thumb');
        $a = new Folder('img/posts/arquivo/thumb');
        $files = $f->find('.*\.*');
        foreach($files as $file) {
            if(!in_array($file, $thumb)) {
                $file = new File($f->pwd() . DS . $file);
                $file->copy($a->pwd().DS.$file->name, true);
                $file->delete();
            }
        }
        
        $this->loadModel('Menus');
        $this->loadModel('Regions');
        $this->loadModel('Locations');
        $m = $this->Menus->find('list', ['valueField'=>'imagem'])->enableHydration(false)->toArray();
        $r = $this->Regions->find('list', ['valueField'=>'imagem'])->enableHydration(false)->toArray();
        $l = $this->Locations->find('list', ['valueField'=>'imagem'])->enableHydration(false)->toArray();

        $headers = array_merge($m,$l,$r);
        $f = new Folder('img/headers');
        $a = new Folder('img/headers/arquivo');
        $files = $f->find('.*\.*');
        foreach($files as $file) {
            if(!in_array($file, $headers)) {
                $file = new File($f->pwd() . DS . $file);
                $file->copy($a->pwd().DS.$file->name, true);
                $file->delete();
            }
        }
        $this->viewBuilder()->setLayout(false);
        $this->render(false);

    }

    public function getInstagram($user='guiadetrips') {

        // $http = new Client();
        // $response = $http->get('https://www.instagram.com/guiadetrips/');
        // debug($response->getStringBody());
        // $doc = new \DOMDocument();
        // $doc->loadHTML(mb_convert_encoding($response->getStringBody(), 'HTML-ENTITIES', "UTF-8"));
        // if($doc){
        //     debug($doc->getElementById('#react-root'));
        // }
        
        // die();

        $instaFeed = 'https://rsshub.app/instagram/user/'.$user.'?limit=8';
        $http = new Client();
        $response = $http->get($instaFeed);
       
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
            $this->log('Execução OK!');
            $this->log($response);
            
        } else {
            $this->log('Erro de execução');
            $this->log($response);
        }
        $this->viewBuilder()->setLayout(false);
        $this->render(false);
        return null;
    }
   

}
