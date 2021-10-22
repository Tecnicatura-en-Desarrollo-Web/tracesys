<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Commentsemployees Model
 *
 * @method \App\Model\Entity\Commentsemployee newEmptyEntity()
 * @method \App\Model\Entity\Commentsemployee newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Commentsemployee[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Commentsemployee get($primaryKey, $options = [])
 * @method \App\Model\Entity\Commentsemployee findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Commentsemployee patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Commentsemployee[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Commentsemployee|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Commentsemployee saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Commentsemployee[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Commentsemployee[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Commentsemployee[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Commentsemployee[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CommentsemployeesTable extends Table
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

        $this->setTable('commentsemployees');
        $this->setDisplayField('commentsemployee_id');
        $this->setPrimaryKey('commentsemployee_id');

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
            ->integer('commentsemployee_id')
            ->allowEmptyString('commentsemployee_id', null, 'create');

        $validator
            ->scalar('descripcion')
            ->maxLength('descripcion', 255)
            ->requirePresence('descripcion', 'create')
            ->notEmptyString('descripcion');

        return $validator;
    }
}
