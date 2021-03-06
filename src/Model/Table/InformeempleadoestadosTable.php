<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Informeempleadoestados Model
 *
 * @property \App\Model\Table\InformeempleadoestadosTable&\Cake\ORM\Association\BelongsTo $Informeempleadoestados
 * @property \App\Model\Table\EmployeesTable&\Cake\ORM\Association\BelongsTo $Employees
 * @property \App\Model\Table\StatesTable&\Cake\ORM\Association\BelongsTo $States
 *
 * @method \App\Model\Entity\Informeempleadoestado newEmptyEntity()
 * @method \App\Model\Entity\Informeempleadoestado newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Informeempleadoestado[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Informeempleadoestado get($primaryKey, $options = [])
 * @method \App\Model\Entity\Informeempleadoestado findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Informeempleadoestado patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Informeempleadoestado[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Informeempleadoestado|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Informeempleadoestado saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Informeempleadoestado[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Informeempleadoestado[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Informeempleadoestado[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Informeempleadoestado[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class InformeempleadoestadosTable extends Table
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

        $this->setTable('informeempleadoestados');
        $this->setDisplayField('informeempleadoestado_id');
        $this->setPrimaryKey(['informeempleadoestado_id', 'employee_id', 'state_id']);

        $this->addBehavior('Timestamp');

        $this->belongsTo('Informeempleadoestados', [
            'foreignKey' => 'informeempleadoestado_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Reports', [
            'foreignKey' => 'informeempleadoestado_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Employees', [
            'foreignKey' => 'employee_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('States', [
            'foreignKey' => 'state_id',
            'joinType' => 'INNER',
        ]);
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
            ->integer('informeempleadoestado_id_propio')
            ->allowEmptyString('informeempleadoestado_id_propio', null, 'create');

        $validator
            ->boolean('ultimoEstado')
            ->notEmptyString('ultimoEstado');

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
    //     $rules->add($rules->existsIn(['informeempleadoestado_id'], 'Informeempleadoestados'), ['errorField' => 'informeempleadoestado_id']);
    //     $rules->add($rules->existsIn(['employee_id'], 'Employees'), ['errorField' => 'employee_id']);
    //     $rules->add($rules->existsIn(['state_id'], 'States'), ['errorField' => 'state_id']);
    //     $rules->add($rules->existsIn(['sector_id'], 'Sectors'), ['errorField' => 'sector_id']);

    //     return $rules;
    // }
}
