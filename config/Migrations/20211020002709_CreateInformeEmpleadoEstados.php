<?php

declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateInformeEmpleadoEstados extends AbstractMigration
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
        $table = $this->table('informeempleadoestados' , ['id' => false, 'primary_key' => ['informeempleadoestado_id_propio']]);
        $table->addColumn('informeempleadoestado_id_propio', 'integer', [
            'autoIncrement' => true,
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $table->addColumn('informeempleadoestado_id', 'integer', [
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
        $table->addColumn('sector_id', 'integer', [
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
        $table->addColumn('ultimoEstado', 'boolean', [
            'default' => true,
            'null' => false,
        ]);
        $table->addPrimaryKey([
            'informeempleadoestado_id_propio',
            'informeempleadoestado_id',
            'employee_id',
            'state_id',
            'sector_id'
        ]);
        $table->addForeignKey('informeempleadoestado_id', 'reports', 'report_id');
        $table->addForeignKey('employee_id', 'employees', 'employee_id');
        $table->addForeignKey('state_id', 'states', 'state_id');
        $table->addForeignKey('sector_id', 'sectors', 'sector_id');
        $table->create();
    }
}
