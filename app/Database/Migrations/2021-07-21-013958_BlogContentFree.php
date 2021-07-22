<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class BlogContentFree extends Migration
{
	public function up()
	{

		$this->forge->addColumn('blog',[
			'is_free'          => [
				'type'           => 'INT(1)',
				'default'        => 0,
			]
		]);
	}

	public function down()
	{
		//
	}
}
