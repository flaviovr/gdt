<?php
namespace App\Controller\Adm;

use App\Controller\AppController;

/**
 * Newsletter Controller
 *
 *
 * @method \App\Model\Entity\Newsletter[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class EmailsController extends AppController
{
    public function index() {
        $data = $this->paginate($this->Emails);
        $this->setData($data);
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
