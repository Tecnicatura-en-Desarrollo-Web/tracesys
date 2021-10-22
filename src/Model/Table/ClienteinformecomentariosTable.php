<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Clienteinformecomentarios Model
 *
 * @property \App\Model\Table\ClienteinformecomentariosTable&\Cake\ORM\Association\BelongsTo $Clienteinformecomentarios
 * @property \App\Model\Table\CommentsclientsTable&\Cake\ORM\Association\BelongsTo $Commentsclients
 * @property \App\Model\Table\ReportsTable&\Cake\ORM\Association\BelongsTo $Reports
 *
 * @method \App\Model\Entity\Clienteinformecomentario newEmptyEntity()
 * @method \App\Model\Entity\Clienteinformecomentario newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Clienteinformecomentario[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Clienteinformecomentario get($primaryKey, $options = [])
 * @method \App\Model\Entity\Clienteinformecomentario findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Clienteinformecomentario patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Clienteinformecomentario[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Clienteinformecomentario|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Clienteinformecomentario saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Clienteinformecomentario[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Clienteinformecomentario[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Clienteinformecomentario[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Clienteinformecomentario[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ClienteinformecomentariosTable extends Table
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

        $this->setTable('clienteinformecomentarios');
        $this->setDisplayField('clienteinformecomentario_id');
        $this->setPrimaryKey(['clienteinformecomentario_id', 'comment_client_id', 'report_id']);

        $this->addBehavior('Timestamp');

        $this->belongsTo('Clienteinformecomentarios', [
            'foreignKey' => 'clienteinformecomentario_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Commentsclients', [
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
        $rules->add($rules->existsIn(['clienteinformecomentario_id'], 'Clienteinformecomentarios'), ['errorField' => 'clienteinformecomentario_id']);
        $rules->add($rules->existsIn(['comment_client_id'], 'Commentsclients'), ['errorField' => 'comment_client_id']);
        $rules->add($rules->existsIn(['report_id'], 'Reports'), ['errorField' => 'report_id']);

        return $rules;
    }
}
