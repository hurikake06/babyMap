<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * FacilityCategory Model
 *
 * @property \App\Model\Table\FacilityTable|\Cake\ORM\Association\BelongsTo $Facility
 * @property \App\Model\Table\CategoryTable|\Cake\ORM\Association\BelongsTo $Category
 *
 * @method \App\Model\Entity\FacilityCategory get($primaryKey, $options = [])
 * @method \App\Model\Entity\FacilityCategory newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\FacilityCategory[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\FacilityCategory|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\FacilityCategory patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\FacilityCategory[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\FacilityCategory findOrCreate($search, callable $callback = null, $options = [])
 */
class FacilityCategoryTable extends Table
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

        $this->setTable('facility_category');
        $this->setDisplayField('facility_id');
        $this->setPrimaryKey(['facility_id', 'category_id']);

        $this->belongsTo('Facility', [
            'foreignKey' => 'facility_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Category', [
            'foreignKey' => 'category_id',
            'joinType' => 'INNER'
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
            ->boolean('sex')
            ->requirePresence('sex', 'create')
            ->notEmpty('sex');

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
        $rules->add($rules->existsIn(['facility_id'], 'Facility'));
        $rules->add($rules->existsIn(['category_id'], 'Category'));

        return $rules;
    }
}
