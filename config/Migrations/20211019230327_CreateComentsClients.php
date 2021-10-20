<?php

declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateComentsClients extends AbstractMigration
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
        $table = $this->table('coments_clients', ['id' => false, 'primary_key' => ['id_comentario']]);
        $table->addColumn('id_comentario', 'integer', [
            'autoIncrement' => true,
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('descripcion', 'string', [
            'default' => null,
            'limit' => 300,
            'null' => false,
        ]);
        $table->create();
    }
}