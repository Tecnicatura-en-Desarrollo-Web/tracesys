<?php

declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Bills Model
 *
 * @method \App\Model\Entity\Bill newEmptyEntity()
 * @method \App\Model\Entity\Bill newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Bill[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Bill get($primaryKey, $options = [])
 * @method \App\Model\Entity\Bill findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Bill patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Bill[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Bill|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Bill saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Bill[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Bill[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Bill[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Bill[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class BillsTable extends Table
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

        $this->setTable('bills');
        $this->setDisplayField('bill_id');
        $this->setPrimaryKey('bill_id');

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
            ->integer('bill_id')
            ->allowEmptyString('bill_id', null, 'create');

        /*  $validator
            ->scalar('descripcion')
            ->maxLength('descripcion', 255)
            ->requirePresence('descripcion', 'create')
            ->notEmptyString('descripcion');

        $validator
            ->dateTime('fecha')
            ->requirePresence('fecha', 'create')
            ->notEmptyDateTime('fecha');

        $validator
            ->integer('monto')
            ->requirePresence('monto', 'create')
            ->notEmptyString('monto');

        $validator
            ->scalar('url_factura')
            ->maxLength('url_factura', 255)
            ->requirePresence('url_factura', 'create')
            ->notEmptyString('url_factura'); */

        return $validator;
    }
}