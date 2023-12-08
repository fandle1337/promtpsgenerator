<?php

declare(strict_types=1);

use Phinx\Db\Table\Column;
use Phinx\Migration\AbstractMigration;

final class PortalsCreateTable extends AbstractMigration
{
    public function up()
    {
        $table = $this->table('portals');
        $table
            ->addColumn('domain', Column::STRING, ['limit' => 100])
            ->addColumn('lang', Column::STRING, ['limit' => 100])
            ->addColumn('license', Column::STRING, ['limit' => 100])
            ->addColumn('member_id', Column::STRING, ['limit' => 100])
            ->addColumn('access_token', Column::STRING, ['limit' => 100])
            ->addColumn('refresh_token', Column::STRING, ['limit' => 100])
            ->addColumn('date_install', Column::TIMESTAMP, ['default' => 'CURRENT_TIMESTAMP'])
            ->addColumn('date_uninstall', Column::TIMESTAMP, ['null' => true, 'default' => null])
            ->addIndex(['domain', 'member_id', 'access_token', 'refresh_token'], ['unique' => true])
            ->create();
    }

    public function down()
    {
        $this->table('portals')->drop()->save();
    }
}
