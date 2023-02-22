<?php
namespace app\models;

use yii\db\ActiveRecord;



class CourseMaterials extends ActiveRecord
{

    public function rules()
    {
        return[
            [['name'], 'required'],
            ['course_id'],
        ];
    }

    public static function tableName()
    {
        return 'course_materials';
    }
}