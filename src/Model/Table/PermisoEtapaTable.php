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

        $this->belongsTo('Permissions', [
            'foreignKey' => 'permiso_etapa_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Stages', [
            'foreignKey' => 'stage_id',
            'joinType' => 'INNER',
        ]);
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
        $rules->add($rules->existsIn(['permiso_etapa_id'], 'Permissions'), ['errorField' => 'permiso_etapa_id']);
        $rules->add($rules->existsIn(['stage_id'], 'Stages'), ['errorField' => 'stage_id']);

        return $rules;
    }
}
