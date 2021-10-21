<?php

declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateEmployee extends AbstractMigration
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
        $table = $this->table('employee');
        $table->addColumn('employee_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $table->addColumn('cuit', 'string', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $table->addColumn('legajo', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false,
        ]);
        $table->addColumn('profile_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $table->addPrimaryKey([
            'employee_id',
        ]);
        $table->addForeignKey('profile_id', 'profile', 'profile_id');
        $table->addForeignKey('employee_id', 'users', 'user_id');
        $table->create();
    }
}
