<?php

declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateAdministradors extends AbstractMigration
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
        $table = $this->table('administradors');
        $table->addColumn('administrador_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $table->addColumn('cuit_admin', 'string', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $table->addPrimaryKey([
            'administrador_id',
        ]);
        $table->addForeignKey('administrador_id', 'users', 'user_id');
        $table->create();
    }
}
