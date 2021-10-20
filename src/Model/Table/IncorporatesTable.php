<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Incorporates Model
 *
 * @method \App\Model\Entity\Incorporate newEmptyEntity()
 * @method \App\Model\Entity\Incorporate newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Incorporate[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Incorporate get($primaryKey, $options = [])
 * @method \App\Model\Entity\Incorporate findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Incorporate patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Incorporate[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Incorporate|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Incorporate saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Incorporate[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Incorporate[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Incorporate[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Incorporate[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class IncorporatesTable extends Table
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

        $this->setTable('incorporates');
        $this->setDisplayField('id_presupuesto');
        $this->setPrimaryKey(['id_presupuesto', 'id_repuesto']);

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
            ->integer('id_repuesto')
            ->allowEmptyString('id_repuesto', null, 'create');

        return $validator;
    }
}
