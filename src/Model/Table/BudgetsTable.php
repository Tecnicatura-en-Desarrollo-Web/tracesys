<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Budgets Model
 *
 * @property \App\Model\Table\ReportsTable&\Cake\ORM\Association\BelongsTo $Reports
 *
 * @method \App\Model\Entity\Budget newEmptyEntity()
 * @method \App\Model\Entity\Budget newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Budget[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Budget get($primaryKey, $options = [])
 * @method \App\Model\Entity\Budget findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Budget patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Budget[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Budget|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Budget saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Budget[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Budget[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Budget[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Budget[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class BudgetsTable extends Table
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

        $this->setTable('budgets');
        $this->setDisplayField('budget_id');
        $this->setPrimaryKey('budget_id');

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
            ->integer('budget_id')
            ->allowEmptyString('budget_id', null, 'create');

        // $validator
        //     ->integer('monto')
        //     ->requirePresence('monto', 'create')
        //     ->notEmptyString('monto');

        // $validator
        //     ->dateTime('fecha')
        //     ->requirePresence('fecha', 'create')
        //     ->notEmptyDateTime('fecha');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    // public function buildRules(RulesChecker $rules): RulesChecker
    // {
    //     $rules->add($rules->existsIn(['report_id'], 'Reports'), ['errorField' => 'report_id']);

    //     return $rules;
    // }
}
