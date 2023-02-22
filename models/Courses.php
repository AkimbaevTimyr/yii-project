<?php
namespace app\models;

use yii\db\ActiveRecord;



class Courses extends ActiveRecord
{

    public function rules()
    {
        return[
            [['name'], 'required'],
        ];
    }

    public static function tableName()
    {
        return 'courses';
    }
}