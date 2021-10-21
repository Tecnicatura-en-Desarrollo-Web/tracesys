<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Provider Model
 *
 * @method \App\Model\Entity\Provider newEmptyEntity()
 * @method \App\Model\Entity\Provider newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Provider[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Provider get($primaryKey, $options = [])
 * @method \App\Model\Entity\Provider findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Provider patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Provider[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Provider|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Provider saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Provider[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Provider[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Provider[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Provider[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ProviderTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('provider');
        $this->setDisplayField('id_proveedor');
        $this->setPrimaryKey('id_proveedor');

        $this->addBehavior('Timestamp');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('provider_id')
            ->allowEmptyString('provider_id', null, 'create');

        $validator
            ->scalar('nombre')
            ->maxLength('nombre', 255)
            ->requirePresence('nombre', 'create')
            ->notEmptyString('nombre');

        $validator
            ->email('email')
            ->requirePresence('email', 'create')
            ->notEmptyString('email');

        $validator
            ->scalar('cuit')
            ->maxLength('cuit', 255)
            ->requirePresence('cuit', 'create')
            ->notEmptyString('cuit');

        return $validator;
    }
}
