<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Administrador Model
 *
 * @method \App\Model\Entity\Administrador newEmptyEntity()
 * @method \App\Model\Entity\Administrador newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Administrador[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Administrador get($primaryKey, $options = [])
 * @method \App\Model\Entity\Administrador findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Administrador patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Administrador[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Administrador|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Administrador saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Administrador[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Administrador[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Administrador[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Administrador[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class AdministradorTable extends Table
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

        $this->setTable('administrador');
        $this->setDisplayField('cuit_admin');
        $this->setPrimaryKey('cuit_admin');
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
            ->integer('cuit_admin')
            ->allowEmptyString('cuit_admin', null, 'create');

        return $validator;
    }
}
