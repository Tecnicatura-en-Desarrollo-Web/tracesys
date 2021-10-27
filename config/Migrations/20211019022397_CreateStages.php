<?php

declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateStages extends AbstractMigration
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
        $table = $this->table('stages', ['id' => false, 'primary_key' => ['stage_id']]);
        $table->addColumn('stage_id', 'integer', [
            'default' => null,
            'limit' => 50,
            'null' => false,
            'autoIncrement' => true,
        ]);
        $table->addColumn('nombre_etapa', 'string', [
            'default' => null,
            'limit' => 200,
            'null' => false,
        ]);


        $table->create();
    }
}
