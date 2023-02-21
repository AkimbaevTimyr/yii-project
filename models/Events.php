<?php
namespace app\models;

use yii\db\ActiveRecord;



class Events extends ActiveRecord
{
    public function rules()
    {
        return[
            [['title'], 'required'],
            [['description'], 'required']
        ];
    }

    public static function tableName()
    {
        return 'events';
    }
}