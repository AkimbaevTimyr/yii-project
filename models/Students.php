<?php
namespace app\models;

use yii\db\ActiveRecord;



class Students extends ActiveRecord
{
    public function rules()
    {
        return[
            [['name'], 'required']
        ];
    }

    public static function tableName()
    {
        return 'students';
    }
}