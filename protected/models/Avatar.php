<?php

class  Avatar  extends CFormModel
{
    const maxHeight = 1024;
    const manWidth  = 1024;
    const  pathToAvatars = "/upload/avatars/";
    private  static function  uploadpath()
    {
        return Yii::getPathOfAlias('webroot') . Avatar::pathToAvatars;
    }
    ///Имя файла аватара
    public  $name;
    /// для загрузки аватара
    public  $image;
    public   function __construct($name=null)
    {
       Yii::import('application.extensions.image.Image');
       $this->name= $name;
    }
    public function upload($image)
    {
        $this->image=$image;
        $file = CUploadedFile::getInstance($this, 'image');
        if($file==null){
            echo "ss";
            $this->addError("image","Вы не выбрали файл");
            return;
        }
        try {
           $image = new Image($file->getTempName());
        } catch (Exception $e) {
           $this->addError("image","Файл не является фотографией");
           return;
        }
        if($image->height<100 && $image->height<100){
            $this->addError("image","минмальный размер 100px по ширине и высоте");
            return;
        }
        if($image->width>Avatar::manWidth)$image->resize(Avatar::manWidth,null);
        if($image->height>Avatar::maxHeight)$image->resize(null,Avatar::maxHeight);
        $image->save(Avatar::uploadpath()."1.jpg");


    }
    public function validate()
    {

        parent::validate();
    }



}
