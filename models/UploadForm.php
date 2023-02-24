<?php
namespace app\models;

use yii\base\Model;
use Yii;

class UploadForm extends Model
{
    public $file;
    public function rules()
    {
        return[
            [['file'], 'file', 'skipOnEmpty' => false, 'extensions' => 'docx, doc', 'checkExtensionByMimeType'=>false,],
        ];
    }

    public function upload()
    {
        if($this->validate()){
            $this->file->saveAs(Yii::getAlias('@webroot').'/uploads/'.$this->file->basename . "." . $this->file->extension);
            return $this->file->basename;
        } else {
            return false;
        }
    }

}