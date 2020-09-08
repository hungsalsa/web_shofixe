<?php

use yii\db\Migration;

/**
 * Class m190410_170209_edit_table_product
 */
class m190410_170209_edit_table_product extends Migration
{
    /**
     * {@inheritdoc}
     */
    // public function init()
    // {
    //     $this->db = 'db1';
    //     parent::init();
    // }
    public function up()
    {
         $this->addColumn('location', $this->integer()->notNull()->after('proName'));
    }
    public function safeUp()
    {
        $this->addColumn('location', $this->integer()->notNull()->after('proName'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190410_170209_edit_table_product cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190410_170209_edit_table_product cannot be reverted.\n";

        return false;
    }
    */
}
