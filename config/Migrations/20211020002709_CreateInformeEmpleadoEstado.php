<?php

declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateInformeEmpleadoEstado extends AbstractMigration
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
        $table = $this->table('informe_empleado_estado');
        $table->addColumn('informe_empleado_estado_id', 'integer', [
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
        $table->addColumn('created', 'datetime', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('modified', 'datetime', [
            'default' => null,
            'null' => false,
        ]);
        $table->addPrimaryKey([
            'informe_empleado_estado_id',
            'employee_id',
            'state_id',
        ]);
        $table->addForeignKey('informe_empleado_estado_id', 'reports', 'report_id');
        $table->addForeignKey('employee_id', 'employee', 'employee_id');
        $table->addForeignKey('state_id', 'state', 'state_id');
        $table->create();
    }
}
