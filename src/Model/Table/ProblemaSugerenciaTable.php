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
            ->integer('id_problema')
            ->allowEmptyString('id_problema', null, 'create');

        $validator
            ->integer('id_sugerencia')
            ->allowEmptyString('id_sugerencia', null, 'create');

        return $validator;
    }
}
