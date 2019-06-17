<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;


class CategoriesTable extends Table
{

    public function initialize(array $config) {
        parent::initialize($config);

        $this->setTable('categories');
        $this->setDisplayField('nome');
        $this->setPrimaryKey('id');

        $this->belongsTo('Menus', [
            'foreignKey' => 'menu_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('Posts', [
            'foreignKey' => 'category_id'
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
            ->maxLength('nome', 200)
            ->allowEmptyString('nome', false);

        $validator
            ->scalar('slug')
            ->maxLength('slug', 200)
            ->allowEmptyString('slug', false);

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
