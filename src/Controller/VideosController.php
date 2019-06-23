<?php
namespace App\Controller;

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
        'limit' => 24,
        
        'order' => [
            'id' => 'desc'
        ],
        
    ];

    public function index()
    {
        $videos = $this->paginate($this->Videos);
        $this->page['titulo'] = 'Vídeos';
        $this->setData($videos);
    }

}
