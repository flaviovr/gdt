<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Utility\Text;

class BannersTable extends Table {

    public function initialize(array $config) {
        parent::initialize($config);

        $this->setTable('banners');
        $this->setDisplayField('nome');
        $this->setPrimaryKey('id');

        $this->addBehavior('Josegonzalez/Upload.Upload', [
            'imagem' => [  
                'path' => 'webroot{DS}img{DS}banners{DS}',
                'nameCallback' => function ($table, $entity, $data, $field, $settings) {
                    return Text::uuid() . '.' . pathinfo($data['name'], PATHINFO_EXTENSION);
                },
                'keepFilesOnDelete'=>false,
            ],
        ]);
    }

    public function findAtivo(Query $query, array $options) { 
        return $query->find('all')->where([ 'Banners.ativo' => 1]);
    }
   
    public function validationDefault(Validator $validator) {
        $validator
            ->nonNegativeInteger('id')
            ->allowEmptyString('id', 'create');

        $validator
            ->scalar('nome')
            ->maxLength('nome', 100)
            ->allowEmptyString('nome', false);

        $validator
            ->boolean('externo')
            ->allowEmptyString('externo', false);

        $validator
            ->scalar('link')
            ->maxLength('link', 255)
            ->allowEmptyString('link', false);

        $validator
            ->integer('tempo')
            ->allowEmptyString('tempo');

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
            ->boolean('ativo')
            ->allowEmptyString('ativo');

        return $validator;
    }
}



