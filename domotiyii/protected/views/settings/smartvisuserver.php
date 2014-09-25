<?php
/* @var $this SettingsSmartvisuserverController */
/* @var $model SettingsSmartvisuserver */
/* @var $form CActiveForm */

$this->widget('bootstrap.widgets.TbBreadcrumb', array(
    'links' => array(
        Yii::t('app','Modules') => 'indexModules',
        Yii::t('app','SmartVISU Server'),
    ),
));

$form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id'=>'settings-smartvisuserver-form',
        'layout' => TbHtml::FORM_LAYOUT_HORIZONTAL,
)); ?>

<legend>SmartVISU Server</legend>
<fieldset>
	<?php echo $form->checkBoxControlGroup($model,'enabled', array('value'=>-1)); ?>
	<?php echo $form->numberFieldControlGroup($model,'tcpport'); ?>
	<?php echo $form->checkBoxControlGroup($model,'debug', array('value'=>-1)); ?>
</fieldset>

<?php echo TbHtml::formActions(array(
    TbHtml::submitButton(Yii::t('app','Submit'), array('color' => TbHtml::BUTTON_COLOR_PRIMARY)),
    TbHtml::resetButton(Yii::t('app','Reset')),
)); ?>
<?php $this->endWidget(); ?>
