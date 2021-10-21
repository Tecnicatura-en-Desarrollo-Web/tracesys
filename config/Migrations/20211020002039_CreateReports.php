<?php

declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateReports extends AbstractMigration
{
    public $autoId = false;

    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $table = $this->table('reports');
        $table->addColumn('report_id', 'integer', [
            'autoIncrement' => true,
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $table->addColumn('employee_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $table->addColumn('state_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $table->addColumn('product_id', 'integer', [
            'default' => null,
            'limit' => 100,
            'null' => false,
        ]);
        $table->addColumn('bill_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $table->addColumn('created', 'datetime', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('modified', 'datetime', [
            'default' => null,
            'null' => false,
        ]);
        $table->addPrimaryKey([
            'report_id',
        ]);
        $table->addForeignKey('employee_id', 'employee', 'employee_id');
        $table->addForeignKey('state_id', 'state', 'state_id');
        $table->addForeignKey('product_id', 'products', 'product_id');
        $table->addForeignKey('bill_id', 'bill', 'bill_id');
        $table->create();
    }
}
