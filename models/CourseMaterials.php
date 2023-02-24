<?php
namespace app\models;

use yii\db\ActiveRecord;



class CourseMaterials extends ActiveRecord
{

    public function rules()
    {
        return[
            [['name'], 'required'],
            [['course_id'], 'required'],
            [['course_materials_id'], 'required']
        ];
    }

    public static function tableName()
    {
        return 'course_materials';
    }
}