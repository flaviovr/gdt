<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Utility\Text;

class RegionsTable extends Table {

    public function initialize(array $config){
        parent::initialize($config);

        $this->setTable('regions');
        $this->setPrimaryKey('id');
        $this->setDisplayField('nome');

        $this->belongsTo('Menus', [
            'foreignKey' => 'menu_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('Locations', [
            'foreignKey' => 'region_id'
        ]);
        $this->hasMany('Posts', [
            'foreignKey' => 'region_id'
        ]);
        $this->addBehavior('Josegonzalez/Upload.Upload', [
            'imagem' => [  
                'path' => 'webroot{DS}img{DS}headers{DS}',
                'nameCallback' => function ($table, $entity, $data, $field, $settings) {
                    return Text::uuid() . '.' . pathinfo($data['name'], PATHINFO_EXTENSION);
                },
                'keepFilesOnDelete'=>false,
            ],
        ]);
    }

    public function validationDefault(Validator $validator) {
        
        $validator
            ->nonNegativeInteger('id')
            ->allowEmptyString('id', 'create');
            
        $validator
            ->nonNegativeInteger('menu_id')
            ->allowEmptyString('menu_id', false);

        $validator
            ->scalar('nome')
            ->maxLength('nome', 100)
            ->allowEmptyString('nome', false);

        $validator
            ->scalar('slug')
            ->maxLength('slug', 200)
            ->allowEmptyString('slug', false);

        $validator
            ->scalar('descricao')
            ->maxLength('descricao', 255)
            ->allowEmptyString('descricao');

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

        $validator
            ->integer('ordem')
            ->allowEmptyString('ordem');

        return $validator;
    }


    public function buildRules(RulesChecker $rules) {
        $rules->add($rules->existsIn(['menu_id'], 'Menus'));
        return $rules;
    }
}
