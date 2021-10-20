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
        $table->addColumn('id_informe', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $table->addColumn('cuit', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $table->addColumn('id_estado', 'integer', [
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
            'id_informe',
            'cuit',
            'id_estado',
        ]);
        /* $table->addForeignKey('id_informe', 'reports', 'id_informe');
        $table->addForeignKey('cuit', 'employee', 'cuit');
        $table->addForeignKey('id_estado', 'state', 'id_estado'); */
        $table->create();
    }
}