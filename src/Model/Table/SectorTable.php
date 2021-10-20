<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Sector Model
 *
 * @method \App\Model\Entity\Sector newEmptyEntity()
 * @method \App\Model\Entity\Sector newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Sector[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Sector get($primaryKey, $options = [])
 * @method \App\Model\Entity\Sector findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Sector patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Sector[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Sector|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Sector saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Sector[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Sector[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Sector[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Sector[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class SectorTable extends Table
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

        $this->setTable('sector');
        $this->setDisplayField('id_sector');
        $this->setPrimaryKey('id_sector');
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
            ->integer('id_sector')
            ->allowEmptyString('id_sector', null, 'create');

        $validator
            ->scalar('nombre_sector')
            ->maxLength('nombre_sector', 255)
            ->requirePresence('nombre_sector', 'create')
            ->notEmptyString('nombre_sector');

        $validator
            ->integer('orden')
            ->requirePresence('orden', 'create')
            ->notEmptyString('orden');

        $validator
            ->scalar('id_etapa')
            ->maxLength('id_etapa', 50)
            ->requirePresence('id_etapa', 'create')
            ->notEmptyString('id_etapa');

        return $validator;
    }
}
