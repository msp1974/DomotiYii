<?php
/* @var $this SettingsGmailController */
/* @var $model SettingsGmail */
/* @var $form bootstrap.widgets.TbActiveForm */

$this->widget('bootstrap.widgets.TbBreadcrumb', array(
    'links' => array(
        Yii::t('app','Modules') => '../index',
        Yii::t('app','GMail'),
    ),
));

$form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id'=>'login-form',
        'layout' => TbHtml::FORM_LAYOUT_HORIZONTAL,
)); ?>

<fieldset>

		<?php echo $form->checkBoxControlGroup($model,'enabled', array('value'=>-1)); ?>
		<?php echo $form->numberFieldControlGroup($model,'polltime', array('append' => 'Seconds')); ?>
		<?php echo $form->emailFieldControlGroup($model,'user'); ?>
		<?php echo $form->passwordFieldControlGroup($model,'password'); ?>
		<?php echo $form->checkBoxControlGroup($model,'debug', array('value'=>-1)); ?>

</fieldset>

<?php echo TbHtml::formActions(array(
    TbHtml::submitButton(Yii::t('app','Submit'), array('color' => TbHtml::BUTTON_COLOR_PRIMARY)),
    TbHtml::resetButton(Yii::t('app','Reset')),
)); ?>
<?php $this->endWidget(); ?>
