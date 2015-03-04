<?php

use yii\db\Schema;
use yii\db\Migration;

class m141113_115614_create_yii2_start_slider extends Migration
{
    public function safeUp()
    {
        // MySql table options
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';

        // Blogs table
        $this->createTable('{{%slider}}', [
            'id' => Schema::TYPE_PK,
            'h1' => Schema::TYPE_TEXT . ' NOT NULL',
            'h2' => Schema::TYPE_TEXT . ' NOT NULL',
            'h3' => Schema::TYPE_TEXT . ' NOT NULL',
            'align' => Schema::TYPE_STRING . '(128) NOT NULL',
            'img' => Schema::TYPE_STRING . '(64) NOT NULL',
        ], $tableOptions);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('{{%slider}}');
    }
}
