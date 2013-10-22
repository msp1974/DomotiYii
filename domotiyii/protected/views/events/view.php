<?php
/* @var $this EventsController */
/* @var $model Events */

$this->widget('bootstrap.widgets.TbBreadcrumb', array(
    'links' => array(
        Yii::t('translate','Events') => 'index',  
        Yii::t('translate','View'),
    ),
));

$this->beginWidget('zii.widgets.CPortlet', array(
        'htmlOptions'=>array(
                'class'=>''
        )
));
$this->widget('bootstrap.widgets.TbNav', array(
        'type'=>TbHtml::NAV_TYPE_PILLS,
        'items'=>array(
                array('label'=>Yii::t('translate','List'), 'icon'=>'icon-th-list', 'url'=>Yii::app()->controller->createUrl('index'), 'linkOptions'=>array()),
                array('label'=>Yii::t('translate','Create'), 'icon'=>'icon-plus', 'url'=>Yii::app()->controller->createUrl('create'), 'linkOptions'=>array()),
                array('label'=>Yii::t('translate','View'), 'icon'=>'icon-eye-open', 'url'=>array('view', 'id'=>$model->id), 'active'=>true, 'linkOptions'=>array()),
                array('label'=>Yii::t('translate','Edit'), 'icon'=>'icon-edit', 'url'=>array('update', 'id'=>$model->id)),
                array('label'=>Yii::t('translate','Delete'), 'icon'=>'icon-trash', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>Yii::t('translate','Are you sure you want to delete this event?')))
        ),
));
$this->endWidget();
?>

<legend><?php echo $model->name;?></legend>

<?php $this->widget('domotiyii.DetailView', array(
	'type' => 'striped condensed',
	'data'=>$model,
        'attributes'=>array(
                array('name' => 'id'),
		array('name' => 'enabled', 'type' =>'boolean'),
                array('name' => 'name'),
		array('name' => 'description'),
		array('name' => 'triggername'),
		array('name' => 'conditionname1'),
		array('name' => 'operand'),
		array('name' => 'conditionname2'),
		array('name' => 'actionname1'),
		array('name' => 'actionname2'),
		array('name' => 'actionname3'),
		array('name' => 'rerunenabled', 'type' =>'boolean'),
		array('name' => 'rerunvalue'),
		array('name' => 'reruntype'),
		array('name' => 'categoryname'),
		array('name' => 'firstrun'),
		array('name' => 'lastrun'),
		array('name' => 'log', 'type' =>'boolean'),
		array('name' => 'comments'),
	),
)); ?>
