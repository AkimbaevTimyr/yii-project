<?php
namespace app\models;

use yii\db\ActiveRecord;



class Courses extends ActiveRecord
{
    public function rules()
    {
        return[
            [['id'], 'required'],
            [['name'], 'required'],
        ];
    }

    public static function tableName()
    {
        return 'courses';
    }
}