<?php

declare(strict_types=1);

use Phinx\Db\Table\Column;
use Phinx\Migration\AbstractMigration;

final class TemplatesCreateTable extends AbstractMigration
{
    public function up()
    {
        $table = $this->table('templates');
        $table
            ->addColumn('name', Column::STRING, ['limit' => 255])
            ->addColumn('category', Column::JSON, ['limit' => 255])
            ->addColumn('code', Column::STRING, ['limit' => 255])
            ->addColumn('icon', Column::STRING, ['limit' => 255])
            ->addColumn('prompt', Column::STRING, ['limit' => 255])
            ->addColumn('translate', Column::JSON, ['limit' => 255])
            ->addColumn('parent_code', Column::STRING, ['limit' => 255])
            ->addColumn('sort', Column::INTEGER, ['limit' => 255])
            ->create();
    }

    public function down()
    {
        $this->table('templates')->drop()->save();
    }
}
