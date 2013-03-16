<?php
/* @var $this OrgUserController */
/* @var $model OrgUser */

$this->breadcrumbs=array(
	'Org Users'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List OrgUser', 'url'=>array('index')),
	array('label'=>'Create OrgUser', 'url'=>array('create')),
	array('label'=>'Update OrgUser', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete OrgUser', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage OrgUser', 'url'=>array('admin')),
);
?>

<h1>View OrgUser #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'userId',
		'orgId',
		'access',
		'position',
		'invitation',
		'note',
	),
)); ?>
