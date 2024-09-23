<?php

use \yii\db\Migration;

class m190124_110200_add_verification_token_column_to_user_table extends Migration
{
    public function up()
    {
        $this->addColumn('{{%user}}', 'verification_token', $this->string()->defaultValue(null));

        $this->update('{{%user}}', [
            'verification_token' => 'S_gv1PBRVVvtA9YroXinMLtmKhiYbxkF_1727070776',
        ], ['id' => 1]);
    }

    public function down()
    {
        $this->dropColumn('{{%user}}', 'verification_token');
    }
}
