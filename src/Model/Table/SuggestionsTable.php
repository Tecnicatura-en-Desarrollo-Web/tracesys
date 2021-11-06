<?php

declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Suggestions Model
 *
 * @property \App\Model\Table\SectorsTable&\Cake\ORM\Association\BelongsTo $Sectors
 *
 * @method \App\Model\Entity\Suggestion newEmptyEntity()
 * @method \App\Model\Entity\Suggestion newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Suggestion[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Suggestion get($primaryKey, $options = [])
 * @method \App\Model\Entity\Suggestion findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Suggestion patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Suggestion[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Suggestion|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Suggestion saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Suggestion[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Suggestion[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Suggestion[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Suggestion[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class SuggestionsTable extends Table
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

        $this->setTable('suggestions');
        $this->setDisplayField('suggestion_id');
        $this->setPrimaryKey('suggestion_id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Sectors', [
            'foreignKey' => 'sector_id',
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
            ->integer('suggestion_id')
            ->allowEmptyString('suggestion_id', null, 'create');

        //          $validator
        //     ->scalar('nombre_sugerencia')
        //     ->maxLength('nombre_sugerencia', 100)
        //     ->requirePresence('nombre_sugerencia', 'create')
        //     ->notEmptyString('nombre_sugerencia');

        // $validator
        //     ->scalar('descripcion_sugerencia')
        //     ->maxLength('descripcion_sugerencia', 255)
        //     ->requirePresence('descripcion_sugerencia', 'create')
        //     ->notEmptyString('descripcion_sugerencia');

        // $validator
        //     ->integer('puntaje')
        //     ->requirePresence('puntaje', 'create')
        //     ->notEmptyString('puntaje');

        // $validator
        //     ->integer('puntaje')
        //     ->requirePresence('puntaje', 'create')
        //    ->notEmptyString('puntaje');

        // $validator
        //     ->integer('valorPrecio')
        //    ->requirePresence('valorPrecio', 'create')
        //     ->notEmptyString('valorPrecio');

        return $validator;
        }


    //  Returns a rules checker object that will be used for validating
    //  application integrity.

    //  @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
    //  @return \Cake\ORM\RulesChecker

    // public function buildRules(RulesChecker $rules): RulesChecker
    // {
    //     $rules->add($rules->existsIn(['sector_id'], 'Sectors'), ['errorField' => 'sector_id']);

    //     return $rules;
    // }
}
