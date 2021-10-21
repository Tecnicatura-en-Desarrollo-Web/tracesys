<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ProblemaSugerencia Model
 *
 * @method \App\Model\Entity\ProblemaSugerencium newEmptyEntity()
 * @method \App\Model\Entity\ProblemaSugerencium newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\ProblemaSugerencium[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ProblemaSugerencium get($primaryKey, $options = [])
 * @method \App\Model\Entity\ProblemaSugerencium findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\ProblemaSugerencium patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ProblemaSugerencium[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\ProblemaSugerencium|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ProblemaSugerencium saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ProblemaSugerencium[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\ProblemaSugerencium[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\ProblemaSugerencium[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\ProblemaSugerencium[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ProblemaSugerenciaTable extends Table
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

        $this->setTable('problema_sugerencia');
        $this->setDisplayField('id_problema');
        $this->setPrimaryKey(['id_problema', 'id_sugerencia']);

        $this->addBehavior('Timestamp');

        $this->belongsTo('Issue', [
            'foreignKey' => 'problema_sugerencia_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Suggestions', [
            'foreignKey' => 'suggestion_id',
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
        $rules->add($rules->existsIn(['problema_sugerencia_id'], 'Issue'), ['errorField' => 'problema_sugerencia_id']);
        $rules->add($rules->existsIn(['suggestion_id'], 'Suggestions'), ['errorField' => 'suggestion_id']);

        return $rules;
    }
}
