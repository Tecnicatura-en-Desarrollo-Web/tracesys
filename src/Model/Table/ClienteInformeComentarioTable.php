<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ClienteInformeComentario Model
 *
 * @method \App\Model\Entity\ClienteInformeComentario newEmptyEntity()
 * @method \App\Model\Entity\ClienteInformeComentario newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\ClienteInformeComentario[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ClienteInformeComentario get($primaryKey, $options = [])
 * @method \App\Model\Entity\ClienteInformeComentario findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\ClienteInformeComentario patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ClienteInformeComentario[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\ClienteInformeComentario|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ClienteInformeComentario saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ClienteInformeComentario[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\ClienteInformeComentario[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\ClienteInformeComentario[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\ClienteInformeComentario[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ClienteInformeComentarioTable extends Table
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

        $this->setTable('cliente_informe_comentario');
        $this->setDisplayField('cuit');
        $this->setPrimaryKey(['cuit', 'id_comentario', 'id_informe']);

        $this->addBehavior('Timestamp');

        $this->belongsTo('Employee', [
            'foreignKey' => 'cliente_informe_comentario_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('CommentsClients', [
            'foreignKey' => 'comment_client_id',
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
        $rules->add($rules->existsIn(['cliente_informe_comentario_id'], 'Employee'), ['errorField' => 'cliente_informe_comentario_id']);
        $rules->add($rules->existsIn(['comment_client_id'], 'CommentsClients'), ['errorField' => 'comment_client_id']);
        $rules->add($rules->existsIn(['report_id'], 'Reports'), ['errorField' => 'report_id']);

        return $rules;
    }
}
