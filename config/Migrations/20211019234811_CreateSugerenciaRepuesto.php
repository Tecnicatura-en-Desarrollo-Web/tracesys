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
        $table->addColumn('sugerencia_repuesto_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $table->addColumn('replacement_id', 'integer', [
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
            'sugerencia_repuesto_id',
            'replacement_id',
        ]);
        $table->addForeignKey('sugerencia_repuesto_id', 'suggestions', 'suggestion_id');
        $table->addForeignKey('replacement_id', 'replacement', 'replacement_id');
        $table->create();
    }
}
