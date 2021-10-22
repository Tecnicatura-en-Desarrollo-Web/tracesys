<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Permisoetapas Model
 *
 * @property \App\Model\Table\PermisoetapasTable&\Cake\ORM\Association\BelongsTo $Permisoetapas
 * @property \App\Model\Table\StagesTable&\Cake\ORM\Association\BelongsTo $Stages
 *
 * @method \App\Model\Entity\Permisoetapa newEmptyEntity()
 * @method \App\Model\Entity\Permisoetapa newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Permisoetapa[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Permisoetapa get($primaryKey, $options = [])
 * @method \App\Model\Entity\Permisoetapa findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Permisoetapa patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Permisoetapa[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Permisoetapa|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Permisoetapa saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Permisoetapa[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Permisoetapa[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Permisoetapa[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Permisoetapa[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class PermisoetapasTable extends Table
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

        $this->setTable('permisoetapas');
        $this->setDisplayField('permisoetapas_id');
        $this->setPrimaryKey(['permisoetapas_id', 'stage_id']);

        $this->belongsTo('Permisoetapas', [
            'foreignKey' => 'permisoetapas_id',
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
        $rules->add($rules->existsIn(['permisoetapas_id'], 'Permisoetapas'), ['errorField' => 'permisoetapas_id']);
        $rules->add($rules->existsIn(['stage_id'], 'Stages'), ['errorField' => 'stage_id']);

        return $rules;
    }
}
