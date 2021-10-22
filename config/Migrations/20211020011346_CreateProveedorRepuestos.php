<?php

declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateProveedorRepuestos extends AbstractMigration
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
        $table = $this->table('proveedorrepuestos');
        $table->addColumn('proveedorrepuesto_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $table->addColumn('provider_id', 'integer', [
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
            'proveedorrepuesto_id',
            'provider_id',
        ]);
        $table->addForeignKey('proveedorrepuesto_id', 'replacements', 'replacement_id');
        $table->addForeignKey('provider_id', 'providers', 'provider_id');
        $table->create();
    }
}
