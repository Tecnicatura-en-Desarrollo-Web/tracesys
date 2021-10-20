<?php

declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateSuggestions extends AbstractMigration
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
        $table = $this->table('suggestions', ['id' => false, 'primary_key' => ['id_sugerencia']]);
        $table->addColumn('id_sugerencia', 'integer', [
            'autoIncrement' => true,
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $table->addColumn('nombre_sugerencia', 'string', [
            'default' => null,
            'limit' => 100,
            'null' => false,
        ]);
        $table->addColumn('descripcion_sugerencia', 'text', [
            'default' => null,
            'limit' => 255,
            'null' => false,
        ]);
        $table->addColumn('importancia', 'string', [
            'default' => null,
            'limit' => 20,
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
        $table->addColumn('id_sector', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        /* $table->addForeignKey('id_sector', 'stages', 'id_sector'); */
        $table->create();
    }
}