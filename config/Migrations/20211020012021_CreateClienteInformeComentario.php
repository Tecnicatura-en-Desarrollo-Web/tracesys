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
        $table->addColumn('cuit', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $table->addColumn('id_comentario', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $table->addColumn('id_informe', 'integer', [
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
            'cuit',
            'id_comentario',
            'id_informe',
        ]);
        /* $table->addForeignKey('cuit', 'employee', 'cuit');
        $table->addForeignKey('id_comentario', 'comments_clients', 'id_comentario');
        $table->addForeignKey('id_informe', 'reports', 'id_informe'); */
        $table->create();
    }
}