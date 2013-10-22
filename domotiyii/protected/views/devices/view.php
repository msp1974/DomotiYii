<?php
/* @var $this DevicesController */
/* @var $model Devices */

$this->widget('bootstrap.widgets.TbBreadcrumb', array(
    'links' => array(
        Yii::t('translate','Devices') => 'index',  
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
                array('label'=>Yii::t('translate','Delete'), 'icon'=>'icon-trash', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>Yii::t('translate','Are you sure you want to delete this device?')))
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
                array('name' => 'name'),
		array('name' => 'address'),
		array('name' => 'devicetype.name'),
        // TODO rename _
		array('name' => 'l_location.name'),
		array('name' => 'value'),
		array('name' => 'value2'),
		array('name' => 'value3'),
		array('name' => 'value4'),
		array('name' => 'label'),
		array('name' => 'label2'),
		array('name' => 'label3'),
		array('name' => 'label4'),
		array('name' => 'correction'),
		array('name' => 'correction2'),
		array('name' => 'correction3'),
		array('name' => 'correction4'),
		array('name' => 'onicon'),
		array('name' => 'officon'),
		array('name' => 'dimicon'),
        // TODO rename _
		array('name' => 'l_interface.name'),
		array('name' => 'firstseen'),
		array('name' => 'lastseen'),
		array('name' => 'enabled', 'type' =>'boolean'),
		array('name' => 'hide', 'type' =>'boolean'),
		array('name' => 'log', 'type' =>'boolean'),
		array('name' => 'logdisplay', 'type' =>'boolean'),
		array('name' => 'logspeak', 'type' =>'boolean'),
		array('name' => 'groups'),
		array('name' => 'rrd', 'type' =>'boolean'),
		array('name' => 'graph', 'type' =>'boolean'),
		array('name' => 'batterystatus'),
		array('name' => 'tampered'),
		array('name' => 'comments'),
		array('name' => 'valuerrddsname'),
		array('name' => 'value2rrddsname'),
		array('name' => 'value3rrddsname'),
		array('name' => 'value4rrddsname'),
		array('name' => 'valuerrdtype'),
		array('name' => 'value2rrdtype'),
		array('name' => 'value3rrdtype'),
		array('name' => 'value4rrdtype'),
		array('name' => 'switchable', 'type' =>'boolean'),
		array('name' => 'dimable', 'type' =>'boolean'),
		array('name' => 'extcode', 'type' =>'boolean'),
		array('name' => 'x'),
		array('name' => 'y'),
		array('name' => 'floorplan'),
		array('name' => 'lastchanged'),
		array('name' => 'repeatstate', 'type' =>'boolean'),
		array('name' => 'repeatperiod'),
		array('name' => 'reset', 'type' =>'boolean'),
		array('name' => 'resetperiod'),
		array('name' => 'resetvalue'),
		array('name' => 'poll'),
	),
)); ?>
