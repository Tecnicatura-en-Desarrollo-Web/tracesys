<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * SugerenciaRepuesto Model
 *
 * @method \App\Model\Entity\SugerenciaRepuesto newEmptyEntity()
 * @method \App\Model\Entity\SugerenciaRepuesto newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\SugerenciaRepuesto[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\SugerenciaRepuesto get($primaryKey, $options = [])
 * @method \App\Model\Entity\SugerenciaRepuesto findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\SugerenciaRepuesto patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\SugerenciaRepuesto[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\SugerenciaRepuesto|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SugerenciaRepuesto saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SugerenciaRepuesto[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\SugerenciaRepuesto[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\SugerenciaRepuesto[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\SugerenciaRepuesto[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class SugerenciaRepuestoTable extends Table
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

        $this->setTable('sugerencia_repuesto');
        $this->setDisplayField('id_sugerencia');
        $this->setPrimaryKey(['id_sugerencia', 'id_repuesto']);

        $this->addBehavior('Timestamp');

        $this->belongsTo('Suggestions', [
            'foreignKey' => 'sugerencia_repuesto_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Replacement', [
            'foreignKey' => 'replacement_id',
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
            ->dateTime('fecha')
            ->requirePresence('fecha', 'create')
            ->notEmptyDateTime('fecha');

        $validator
            ->dateTime('hora')
            ->requirePresence('hora', 'create')
            ->notEmptyDateTime('hora');

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
        $rules->add($rules->existsIn(['sugerencia_repuesto_id'], 'Suggestions'), ['errorField' => 'sugerencia_repuesto_id']);
        $rules->add($rules->existsIn(['replacement_id'], 'Replacement'), ['errorField' => 'replacement_id']);

        return $rules;
    }
}
