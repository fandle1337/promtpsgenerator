<?php

declare(strict_types=1);

use App\Enum\EnumCategoryList;
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
            ->addColumn('code', Column::STRING, ['limit' => 255])
            ->addColumn('icon', Column::STRING, ['limit' => 255])
            ->addColumn('prompt', Column::TEXT)
            ->addColumn('parent_code', Column::STRING, ['limit' => 255])
            ->addColumn('sort', Column::INTEGER)
            ->addColumn('section', Column::STRING, ['limit' => 255])
            ->create();

        $categoryTable = $this->table('template_categories');
        $categoryTable
            ->addColumn('template_id', Column::INTEGER, ['signed' => false])
            ->addColumn('code', Column::ENUM, ['values' => EnumCategoryList::CATEGORIES])
            ->addForeignKey('template_id', 'templates', 'id', ['delete' => 'CASCADE', 'update' => 'NO_ACTION'])
            ->create();
    }

    public function down()
    {
        $this->table('templates')->drop()->save();
        $this->table('template_categories')->drop()->save();
    }
}
