<?php

declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateProblemaSugerencia extends AbstractMigration
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
        $table = $this->table('problema_sugerencia');
        $table->addColumn('problema_sugerencia_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $table->addColumn('suggestion_id', 'integer', [
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
            'problema_sugerencia_id',
            'suggestion_id',
        ]);
        $table->addForeignKey('problema_sugerencia_id', 'issue', 'issue_id');
        $table->addForeignKey('suggestion_id', 'suggestions', 'suggestion_id');
        $table->create();
    }
}
