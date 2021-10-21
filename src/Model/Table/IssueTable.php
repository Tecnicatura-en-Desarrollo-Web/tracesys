<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Issue Model
 *
 * @method \App\Model\Entity\Issue newEmptyEntity()
 * @method \App\Model\Entity\Issue newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Issue[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Issue get($primaryKey, $options = [])
 * @method \App\Model\Entity\Issue findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Issue patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Issue[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Issue|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Issue saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Issue[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Issue[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Issue[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Issue[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class IssueTable extends Table
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

        $this->setTable('issue');
        $this->setDisplayField('id_problema');
        $this->setPrimaryKey('id_problema');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Reports', [
            'foreignKey' => 'report_id',
            'joinType' => 'INNER',
        ]);
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
            ->integer('issue_id')
            ->allowEmptyString('issue_id', null, 'create');

        $validator
            ->scalar('titulo')
            ->maxLength('titulo', 255)
            ->requirePresence('titulo', 'create')
            ->notEmptyString('titulo');

        $validator
            ->scalar('descripcion')
            ->maxLength('descripcion', 255)
            ->requirePresence('descripcion', 'create')
            ->notEmptyString('descripcion');

        $validator
            ->dateTime('fecha')
            ->requirePresence('fecha', 'create')
            ->notEmptyDateTime('fecha');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn(['report_id'], 'Reports'), ['errorField' => 'report_id']);

        return $rules;
    }
}
