<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * InformeEmpleadoComentario Model
 *
 * @method \App\Model\Entity\InformeEmpleadoComentario newEmptyEntity()
 * @method \App\Model\Entity\InformeEmpleadoComentario newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\InformeEmpleadoComentario[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\InformeEmpleadoComentario get($primaryKey, $options = [])
 * @method \App\Model\Entity\InformeEmpleadoComentario findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\InformeEmpleadoComentario patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\InformeEmpleadoComentario[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\InformeEmpleadoComentario|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\InformeEmpleadoComentario saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\InformeEmpleadoComentario[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\InformeEmpleadoComentario[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\InformeEmpleadoComentario[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\InformeEmpleadoComentario[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class InformeEmpleadoComentarioTable extends Table
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

        $this->setTable('informe_empleado_comentario');
        $this->setDisplayField('cuit');
        $this->setPrimaryKey(['cuit', 'id_comentario', 'id_informe']);

        $this->addBehavior('Timestamp');

        $this->belongsTo('Employee', [
            'foreignKey' => 'informe_empleado_comentario_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('CommentsEmployee', [
            'foreignKey' => 'comment_employee_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Reports', [
            'foreignKey' => 'report_id',
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
            ->scalar('cuit')
            ->maxLength('cuit', 11)
            ->requirePresence('cuit', 'create')
            ->notEmptyString('cuit');

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
        $rules->add($rules->existsIn(['informe_empleado_comentario_id'], 'Employee'), ['errorField' => 'informe_empleado_comentario_id']);
        $rules->add($rules->existsIn(['comment_employee_id'], 'CommentsEmployee'), ['errorField' => 'comment_employee_id']);
        $rules->add($rules->existsIn(['report_id'], 'Reports'), ['errorField' => 'report_id']);

        return $rules;
    }
}
