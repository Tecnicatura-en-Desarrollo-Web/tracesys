<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Informeempleadocomentarios Model
 *
 * @property \App\Model\Table\InformeempleadocomentariosTable&\Cake\ORM\Association\BelongsTo $Informeempleadocomentarios
 * @property \App\Model\Table\CommentsemployeesTable&\Cake\ORM\Association\BelongsTo $Commentsemployees
 * @property \App\Model\Table\ReportsTable&\Cake\ORM\Association\BelongsTo $Reports
 *
 * @method \App\Model\Entity\Informeempleadocomentario newEmptyEntity()
 * @method \App\Model\Entity\Informeempleadocomentario newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Informeempleadocomentario[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Informeempleadocomentario get($primaryKey, $options = [])
 * @method \App\Model\Entity\Informeempleadocomentario findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Informeempleadocomentario patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Informeempleadocomentario[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Informeempleadocomentario|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Informeempleadocomentario saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Informeempleadocomentario[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Informeempleadocomentario[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Informeempleadocomentario[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Informeempleadocomentario[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class InformeempleadocomentariosTable extends Table
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

        $this->setTable('informeempleadocomentarios');
        $this->setDisplayField('informeempleadocomentario_id');
        $this->setPrimaryKey(['informeempleadocomentario_id', 'comment_employee_id', 'report_id']);

        $this->addBehavior('Timestamp');

        $this->belongsTo('Informeempleadocomentarios', [
            'foreignKey' => 'informeempleadocomentario_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Commentsemployees', [
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
    // public function buildRules(RulesChecker $rules): RulesChecker
    // {
    //     $rules->add($rules->existsIn(['informeempleadocomentario_id'], 'Informeempleadocomentarios'), ['errorField' => 'informeempleadocomentario_id']);
    //     $rules->add($rules->existsIn(['comment_employee_id'], 'Commentsemployees'), ['errorField' => 'comment_employee_id']);
    //     $rules->add($rules->existsIn(['report_id'], 'Reports'), ['errorField' => 'report_id']);

    //     return $rules;
    // }
}
