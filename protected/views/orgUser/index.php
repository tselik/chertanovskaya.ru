<?php
/* @var $this OrgUserController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Org Users',
);

$this->menu=array(
	array('label'=>'Create OrgUser', 'url'=>array('create')),
	array('label'=>'Manage OrgUser', 'url'=>array('admin')),
);
?>

<h1>Org Users</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
