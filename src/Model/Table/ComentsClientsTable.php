<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ComentsClients Model
 *
 * @method \App\Model\Entity\ComentsClient newEmptyEntity()
 * @method \App\Model\Entity\ComentsClient newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\ComentsClient[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ComentsClient get($primaryKey, $options = [])
 * @method \App\Model\Entity\ComentsClient findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\ComentsClient patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ComentsClient[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\ComentsClient|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ComentsClient saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ComentsClient[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\ComentsClient[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\ComentsClient[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\ComentsClient[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class ComentsClientsTable extends Table
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

        $this->setTable('coments_clients');
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
            ->integer('id_comentario')
            ->allowEmptyString('id_comentario', null, 'create');

        $validator
            ->scalar('descripcion')
            ->maxLength('descripcion', 300)
            ->requirePresence('descripcion', 'create')
            ->notEmptyString('descripcion');

        return $validator;
    }
}
