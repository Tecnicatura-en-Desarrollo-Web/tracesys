<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CommentsEmployee Model
 *
 * @method \App\Model\Entity\CommentsEmployee newEmptyEntity()
 * @method \App\Model\Entity\CommentsEmployee newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\CommentsEmployee[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CommentsEmployee get($primaryKey, $options = [])
 * @method \App\Model\Entity\CommentsEmployee findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\CommentsEmployee patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\CommentsEmployee[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\CommentsEmployee|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CommentsEmployee saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CommentsEmployee[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\CommentsEmployee[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\CommentsEmployee[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\CommentsEmployee[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CommentsEmployeeTable extends Table
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

        $this->setTable('comments_employee');
        $this->setDisplayField('id_comentario');
        $this->setPrimaryKey('id_comentario');

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
            ->integer('comment_employee_id')
            ->allowEmptyString('comment_employee_id', null, 'create');

        $validator
            ->scalar('descripcion')
            ->maxLength('descripcion', 255)
            ->requirePresence('descripcion', 'create')
            ->notEmptyString('descripcion');

        return $validator;
    }
}
