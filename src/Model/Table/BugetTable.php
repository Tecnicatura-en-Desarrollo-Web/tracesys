<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Buget Model
 *
 * @method \App\Model\Entity\Buget newEmptyEntity()
 * @method \App\Model\Entity\Buget newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Buget[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Buget get($primaryKey, $options = [])
 * @method \App\Model\Entity\Buget findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Buget patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Buget[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Buget|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Buget saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Buget[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Buget[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Buget[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Buget[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class BugetTable extends Table
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

        $this->setTable('buget');
        $this->setDisplayField('id_presupuesto');
        $this->setPrimaryKey('id_presupuesto');

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
            ->integer('id_presupuesto')
            ->allowEmptyString('id_presupuesto', null, 'create');

        $validator
            ->integer('monto')
            ->requirePresence('monto', 'create')
            ->notEmptyString('monto');

        $validator
            ->dateTime('fecha')
            ->requirePresence('fecha', 'create')
            ->notEmptyDateTime('fecha');

        $validator
            ->integer('id_informe')
            ->requirePresence('id_informe', 'create')
            ->notEmptyString('id_informe');

        return $validator;
    }
}
