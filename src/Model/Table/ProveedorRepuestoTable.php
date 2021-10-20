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
            ->integer('id_repuesto')
            ->allowEmptyString('id_repuesto', null, 'create');

        $validator
            ->integer('id_proveedor')
            ->allowEmptyString('id_proveedor', null, 'create');

        return $validator;
    }
}
