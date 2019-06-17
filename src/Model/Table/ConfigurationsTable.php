<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class ConfigurationsTable extends Table{

    public function initialize(array $config) {
        parent::initialize($config);

        $this->setTable('configurations');
        $this->setPrimaryKey('id');
        $this->setDisplayField('nome');
    }

    public function validationDefault(Validator $validator){
        $validator
            ->scalar('nome')
            ->maxLength('nome', 100)
            ->allowEmpty('nome', 'create');

        $validator
            ->scalar('data')
            ->requirePresence('data', 'create')
            ->notEmpty('data');

        return $validator;
    }

}
