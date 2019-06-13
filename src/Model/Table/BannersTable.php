<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Utility\Text;

/**
 * Banners Model
 *
 * @method \App\Model\Entity\Banner get($primaryKey, $options = [])
 * @method \App\Model\Entity\Banner newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Banner[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Banner|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Banner saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Banner patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Banner[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Banner findOrCreate($search, callable $callback = null, $options = [])
 */
class BannersTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('banners');
        
        $this->setPrimaryKey('id');
        $this->setDisplayField('nome');

        $this->addBehavior('Josegonzalez/Upload.Upload', [
            // You can configure as many upload fields as possible,
            // where the pattern is `field` => `config`
            //
            // Keep in mind that while this plugin does not have any limits in terms of
            // number of files uploaded per request, you should keep this down in order
            // to decrease the ability of your users to block other requests.
            'imagem' => [  
                'path' => 'webroot{DS}img{DS}banners{DS}',
                'nameCallback' => function ($table, $entity, $data, $field, $settings) {
                    return Text::uuid() . '.' . pathinfo($data['name'], PATHINFO_EXTENSION);
                },
            ],
            
        ]);
    }
    public function findAtivo(Query $query, array $options)
    { 
        return $query->find('all')->where([ 'Banners.ativo' => 1]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        

        $validator
            ->nonNegativeInteger('id')
            ->allowEmptyString('id', 'create');

        $validator
            ->scalar('nome')
            ->maxLength('nome', 100)
            ->requirePresence('nome', 'create')
            ->allowEmptyString('nome', false);
        
        $validator
            ->boolean('externo')
            ->requirePresence('externo', 'create')
            ->allowEmptyString('externo', false);

        $validator
            ->scalar('link')
            ->maxLength('link', 255)
            ->requirePresence('link', 'create')
            ->allowEmptyString('link', false);

        $validator
            ->integer('tempo')
            ->allowEmptyString('tempo');
        

        $validator
            ->boolean('ativo')
            ->allowEmptyString('ativo');


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
