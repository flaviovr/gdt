<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Utility\Text;


class PostsTable extends Table{
  
    public function initialize(array $config){
        parent::initialize($config);

        $this->setTable('posts');
        $this->setPrimaryKey('id');
        $this->setDisplayField('titulo');

        $this->belongsTo('Menus', [
            'foreignKey' => 'menu_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Regions', [
            'foreignKey' => 'region_id'
        ]);
        $this->belongsTo('Locations', [
            'foreignKey' => 'location_id'
        ]);
        $this->belongsTo('Categories', [
            'foreignKey' => 'category_id'
        ]);
        $this->belongsTo('Discounts', [
            'foreignKey' => 'discount_id'
        ]);
        $this->belongsToMany('Tags', [
            'foreignKey' => 'post_id',
            'targetForeignKey' => 'tag_id',
            'joinTable' => 'posts_tags'
        ]);
        $this->addBehavior('Josegonzalez/Upload.Upload', [
            'thumb' => [  
                'path' => 'webroot{DS}img{DS}posts{DS}thumb{DS}',
                'nameCallback' => function ($table, $entity, $data, $field, $settings) {
                    return Text::uuid() . '.' . pathinfo($data['name'], PATHINFO_EXTENSION);
                },
                'keepFilesOnDelete'=>false,
            ],
            'imagem' => [  
                'path' => 'webroot{DS}img{DS}posts{DS}',
                'nameCallback' => function ($table, $entity, $data, $field, $settings) {
                    return Text::uuid() . '.' . pathinfo($data['name'], PATHINFO_EXTENSION);
                },
                'keepFilesOnDelete'=>false,
            ],
        ]);
      
    }

    public function validationDefault(Validator $validator){
        $validator
            ->nonNegativeInteger('id')
            ->allowEmptyString('id', 'create');

        $validator
            ->nonNegativeInteger('menu_id')
            ->allowEmptyString('menu_id', false);


        $validator
            ->scalar('titulo')
            ->maxLength('titulo', 200)
            ->allowEmptyString('titulo', false);

        $validator
            ->scalar('subtitulo')
            ->maxLength('subtitulo', 200)
            ->requirePresence('subtitulo', 'create')
            ->allowEmptyString('subtitulo', false);

        $validator
            ->scalar('slug')
            ->maxLength('slug', 255)
            ->allowEmptyString('slug', false);

        $validator
            ->scalar('texto')
            ->requirePresence('texto', 'create')
            ->allowEmptyString('texto', false);

        $validator
            ->boolean('ativo')
            ->allowEmptyString('ativo');

        $validator
            ->boolean('destaque')
            ->allowEmptyString('destaque');

        $validator
            ->date('alterado_em')
            ->allowEmptyDateTime('alterado_em', false);

        $validator
            ->date('publicado_em')
            ->allowEmptyDate('publicado_em', false);

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
    

        $validator->add('thumb', 'fileSuccessfulWrite', [
            'rule' => 'isSuccessfulWrite',
            'message' => 'This upload failed',
            'provider' => 'upload',
            'on' => function($context) {
                return !empty($context['data']['thumb']) && $context['data']['thumb']['error'] == UPLOAD_ERR_OK;
            }
        ]);

        $validator
            ->requirePresence('thumb', 'create')
            ->allowEmptyString('thumb', true);

        return $validator;
    }
    public function findAtivo(Query $query, array $options ){ 
        return $query->where([ 'Posts.ativo' => 1, 'Posts.publicado_em <= now()']);
    }

    public function buildRules(RulesChecker $rules){
        $rules->add($rules->existsIn(['menu_id'], 'Menus'));
        $rules->add($rules->existsIn(['region_id'], 'Regions'));
        $rules->add($rules->existsIn(['location_id'], 'Locations'));
        $rules->add($rules->existsIn(['category_id'], 'Categories'));
        $rules->add($rules->existsIn(['discount_id'], 'Discounts'));
        return $rules;
    }
}
