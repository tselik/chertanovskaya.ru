<?php
/* @var $this OrgUserController */
/* @var $model OrgUser */

$this->breadcrumbs=array(
	'Org Users'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List OrgUser', 'url'=>array('index')),
	array('label'=>'Create OrgUser', 'url'=>array('create')),
	array('label'=>'View OrgUser', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage OrgUser', 'url'=>array('admin')),
);
?>

<h1>Update OrgUser <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>