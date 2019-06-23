<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Discounts Controller
 *
 * @property \App\Model\Table\DiscountsTable $Discounts
 *
 * @method \App\Model\Entity\Discount[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class DiscountsController extends AppController
{
  
    public function index()
    {
      
        $this->page['titulo'] = 'Descontos';
        $this->setData([]);
    }

   
}
