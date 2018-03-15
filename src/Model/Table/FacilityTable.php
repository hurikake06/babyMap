<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Facility Model
 *
 * @property \App\Model\Table\StationTable|\Cake\ORM\Association\BelongsTo $Station
 * @property \App\Model\Table\TypeTable|\Cake\ORM\Association\BelongsTo $Type
 * @property \App\Model\Table\CategoryTable|\Cake\ORM\Association\BelongsToMany $Category
 *
 * @method \App\Model\Entity\Facility get($primaryKey, $options = [])
 * @method \App\Model\Entity\Facility newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Facility[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Facility|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Facility patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Facility[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Facility findOrCreate($search, callable $callback = null, $options = [])
 */
class FacilityTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('facility');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->belongsTo('Station', [
            'foreignKey' => 'station_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Type', [
            'foreignKey' => 'type_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsToMany('Category', [
            'foreignKey' => 'facility_id',
            'targetForeignKey' => 'category_id',
            'joinTable' => 'facility_category'
        ]);
        $this->hasMany('FacilityCategory',[
            'foreignKey' => 'facility_id'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->allowEmpty('id', 'create')
            ->add('id', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('name')
            ->allowEmpty('name');

        $validator
            ->scalar('time')
            ->requirePresence('time', 'create')
            ->notEmpty('time');

        $validator
            ->scalar('holiday')
            ->requirePresence('holiday', 'create')
            ->notEmpty('holiday');

        $validator
            ->scalar('comment')
            ->requirePresence('comment', 'create')
            ->notEmpty('comment');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->isUnique(['id']));
        $rules->add($rules->existsIn(['station_id'], 'Station'));
        $rules->add($rules->existsIn(['type_id'], 'Type'));

        return $rules;
    }
}
