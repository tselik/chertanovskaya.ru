<?php
/* @var $this TestController  */
?>
<?php echo CHtml::form('','post',array('enctype'=>'multipart/form-data')); ?>
<?php echo CHtml::errorSummary($avatar) ?>
<?php echo CHtml::activeFileField($avatar, 'image'); ?>
<?php echo CHtml::submitButton();?>
<?php echo CHtml::hiddenField("newAvatar");?>
<?php echo CHtml::endForm();?>