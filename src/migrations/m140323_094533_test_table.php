<?php

class m140323_094533_test_table extends CDbMigration
{
	public function up()
	{
			  $this->createTable('test_table', array(
            'id'           => 'int(11) NOT NULL AUTO_INCREMENT',
            'sid'          => 'bigint(20) unsigned NOT NULL DEFAULT 0',
            'rule_sign'    => 'bigint(20) unsigned NOT NULL DEFAULT 0',
            'PRIMARY KEY (`id`)',
        ), 'ENGINE=InnoDB CHARSET=utf8');
	}

	public function down()
	{
		echo "m140323_094533_test_table does not support migration down.\n";
		return false;
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}
