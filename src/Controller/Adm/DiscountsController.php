<?php
namespace App\Controller\Adm;

use App\Controller\AppController;
use Cake\Utility\Text;
/**
 * Discounts Controller
 *
 * @property \App\Model\Table\DiscountsTable $Discounts
 *
 * @method \App\Model\Entity\Discount[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class DiscountsController extends AppController
{
    public function index() {
        //$this->paginate = [ 'contain' => ['Menus'] ];
        $data = $this->paginate($this->Discounts);
        $this->setData($data);
    }

    public function add() {
        
        $data = $this->Discounts->newEntity();
        
        if ($this->request->is('post')) {

            $d =$this->request->getData();
            $d['slug'] = $d['slug']=='' ? strtolower(Text::slug(@$d['nome'])) : strtolower(Text::slug(@$d['slug']));
            if(empty($d['ativo']) ) $d['ativo']=0;
           

            $data = $this->Discounts->patchEntity($data, $d);
            
            if ($this->Discounts->save($data)) {
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
        
        $data = $this->Discounts->get($id);
        
        if ($this->request->is(['patch', 'post', 'put'])) {
            
            $d =$this->request->getData();
            if(empty($d['imagem']) ) unset($d['imagem']);
            if(empty($d['ativo']) ) $d['ativo']=0;
            $d['slug'] = $d['slug']=='' ? strtolower(Text::slug(@$d['nome'])) : strtolower(Text::slug(@$d['slug']));
            
            $data = $this->Discounts->patchEntity($data, $d);

            if ($this->Discounts->save($data)) {
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
        $data = $this->Discounts->get($id);
        if ($this->Discounts->delete($data)) {
            $this->Flash->success('Ítem deletado com sucesso.');
        } else {
            $this->Flash->error('Ítem não pode ser deletado.');
            $this->error = $data->getError();
        }
        return $this->redirect(['action' => 'index']);
    }
}
