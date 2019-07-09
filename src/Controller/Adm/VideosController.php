<?php
namespace App\Controller\Adm;

use App\Controller\AppController;

/**
 * Videos Controller
 *
 * @property \App\Model\Table\VideosTable $Videos
 *
 * @method \App\Model\Entity\Video[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class VideosController extends AppController
{
    public $paginate = [
        'limit' => 25,
        'order' => [
            'Videos.ordem' => 'desc',   
        ]
    ];
    public function index(){
        $videos = $this->paginate($this->Videos);
        $this->setData($videos);
    }

    public function add() {
        
        $data = $this->Videos->newEntity();
        
        if ($this->request->is('post')) {

            $d =$this->request->getData();
            $data = $this->Videos->patchEntity($data, $d);
            
            if ($this->Videos->save($data)) {
                $this->Flash->success('Ítem salvo com sucesso');
                return $this->redirect(['action' => 'index']);
            }
            $this->error = $data->getErrors();
            $this->Flash->error('Erros de Validação encontrados.');
        }
        $this->setData($data);
        $this->render('edit');
    }

    public function edit($id = null) {
        
        $data = $this->Videos->get($id);
        
        if ($this->request->is(['patch', 'post', 'put'])) {
            
            $d =$this->request->getData();
            $data = $this->Videos->patchEntity($data, $d);

            if ($this->Videos->save($data)) {
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
        $data = $this->Videos->get($id);
        if ($this->Videos->delete($data)) {
            $this->Flash->success('Ítem deletado com sucesso.');
        } else {
            $this->Flash->error('Ítem não pode ser deletado.');
            $this->error = $data->getError();
        }
        return $this->redirect(['action' => 'index']);
    }
}
