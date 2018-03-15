<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * StationCategory Model
 *
 * @property \App\Model\Table\StationsTable|\Cake\ORM\Association\BelongsTo $Stations
 * @property \App\Model\Table\CategoriesTable|\Cake\ORM\Association\BelongsTo $Categories
 *
 * @method \App\Model\Entity\StationCategory get($primaryKey, $options = [])
 * @method \App\Model\Entity\StationCategory newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\StationCategory[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\StationCategory|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\StationCategory patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\StationCategory[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\StationCategory findOrCreate($search, callable $callback = null, $options = [])
 */
class StationCategoryTable extends Table
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

        $this->setTable('station_category');
        $this->setDisplayField('station_id');
        $this->setPrimaryKey(['station_id', 'category_id']);

        $this->belongsTo('Stations', [
            'foreignKey' => 'station_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Categories', [
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
        $rules->add($rules->existsIn(['station_id'], 'Stations'));
        $rules->add($rules->existsIn(['category_id'], 'Categories'));

        return $rules;
    }
}
