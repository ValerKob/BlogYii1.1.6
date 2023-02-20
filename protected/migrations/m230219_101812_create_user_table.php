<?php

class m230219_101812_create_user_table extends CDbMigration
{
    public function up()
    {
        $this->createTable('user', array(
            'id' => 'pk',
            'username' => 'string unique',
            'password' => 'string',
        ));
    }

    public function down()
    {
        $this->dropTable('user');
    }
}
