<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Commentsclients Model
 *
 * @method \App\Model\Entity\Commentsclient newEmptyEntity()
 * @method \App\Model\Entity\Commentsclient newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Commentsclient[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Commentsclient get($primaryKey, $options = [])
 * @method \App\Model\Entity\Commentsclient findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Commentsclient patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Commentsclient[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Commentsclient|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Commentsclient saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Commentsclient[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Commentsclient[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Commentsclient[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Commentsclient[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class CommentsclientsTable extends Table
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

        $this->setTable('commentsclients');
        $this->setDisplayField('commentclient_id');
        $this->setPrimaryKey('commentclient_id');
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
            ->integer('commentclient_id')
            ->allowEmptyString('commentclient_id', null, 'create');

        $validator
            ->scalar('descripcion')
            ->maxLength('descripcion', 300)
            ->requirePresence('descripcion', 'create')
            ->notEmptyString('descripcion');

        return $validator;
    }
}
