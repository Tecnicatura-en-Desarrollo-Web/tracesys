<?php

declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Problemasugerencias Model
 *
 * @property \App\Model\Table\ProblemasugerenciasTable&\Cake\ORM\Association\BelongsTo $Problemasugerencias
 * @property \App\Model\Table\SuggestionsTable&\Cake\ORM\Association\BelongsTo $Suggestions
 *
 * @method \App\Model\Entity\Problemasugerencia newEmptyEntity()
 * @method \App\Model\Entity\Problemasugerencia newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Problemasugerencia[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Problemasugerencia get($primaryKey, $options = [])
 * @method \App\Model\Entity\Problemasugerencia findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Problemasugerencia patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Problemasugerencia[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Problemasugerencia|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Problemasugerencia saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Problemasugerencia[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Problemasugerencia[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Problemasugerencia[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Problemasugerencia[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ProblemasugerenciasTable extends Table
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

        $this->setTable('problemasugerencias');
        $this->setDisplayField('problemasugerencia_id');
        $this->setPrimaryKey(['problemasugerencia_id', 'suggestion_id']);

        $this->addBehavior('Timestamp');

        $this->belongsTo('Problemasugerencias', [
            'foreignKey' => 'problemasugerencia_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Reports', [
            'foreignKey' => 'problemasugerencia_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Issues', [
            'foreignKey' => 'problemasugerencia_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Suggestions', [
            'foreignKey' => 'suggestion_id',
            'joinType' => 'INNER',
        ]);

    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    // public function validationDefault(Validator $validator): Validator
    // {
    //     $validator
    //         ->boolean('activo')
    //         ->notEmptyString('activo');

    //     return $validator;
    // }
}
