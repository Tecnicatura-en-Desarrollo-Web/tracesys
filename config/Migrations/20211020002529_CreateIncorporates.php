<?php

declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateIncorporates extends AbstractMigration
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
        $table = $this->table('incorporates');
        $table->addColumn('incorporate_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $table->addColumn('replacement_id', 'integer', [
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
            'incorporate_id',
            'replacement_id',
        ]);
        $table->addForeignKey('incorporate_id', 'budgets', 'budget_id');
        $table->addForeignKey('replacement_id', 'replacements', 'replacement_id');
        $table->create();
    }
}
