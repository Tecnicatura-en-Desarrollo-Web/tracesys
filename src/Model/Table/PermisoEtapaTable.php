<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PermisoEtapa Model
 *
 * @method \App\Model\Entity\PermisoEtapa newEmptyEntity()
 * @method \App\Model\Entity\PermisoEtapa newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\PermisoEtapa[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\PermisoEtapa get($primaryKey, $options = [])
 * @method \App\Model\Entity\PermisoEtapa findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\PermisoEtapa patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\PermisoEtapa[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\PermisoEtapa|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PermisoEtapa saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PermisoEtapa[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\PermisoEtapa[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\PermisoEtapa[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\PermisoEtapa[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class PermisoEtapaTable extends Table
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

        $this->setTable('permiso_etapa');
        $this->setDisplayField('id_permiso');
        $this->setPrimaryKey(['id_permiso', 'id_etapa']);
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
            ->integer('id_permiso')
            ->allowEmptyString('id_permiso', null, 'create');

        $validator
            ->integer('id_etapa')
            ->allowEmptyString('id_etapa', null, 'create');

        return $validator;
    }
}
