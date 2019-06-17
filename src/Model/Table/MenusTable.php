<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Utility\Text;

class MenusTable extends Table {
 
    public function initialize(array $config) {
        parent::initialize($config);

        $this->setTable('menus');
        $this->setPrimaryKey('id');
        $this->setDisplayField('nome');

        $this->hasMany('Categories', [
            'foreignKey' => 'menu_id'
        ]);
        $this->hasMany('Posts', [
            'foreignKey' => 'menu_id'
        ]);
        $this->hasMany('Regions', [
            'foreignKey' => 'menu_id'
        ]);
        $this->addBehavior('Josegonzalez/Upload.Upload', [
            'imagem' => [  
                'path' => 'webroot{DS}img{DS}headers{DS}',
                'nameCallback' => function ($table, $entity, $data, $field, $settings) {
                    return Text::uuid() . '.' . pathinfo($data['name'], PATHINFO_EXTENSION);
                },
                'keepFilesOnDelete'=>false,
            ]
        ]);
    }

    public function validationDefault(Validator $validator) {
        
        $validator
            ->nonNegativeInteger('id')
            ->allowEmptyString('id', 'create');

        $validator
            ->scalar('nome')
            ->maxLength('nome', 30)
            ->allowEmptyString('nome', false);

        $validator
            ->scalar('slug')
            ->maxLength('slug', 30)
            ->allowEmptyString('slug', false);

        $validator
            ->integer('ordem')
            ->allowEmptyString('ordem');

        $validator->setProvider('upload', \Josegonzalez\Upload\Validation\DefaultValidation::class);

       

        $validator->add('imagem', 'fileSuccessfulWrite', [
            'rule' => 'isSuccessfulWrite',
            'message' => 'This upload failed',
            'provider' => 'upload',
            'on' => function($context) {
                return !empty($context['data']['imagem']) && $context['data']['imagem']['error'] == UPLOAD_ERR_OK;
            }
        ]);

        $validator
            ->requirePresence('imagem', 'create')
            ->allowEmptyString('imagem', true);

        
        return $validator;
    }
}
