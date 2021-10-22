<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Incorporates Model
 *
 * @property \App\Model\Table\IncorporatesTable&\Cake\ORM\Association\BelongsTo $Incorporates
 * @property \App\Model\Table\ReplacementsTable&\Cake\ORM\Association\BelongsTo $Replacements
 *
 * @method \App\Model\Entity\Incorporate newEmptyEntity()
 * @method \App\Model\Entity\Incorporate newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Incorporate[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Incorporate get($primaryKey, $options = [])
 * @method \App\Model\Entity\Incorporate findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Incorporate patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Incorporate[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Incorporate|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Incorporate saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Incorporate[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Incorporate[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Incorporate[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Incorporate[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class IncorporatesTable extends Table
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

        $this->setTable('incorporates');
        $this->setDisplayField('incorporate_id');
        $this->setPrimaryKey(['incorporate_id', 'replacement_id']);

        $this->addBehavior('Timestamp');

        $this->belongsTo('Incorporates', [
            'foreignKey' => 'incorporate_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Replacements', [
            'foreignKey' => 'replacement_id',
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
        $rules->add($rules->existsIn(['incorporate_id'], 'Incorporates'), ['errorField' => 'incorporate_id']);
        $rules->add($rules->existsIn(['replacement_id'], 'Replacements'), ['errorField' => 'replacement_id']);

        return $rules;
    }
}
