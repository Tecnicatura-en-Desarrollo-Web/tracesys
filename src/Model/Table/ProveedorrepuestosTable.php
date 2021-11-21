<?php

declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Proveedorrepuestos Model
 *
 * @property \App\Model\Table\ProveedorrepuestosTable&\Cake\ORM\Association\BelongsTo $Proveedorrepuestos
 * @property \App\Model\Table\ProvidersTable&\Cake\ORM\Association\BelongsTo $Providers
 *
 * @method \App\Model\Entity\Proveedorrepuesto newEmptyEntity()
 * @method \App\Model\Entity\Proveedorrepuesto newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Proveedorrepuesto[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Proveedorrepuesto get($primaryKey, $options = [])
 * @method \App\Model\Entity\Proveedorrepuesto findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Proveedorrepuesto patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Proveedorrepuesto[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Proveedorrepuesto|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Proveedorrepuesto saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Proveedorrepuesto[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Proveedorrepuesto[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Proveedorrepuesto[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Proveedorrepuesto[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ProveedorrepuestosTable extends Table
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

        $this->setTable('proveedorrepuestos');
        $this->setDisplayField('proveedorrepuesto_id');
        $this->setPrimaryKey(['proveedorrepuesto_id', 'provider_id']);

        $this->addBehavior('Timestamp');

        $this->belongsTo('Proveedorrepuestos', [
            'foreignKey' => 'proveedorrepuesto_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Providers', [
            'foreignKey' => 'provider_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Replacements', [
            'foreignKey' => 'proveedorrepuesto_id',
            'joinType' => 'INNER',
        ]);
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    /*     public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn(['proveedorrepuesto_id'], 'Proveedorrepuestos'), ['errorField' => 'proveedorrepuesto_id']);
        $rules->add($rules->existsIn(['provider_id'], 'Providers'), ['errorField' => 'provider_id']);

        return $rules;
    } */
}