<?php

use Phpmig\Migration\Migration;

class BizPayTradeRetypeAmount extends Migration
{
    /**
     * Do the migration
     */
    public function up()
    {
        $biz = $this->getContainer();
        $db = $biz['db'];

        if ($this->isFieldExist('biz_pay_trade', 'amount')) {
            $db->exec("ALTER TABLE `biz_pay_trade` MODIFY COLUMN `amount` BIGINT(16) NOT NULL DEFAULT 0 COMMENT '支付价格';");
        }

        if ($this->isFieldExist('biz_pay_trade', 'coin_amount')) {
            $db->exec("ALTER TABLE `biz_pay_trade` MODIFY COLUMN `coin_amount` BIGINT(16) NOT NULL DEFAULT 0 COMMENT '虚拟币的支付价格';");
        }

        if ($this->isFieldExist('biz_pay_trade', 'cash_amount')) {
            $db->exec("ALTER TABLE `biz_pay_trade` MODIFY COLUMN `cash_amount` BIGINT(16) NOT NULL DEFAULT 0 COMMENT '现金的支付价格';");
        }

        if ($this->isFieldExist('biz_pay_user_balance', 'cash_amount')) {
            $db->exec("ALTER TABLE `biz_pay_user_balance` MODIFY COLUMN `cash_amount` BIGINT(16) NOT NULL DEFAULT 0 COMMENT '现金余额';");
        }

        if ($this->isFieldExist('biz_pay_user_balance', 'amount')) {
            $db->exec("ALTER TABLE `biz_pay_user_balance` MODIFY COLUMN `amount` BIGINT(16) NOT NULL DEFAULT 0 COMMENT '虚拟币余额';");
        }

        if ($this->isFieldExist('biz_pay_user_balance', 'locked_amount')) {
            $db->exec("ALTER TABLE `biz_pay_user_balance` MODIFY COLUMN `locked_amount` BIGINT(16) NOT NULL DEFAULT 0 COMMENT '冻结的虚拟币';");
        }

        if ($this->isFieldExist('biz_pay_cashflow', 'amount')) {
            $db->exec("ALTER TABLE `biz_pay_cashflow` MODIFY COLUMN `amount` BIGINT(16) NOT NULL DEFAULT 0 COMMENT '账单金额';");
        }

        if ($this->isFieldExist('biz_pay_cashflow', 'user_balance')) {
            $db->exec("ALTER TABLE `biz_pay_cashflow` MODIFY COLUMN `user_balance` BIGINT(16) NOT NULL DEFAULT 0 COMMENT '生成账单后的用户余额';");
        }
    }

    /**
     * Undo the migration
     */
    public function down()
    {
        $biz = $this->getContainer();
        $db = $biz['db'];

    }

    protected function isFieldExist($table, $filedName)
    {
        $biz = $this->getContainer();
        $db = $biz['db'];

        $sql = "DESCRIBE `{$table}` `{$filedName}`;";
        $result = $db->fetchAssoc($sql);

        return empty($result) ? false : true;
    }
}
