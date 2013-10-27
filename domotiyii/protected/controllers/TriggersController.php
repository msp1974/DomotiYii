<?php

class TriggersController extends Controller
{
        public function actionIndex()
        {
                $criteria = new CDbCriteria();
                $model=new Triggers('search');
                $model->unsetAttributes(); // clear any default values

                if(isset($_GET['Triggers']))
                {
                        $model->attributes=$_GET['Triggers'];
                        if (!empty($model->name)) $criteria->addCondition('name = "'.$model->name.'"');
                        if (!empty($model->description)) $criteria->addCondition('description = "'.$model->description.'"');
                        if (!empty($model->type)) $criteria->addCondition('type = "'.$model->type.'"');
                }
                $this->render('index', array('model'=>$model));
        }

        public function actionView($id)
        {
                $model = Triggers::model()->findByPk($id);
                $this->render('view', array('model'=>$model));
        }

        public function actionUpdate($id)
        {
                $model = Triggers::model()->findByPk($id);
                if(isset($_POST['Triggers']))
                {
                        $model->attributes=$_POST['Triggers'];
                        if($model->validate())
                        {
                                // form inputs are valid, do something here
                                $this->do_save($model);
                        }
                }
                $this->render('update',array(
                        'model'=>$model,
                ));
        }

        public function actionDelete($id)
        {
                // delete the entry from the "triggers" table
                $model = Triggers::model()->findByPk($id);
                $this->do_delete($model);

        }

        public function actionCreate()
        {
                $model=new Triggers;

                // Uncomment the following line if AJAX validation is needed
                // $this->performAjaxValidation($model);

                if(isset($_POST['Triggers']))
                {
                        $model->attributes=$_POST['Triggers'];
                        if($model->validate())
                        {
                                $this->do_save($model);
                        }
                }
                $this->render('create',array(
                        'model'=>$model,
                ));
        }

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/

        protected function do_save($model)
        {
                if ( $model->save() === false )
                {
                        Yii::app()->user->setFlash('error', "Saving trigger... Failed!");
                } else {
                        Yii::app()->user->setFlash('success', "Saving trigger... Successful.");
                }
        }

	protected function do_delete($model)
	{
		if ( $model->delete() === false ) {
			Yii::app()->user->setFlash('error', "Deleting event... Failed!");
		} else {
			Yii::app()->user->setFlash('success', "Deleting event... Successful.");
		}
	}
}
