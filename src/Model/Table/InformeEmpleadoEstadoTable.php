<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * InformeEmpleadoEstado Model
 *
 * @method \App\Model\Entity\InformeEmpleadoEstado newEmptyEntity()
 * @method \App\Model\Entity\InformeEmpleadoEstado newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\InformeEmpleadoEstado[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\InformeEmpleadoEstado get($primaryKey, $options = [])
 * @method \App\Model\Entity\InformeEmpleadoEstado findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\InformeEmpleadoEstado patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\InformeEmpleadoEstado[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\InformeEmpleadoEstado|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\InformeEmpleadoEstado saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\InformeEmpleadoEstado[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\InformeEmpleadoEstado[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\InformeEmpleadoEstado[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\InformeEmpleadoEstado[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class InformeEmpleadoEstadoTable extends Table
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

        $this->setTable('informe_empleado_estado');
        $this->setDisplayField('id_informe');
        $this->setPrimaryKey(['id_informe', 'cuit', 'id_estado']);

        $this->addBehavior('Timestamp');

        $this->belongsTo('Reports', [
            'foreignKey' => 'informe_empleado_estado_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Employee', [
            'foreignKey' => 'employee_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('State', [
            'foreignKey' => 'state_id',
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
        $rules->add($rules->existsIn(['informe_empleado_estado_id'], 'Reports'), ['errorField' => 'informe_empleado_estado_id']);
        $rules->add($rules->existsIn(['employee_id'], 'Employee'), ['errorField' => 'employee_id']);
        $rules->add($rules->existsIn(['state_id'], 'State'), ['errorField' => 'state_id']);

        return $rules;
    }
}
