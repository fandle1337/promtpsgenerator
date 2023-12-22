<?php

declare(strict_types=1);

use Phinx\Db\Table\Column;
use Phinx\Migration\AbstractMigration;

final class CategoriesCreateTable extends AbstractMigration
{
    public function up()
    {
        $table = $this->table('categories');
        $table
            ->addColumn('code', Column::STRING, ['limit' => 255])
            ->addColumn('name', Column::STRING, ['limit' => 255])
            ->create();
    }

    public function down()
    {
        $this->table('categories')->drop()->save();
    }
}
