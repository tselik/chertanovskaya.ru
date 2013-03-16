<?php
/* @var $this OrgController */
/* @var $model Org */

$this->breadcrumbs=array(
	'Orgs'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Org', 'url'=>array('index')),
	array('label'=>'Manage Org', 'url'=>array('admin')),
);
?>

<h1>Create Org</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>