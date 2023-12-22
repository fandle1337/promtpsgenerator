<?php

declare(strict_types=1);

use App\Enum\EnumCategoryList;
use Phinx\Db\Table\Column;
use Phinx\Migration\AbstractMigration;

final class PortalPromptsCreateTable extends AbstractMigration
{
    public function up()
    {
        $table = $this->table('portal_prompts');
        $table
            ->addColumn('portal_id', Column::INTEGER)
            ->addColumn('ru_name', Column::STRING, ['limit' => 255])
            ->addColumn('en_name', Column::STRING, ['limit' => 255])
            ->addColumn('code', Column::STRING, ['limit' => 255])
            ->addColumn('icon', Column::STRING, ['limit' => 255])
            ->addColumn('section', Column::STRING, ['limit' => 255])
            ->addColumn('prompt', Column::TEXT)
            ->addColumn('parent_code', Column::STRING, ['limit' => 255, 'null' => true, 'default' => null])
            ->addColumn('sort', Column::INTEGER, ['null' => true, 'default' => null])
            ->addColumn('date_created', Column::TIMESTAMP, ['default' => 'CURRENT_TIMESTAMP'])
            ->create();

        $categoryTable = $this->table('prompt_categories');
        $categoryTable
            ->addColumn('prompt_id', Column::INTEGER, ['signed' => false])
            ->addColumn('code', Column::ENUM, ['values' => EnumCategoryList::CATEGORIES])
            ->addForeignKey('prompt_id', 'portal_prompts', 'id', ['delete' => 'CASCADE', 'update' => 'NO_ACTION'])
            ->create();
    }

    public function down()
    {
        $this->table('portal_prompts')->drop()->save();
        $this->table('prompt_categories')->drop()->save();
    }
}
