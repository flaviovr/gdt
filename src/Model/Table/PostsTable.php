<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Utility\Text;

/**
 * Posts Model
 *
 * @property \App\Model\Table\RegionsTable|\Cake\ORM\Association\BelongsTo $Regions
 * @property \App\Model\Table\LocationsTable|\Cake\ORM\Association\BelongsTo $Locations
 * @property \App\Model\Table\CategoriesTable|\Cake\ORM\Association\BelongsTo $Categories
 * @property \App\Model\Table\DiscountsTable|\Cake\ORM\Association\BelongsTo $Discounts
 *
 * @method \App\Model\Entity\Post get($primaryKey, $options = [])
 * @method \App\Model\Entity\Post newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Post[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Post|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Post saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Post patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Post[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Post findOrCreate($search, callable $callback = null, $options = [])
 */
class PostsTable extends Table
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

        $this->setTable('posts');
        $this->setDisplayField('titulo');
        $this->setPrimaryKey('id');

        $this->addBehavior('Josegonzalez/Upload.Upload', [
            // You can configure as many upload fields as possible,
            // where the pattern is `field` => `config`
            //
            // Keep in mind that while this plugin does not have any limits in terms of
            // number of files uploaded per request, you should keep this down in order
            // to decrease the ability of your users to block other requests.
            'imagem' => [  
                'path' => 'webroot{DS}img{DS}posts{DS}',
                'nameCallback' => function ($table, $entity, $data, $field, $settings) {
                    return Text::uuid() . '.' . pathinfo($data['name'], PATHINFO_EXTENSION);
                },
            ],
            
        ]);

        $this->belongsTo('Regions', [
            'foreignKey' => 'region_id'
        ]);
        $this->belongsTo('Locations', [
            'foreignKey' => 'location_id'
        ]);
        $this->belongsTo('Categories', [
            'foreignKey' => 'category_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Discounts', [
            'foreignKey' => 'discount_id'
        ]);
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
            ->scalar('titulo')
            ->maxLength('titulo', 200)
            ->requirePresence('titulo', 'create')
            ->allowEmptyString('titulo', false);

        $validator
            ->scalar('subtitulo')
            ->maxLength('subtitulo', 200)
            ->requirePresence('subtitulo', 'create')
            ->allowEmptyString('subtitulo', false);

        $validator
            ->scalar('texto')
            ->requirePresence('texto', 'create')
            ->allowEmptyString('texto', false);

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

        $validator
            ->boolean('destaque')
            ->allowEmptyString('destaque');

       

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['region_id'], 'Regions'));
        $rules->add($rules->existsIn(['location_id'], 'Locations'));
        $rules->add($rules->existsIn(['category_id'], 'Categories'));
        $rules->add($rules->existsIn(['discount_id'], 'Discounts'));

        return $rules;
    }
}
