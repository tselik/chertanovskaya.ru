<?php
/* @var $this OrgUserController */
/* @var $model OrgUser */

$this->breadcrumbs=array(
	'Org Users'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List OrgUser', 'url'=>array('index')),
	array('label'=>'Manage OrgUser', 'url'=>array('admin')),
);
?>

<h1>Create OrgUser</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>