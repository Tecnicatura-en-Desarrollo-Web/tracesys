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
        $table->addColumn('id_permiso', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $table->addColumn('id_etapa', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $table->addPrimaryKey([
            'id_permiso',
            'id_etapa',
        ]);
        /* $table->addForeignKey('id_permiso', 'permissions', 'id_permiso');
        $table->addForeignKey('id_etapa', 'stages', 'id_etapa');
 */
        $table->create();
    }
}