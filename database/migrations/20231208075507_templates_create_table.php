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
            ->addColumn('ru_name', Column::STRING, ['limit' => 255])
            ->addColumn('en_name', Column::STRING, ['limit' => 255])
            ->addColumn('categories', Column::STRING, ['limit' => 255])
            ->addColumn('code', Column::STRING, ['limit' => 255])
            ->addColumn('icon', Column::STRING, ['limit' => 255])
            ->addColumn('prompt', Column::TEXT)
            ->addColumn('parent_code', Column::STRING, ['limit' => 255])
            ->addColumn('sort', Column::BIGINTEGER, ['limit' => 255])
            ->addColumn('section', Column::STRING, ['limit' => 255])
            ->create();
    }

    public function down()
    {
        $this->table('templates')->drop()->save();
    }
}
