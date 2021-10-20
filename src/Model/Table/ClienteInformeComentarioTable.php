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
