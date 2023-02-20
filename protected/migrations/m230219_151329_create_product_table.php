<?php

class m230219_151329_create_product_table extends CDbMigration
{
    public function up()
    {
        $this->createTable('product', array(
            'id' => 'pk',
            'id_user' => 'integer',
            'username_user' => 'string',
            'name' => 'string',
            'content' => 'text',
            'date_post' => 'dateTime',
        ));
    }

    public function down()
    {
        $this->dropTable('product');
    }
}
