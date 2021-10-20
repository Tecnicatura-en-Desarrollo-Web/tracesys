<?php

declare(strict_types=1);

use Migrations\AbstractMigration;

class CreatePermissions extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $table = $this->table('permissions', ['id' => false, 'primary_key' => ['id_permiso']]);
        $table->addColumn('id_permiso', 'integer', [
            'default' => null,
            'limit' => 50,
            'null' => false,
            'autoIncrement' => true
        ]);
        $table->addColumn('nombre_permiso', 'string', [
            'default' => null,
            'limit' => 200,
            'null' => false,
        ]);
        $table->create();
    }
}