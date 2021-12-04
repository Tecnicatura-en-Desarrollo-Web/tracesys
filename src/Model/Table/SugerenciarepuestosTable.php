<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Sugerenciarepuestos Model
 *
 * @property \App\Model\Table\SugerenciarepuestosTable&\Cake\ORM\Association\BelongsTo $Sugerenciarepuestos
 * @property \App\Model\Table\ReplacementsTable&\Cake\ORM\Association\BelongsTo $Replacements
 *
 * @method \App\Model\Entity\Sugerenciarepuesto newEmptyEntity()
 * @method \App\Model\Entity\Sugerenciarepuesto newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Sugerenciarepuesto[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Sugerenciarepuesto get($primaryKey, $options = [])
 * @method \App\Model\Entity\Sugerenciarepuesto findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Sugerenciarepuesto patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Sugerenciarepuesto[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Sugerenciarepuesto|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Sugerenciarepuesto saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Sugerenciarepuesto[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Sugerenciarepuesto[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Sugerenciarepuesto[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Sugerenciarepuesto[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class SugerenciarepuestosTable extends Table
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

        $this->setTable('sugerenciarepuestos');
        $this->setDisplayField('sugerenciarepuestos_id');
        $this->setPrimaryKey(['sugerenciarepuestos_id', 'replacement_id']);

        $this->addBehavior('Timestamp');

        $this->belongsTo('Sugerenciarepuestos', [
            'foreignKey' => 'sugerenciarepuestos_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Suggestions', [
            'foreignKey' => 'sugerenciarepuestos_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Replacements', [
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
    // public function buildRules(RulesChecker $rules): RulesChecker
    // {
    //     $rules->add($rules->existsIn(['sugerenciarepuestos_id'], 'Sugerenciarepuestos'), ['errorField' => 'sugerenciarepuestos_id']);
    //     $rules->add($rules->existsIn(['replacement_id'], 'Replacements'), ['errorField' => 'replacement_id']);

    //     return $rules;
    // }
}
