<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Sector Model
 *
 * @method \App\Model\Entity\Sector newEmptyEntity()
 * @method \App\Model\Entity\Sector newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Sector[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Sector get($primaryKey, $options = [])
 * @method \App\Model\Entity\Sector findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Sector patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Sector[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Sector|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Sector saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Sector[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Sector[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Sector[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Sector[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class SectorTable extends Table
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

        $this->setTable('sector');
        $this->setDisplayField('id_sector');
        $this->setPrimaryKey('id_sector');

        $this->belongsTo('Stages', [
            'foreignKey' => 'stage_id',
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
            ->integer('sector_id')
            ->allowEmptyString('sector_id', null, 'create');

        $validator
            ->scalar('nombre_sector')
            ->maxLength('nombre_sector', 255)
            ->requirePresence('nombre_sector', 'create')
            ->notEmptyString('nombre_sector');

        $validator
            ->integer('orden')
            ->requirePresence('orden', 'create')
            ->notEmptyString('orden');

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
        $rules->add($rules->existsIn(['stage_id'], 'Stages'), ['errorField' => 'stage_id']);

        return $rules;
    }
}
