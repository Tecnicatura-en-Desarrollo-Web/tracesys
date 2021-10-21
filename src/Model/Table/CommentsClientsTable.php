<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CommentsClients Model
 *
 * @method \App\Model\Entity\CommentsClient newEmptyEntity()
 * @method \App\Model\Entity\CommentsClient newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\CommentsClient[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CommentsClient get($primaryKey, $options = [])
 * @method \App\Model\Entity\CommentsClient findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\CommentsClient patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\CommentsClient[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\CommentsClient|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CommentsClient saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CommentsClient[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\CommentsClient[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\CommentsClient[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\CommentsClient[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class CommentsClientsTable extends Table
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

        $this->setTable('comments_clients');
        $this->setDisplayField('id_comentario');
        $this->setPrimaryKey('id_comentario');
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
            ->integer('comment_client_id')
            ->allowEmptyString('comment_client_id', null, 'create');

        $validator
            ->scalar('descripcion')
            ->maxLength('descripcion', 300)
            ->requirePresence('descripcion', 'create')
            ->notEmptyString('descripcion');

        return $validator;
    }
}
