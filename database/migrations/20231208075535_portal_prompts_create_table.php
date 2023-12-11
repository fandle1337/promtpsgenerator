<?php

declare(strict_types=1);

use Phinx\Db\Table\Column;
use Phinx\Migration\AbstractMigration;

final class PortalPromptsCreateTable extends AbstractMigration
{
    public function up()
    {
        $table = $this->table('portal_prompts');
        $table
            ->addColumn('portal_id', Column::INTEGER, ['limit' => 255])
            ->addColumn('ru_name', Column::STRING, ['limit' => 255])
            ->addColumn('en_name', Column::STRING, ['limit' => 255])
            ->addColumn('categories', Column::STRING, ['limit' => 255])
            ->addColumn('code', Column::STRING, ['limit' => 255])
            ->addColumn('icon', Column::STRING, ['limit' => 255])
            ->addColumn('prompt', Column::STRING, ['limit' => 255])
            ->addColumn('parent_code', Column::STRING, ['limit' => 255, 'null' => true, 'default' => null])
            ->addColumn('sort', Column::INTEGER, ['limit' => 255, 'null' => true, 'default' => null])
            ->addColumn('date_created', Column::TIMESTAMP, ['default' => 'CURRENT_TIMESTAMP'])
            ->create();
    }

    public function down()
    {
        $this->table('portal_prompts')->drop()->save();
    }
}
