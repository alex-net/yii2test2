<?php

use yii\db\Migration;

/**
 * Class m181120_094606_currency
 */
class m181120_094606_currency extends Migration
{
    
    
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->createTable('currency',[
            'id'=>$this->string(3)->comment('Ключ валюты'),
            'name'=>$this->string(100)->comment('Название валюты'),
            'rate'=>$this->decimal(8,4)->comment('курс к рублю'),
        ]);
        $this->addPrimaryKey('pkeycurrency','currency',['id']);;
    }

    public function down()
    {
        //echo "m181120_094606_currency cannot be reverted.\n";
        $this->dropTable('currency');
        return true;
        
    }
    
}
