<?php

declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateSugerenciaRepuesto extends AbstractMigration
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
        $table = $this->table('sugerencia_repuesto');
        $table->addColumn('id_sugerencia', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $table->addColumn('id_repuesto', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $table->addColumn('fecha', 'datetime', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('hora', 'datetime', [
            'default' => null,
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
            'id_sugerencia',
            'id_repuesto',
        ]);
        /* $table->addForeignKey('id_sugerencia', 'suggestions', 'id_sugerencia');
        $table->addForeignKey('id_repuesto', 'replacement', 'id_repuesto'); */
        $table->create();
    }
}