<?php

declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateSector extends AbstractMigration
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
        $table = $this->table('sector', ['id' => false, 'primary_key' => ['id_sector']]);
        $table->addColumn('id_sector', 'integer', [
            'autoIncrement' => true,
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $table->addColumn('nombre_sector', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false,
        ]);
        $table->addColumn('orden', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $table->addColumn('id_etapa', 'string', [
            'default' => null,
            'limit' => 50,
            'null' => false,
        ]);
        $table->addPrimaryKey([
            'id_sector',
        ]);
        /* $table->addForeignKey('id_etapa', 'stages', 'id_etapa'); */
        $table->create();
    }
}