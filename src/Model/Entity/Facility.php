<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Facility Entity
 *
 * @property int $id
 * @property string $name
 * @property int $station_id
 * @property int $type_id
 * @property string $time
 * @property string $holiday
 * @property string $comment
 *
 * @property \App\Model\Entity\Station $station
 * @property \App\Model\Entity\Type $type
 * @property \App\Model\Entity\Category[] $category
 */
class Facility extends Entity
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
        'name' => true,
        'station_id' => true,
        'type_id' => true,
        'time' => true,
        'holiday' => true,
        'comment' => true,
        'station' => true,
        'type' => true,
        'category' => true
    ];
}
