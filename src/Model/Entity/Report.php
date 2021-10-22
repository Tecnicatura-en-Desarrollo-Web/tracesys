<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Report Entity
 *
 * @property int $report_id
 * @property int $employee_id
 * @property int $state_id
 * @property int $product_id
 * @property int $bill_id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Employee $employee
 * @property \App\Model\Entity\State $state
 * @property \App\Model\Entity\Product $product
 * @property \App\Model\Entity\Bill $bill
 */
class Report extends Entity
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
        'employee_id' => true,
        'state_id' => true,
        'product_id' => true,
        'bill_id' => true,
        'created' => true,
        'modified' => true,
        'employee' => true,
        'state' => true,
        'product' => true,
        'bill' => true,
    ];
}
