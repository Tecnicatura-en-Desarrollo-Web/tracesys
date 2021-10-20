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
            ->integer('cuit')
            ->allowEmptyString('cuit', null, 'create');

        $validator
            ->integer('id_comentario')
            ->allowEmptyString('id_comentario', null, 'create');

        $validator
            ->integer('id_informe')
            ->allowEmptyString('id_informe', null, 'create');

        return $validator;
    }
}
