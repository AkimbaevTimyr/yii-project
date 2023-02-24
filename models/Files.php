<?php
namespace app\models;

use yii\db\ActiveRecord;



class Files extends ActiveRecord
{
    public function rules()
    {
        return[
            [['file'], 'required']
        ];
    }

    public function saveImage($filename)
    {
        $this->file = $filename;
        return $this->save(false);
    }

    public static function tableName()
    {
        return 'course_files';
    }
}