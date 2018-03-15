<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * StationCategory Entity
 *
 * @property int $station_id
 * @property int $category_id
 * @property bool $sex
 *
 * @property \App\Model\Entity\Station $station
 * @property \App\Model\Entity\Category $category
 */
class StationCategory extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'sex' => true,
        'station' => true,
        'category' => true
    ];
}
