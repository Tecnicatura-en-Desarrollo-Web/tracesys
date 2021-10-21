<?php

declare(strict_types=1);

use Migrations\AbstractMigration;

class CreatePermisoEtapa extends AbstractMigration
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
        $table = $this->table('permiso_etapa');
        $table->addColumn('permiso_etapa_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $table->addColumn('stage_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $table->addPrimaryKey([
            'permiso_etapa_id',
            'stage_id',
        ]);
        $table->addForeignKey('permiso_etapa_id', 'permissions', 'permission_id');
        $table->addForeignKey('stage_id', 'stages', 'stage_id');

        $table->create();
    }
}
