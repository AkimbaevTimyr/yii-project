<?php

use yii\db\Migration;

/**
 * Class m230217_062113_create_course_list
 */
class m230217_062113_create_course_list extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%courses}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(24),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230217_062113_create_course_list cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230217_062113_create_course_list cannot be reverted.\n";

        return false;
    }
    */
}
