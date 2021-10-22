<?php

declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateCommentsClients extends AbstractMigration
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
        $table = $this->table('commentsclients', ['id' => false, 'primary_key' => ['commentclient_id']]);
        $table->addColumn('commentclient_id', 'integer', [
            'autoIncrement' => true,
            'default' => null,
            'limit' => 100,
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
