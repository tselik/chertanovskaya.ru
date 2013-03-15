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
    private  static function  uploadUrl()
    {
        return  Avatar::pathToAvatars;
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
    public function pathToImage()
    {
        return Avatar::uploadpath().$this->name.".jpg";
    }
    public function urlToImage()
    {
        return Avatar::uploadUrl().$this->name.".jpg";
    }
    public function pathToAvatar()
    {
        return Avatar::uploadpath().$this->name."avatar.jpg";
    }

    public function urlToAvatar()
    {
        if(!$this->validate())return "upload/avatarDefault.jpg";
        $time = filemtime($this->pathToAvatar());
        return Avatar::uploadurl().$this->name."avatar.jpg?".$time;
    }
    ///загрзка фотографии для аватара
    public function upload($image)
    {
        $this->image=$image;
        $file = CUploadedFile::getInstance($this, 'image');
        if($file==null){
            $this->addError("image","Вы не выбрали файл");
            return false;
        }
        try {
           $image = new Image($file->getTempName());
        } catch (Exception $e) {
           $this->addError("image","Файл не является фотографией");
           return false;
        }
        if($image->height<100 && $image->height<100){
            $this->addError("image","минимальный размер 100 px по ширине и высоте");
            return false;
        }
        if($image->width>Avatar::manWidth)$image->resize(Avatar::manWidth,null);
        if($image->height>Avatar::maxHeight)$image->resize(null,Avatar::maxHeight);
        $this->name=DFileHelper::getRandomFileName(Avatar::uploadpath(),"jpg");
        $image->save($this->pathToImage());
        $this->automaticOfCutAvatar();
        return true;
    }
    ///вырезать аватар по параметрам
    public function cutAvatar($top,$left,$length)
    {
        $image =new Image($this->pathToImage());
        $image->crop($length,$length,$top,$left);
        $image->resize(100,100);
        $image->save($this->pathToAvatar());
    }
    ///автоматически вырезать аватар
    public function automaticOfCutAvatar()
    {
       $image =new Image($this->pathToImage());
       $length= min($image->width,$image->height);
       $top= (($image->height-$length)/2);
       $left= (($image->width-$length)/2);
       $this->cutAvatar($top,$left,$length);
    }
    public function validate()
    {
        if($this->name==null)return false;
        if(!file_exists($this->pathToImage()))return false;
        if(!file_exists($this->pathToAvatar()))$this->automaticOfCutAvatar();
        return parent::validate();
    }


}
