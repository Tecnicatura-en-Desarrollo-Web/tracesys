<?php

declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateClienteInformeComentario extends AbstractMigration
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
        $table = $this->table('cliente_informe_comentario');
        $table->addColumn('cliente_informe_comentario_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $table->addColumn('cuit', 'string', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $table->addColumn('comment_client_id', 'integer', [
            'default' => null,
            'limit' => 100,
            'null' => false,
        ]);
        $table->addColumn('report_id', 'integer', [
            'default' => null,
            'limit' => 11,
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
            'cliente_informe_comentario_id',
            'comment_client_id',
            'report_id',
        ]);
        $table->addForeignKey('cliente_informe_comentario_id', 'employee', 'employee_id');
        $table->addForeignKey('comment_client_id', 'comments_clients', 'comment_client_id');
        $table->addForeignKey('report_id', 'reports', 'report_id');
        $table->create();
    }
}
