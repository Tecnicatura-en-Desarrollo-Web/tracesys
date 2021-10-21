<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ProveedorRepuesto Model
 *
 * @method \App\Model\Entity\ProveedorRepuesto newEmptyEntity()
 * @method \App\Model\Entity\ProveedorRepuesto newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\ProveedorRepuesto[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ProveedorRepuesto get($primaryKey, $options = [])
 * @method \App\Model\Entity\ProveedorRepuesto findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\ProveedorRepuesto patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ProveedorRepuesto[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\ProveedorRepuesto|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ProveedorRepuesto saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ProveedorRepuesto[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\ProveedorRepuesto[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\ProveedorRepuesto[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\ProveedorRepuesto[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ProveedorRepuestoTable extends Table
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

        $this->setTable('proveedor_repuesto');
        $this->setDisplayField('id_repuesto');
        $this->setPrimaryKey(['id_repuesto', 'id_proveedor']);

        $this->addBehavior('Timestamp');

        $this->belongsTo('Replacement', [
            'foreignKey' => 'proveedor_repuesto_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Provider', [
            'foreignKey' => 'provider_id',
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
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn(['proveedor_repuesto_id'], 'Replacement'), ['errorField' => 'proveedor_repuesto_id']);
        $rules->add($rules->existsIn(['provider_id'], 'Provider'), ['errorField' => 'provider_id']);

        return $rules;
    }
}
