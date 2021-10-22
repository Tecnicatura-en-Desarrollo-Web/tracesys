<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateProfiles extends AbstractMigration
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
        $table = $this->table('profiles');
        $table->addColumn('profile_id', 'integer', [
            'autoIncrement' => true,
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $table->addColumn('nombre_perfil', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false,
        ]);
        $table->addPrimaryKey([
            'profile_id',
        ]);
        $table->create();
    }
}
