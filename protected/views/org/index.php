<?php
/* @var $this OrgController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Orgs',
);

$this->menu=array(
	array('label'=>'Create Org', 'url'=>array('create')),
	array('label'=>'Manage Org', 'url'=>array('admin')),
);
?>

<h1>Orgs</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
