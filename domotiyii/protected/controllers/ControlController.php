<?php

class ControlController extends CController {

    public $mobile_page = FALSE;

    /**
     * Default filter for access rules
     * */
    public function filters() {
        return array(
            'accessControl',
        );
    }

    /**
     * Default access rules
     * */
    public function accessRules() {
        return array(
            array('allow', // allow authenticated user 
                'users' => array('@'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function init() {
        parent::init();
        Yii::app()->layout = '//layouts/normal';
        set_time_limit(30);
    }

    public function actionTable() {
        $crit = $this->getFilter();

        $res = Devices::model()->findAll($crit);
        $tab = array();
        foreach ($res as $obj) {
            $row = array(
                $obj->id,
                str_replace('"', "'", $obj->icon),
                $obj->name,
                $obj->locationtext,
                $this->getActions($obj),
                CHtml::value($obj, 'deviceValue1.value'),
                CHtml::value($obj, 'deviceValue2.value'),
                CHtml::value($obj, 'deviceValue3.value'),
                CHtml::value($obj, 'deviceValue4.value'),
                $obj->lastchanged,
            );

            $tab[] = $row;
        }
        if (!is_null(yii::app()->request->getParam('ajax'))) {
            $data = array('aaData' => $tab);
            die($this->renderPartial('jsonData', array('data' => $data), TRUE));
        }
        else
            $this->render('table', array('data' => $tab));
    }

    public function actionList() {
        $date = yii::app()->request->getParam('date');

        $crit = $this->getFilter();
        if ($date !== NULL) {
            $crit->addCondition("t.lastchanged > :date");
            $crit->params[':date'] = $date;
        }
        $res = Devices::model()->findAll($crit);
        $maxdate = '';
        $tab = array();
        foreach ($res as $obj) {
            $row = array(
                'id' => $obj->id,
                'icon' => str_replace('"', "'", $obj->icon),
                'name' => $obj->name,
                'location' => $obj->locationtext,
                'commands' => $this->getActions($obj),
                'val1' => CHtml::value($obj, 'deviceValue1.value'),
                'val2' => CHtml::value($obj, 'deviceValue2.value'),
                'val3' => CHtml::value($obj, 'deviceValue3.value'),
                'val4' => CHtml::value($obj, 'deviceValue4.value'),
                'lastchanged' => $obj->lastchanged,
            );
            if ($maxdate < $obj->lastchanged)
                $maxdate = $obj->lastchanged;
            $tab[] = $row;
        }
        if ($maxdate == '')
            $maxdate = $date;
        if (!is_null(yii::app()->request->getParam('ajax'))) {
            $data = array('tab' => $tab, 'maxdate' => $maxdate);
            die($this->renderPartial('jsonData', array('data' => $data), TRUE));
        }
        else
            $this->render('list', array('data' => $tab));
    }

    public function actionListLongPoll() {
        $date = yii::app()->request->getParam('date');

        $crit = $this->getFilter();
        if ($date !== NULL) {
            $crit->addCondition("t.lastchanged > :date");
            $crit->params[':date'] = $date;
        }
        $nb = 0;
        while (true) {
            $nb++;
            $maxdate = '';
            $res = Devices::model()->findAll($crit);
            $tab = array();
            foreach ($res as $obj) {
                $row = array(
                    'id' => $obj->id,
                    'icon' => str_replace('"', "'", $obj->icon),
                    'name' => $obj->name,
                    'location' => $obj->locationtext,
                    'commands' => $this->getActions($obj),
                    'val1' => CHtml::value($obj, 'deviceValue1.value'),
                    'val2' => CHtml::value($obj, 'deviceValue2.value'),
                    'val3' => CHtml::value($obj, 'deviceValue3.value'),
                    'val4' => CHtml::value($obj, 'deviceValue4.value'),
                    'lastchanged' => $obj->lastchanged,
                );
                if ($maxdate < $obj->lastchanged)
                    $maxdate = $obj->lastchanged;
                $tab[] = $row;
            }
            if ($maxdate == '')
                $maxdate = $date;
            if (($maxdate !== $date && count($tab) > 0) || $nb > 20) {
                $data = array('tab' => $tab, 'maxdate' => $maxdate);
                die($this->renderPartial('jsonData', array('data' => $data), TRUE));
            }
            else
                sleep(1);
        }
    }

    private function getFilter() {
        $crit = new CDbCriteria();
        $type = yii::app()->request->getParam('type', 'Control');
        $location = yii::app()->request->getParam('location', 'All');
        $crit->order = 't.name ASC';
        if ($type == 'Control') {
            $crit->addCondition('enabled is TRUE');
            $crit->addCondition('hide is FALSE');
            $crit->addColumnCondition(array('switchable' => -1, 'dimable' => -1), 'OR');
        } else if ($type == 'All') {
            $crit->addCondition('enabled is TRUE');
            $crit->addCondition('hide is FALSE');
        } else if ($type == 'Sensors') {
            $crit->addCondition('enabled is TRUE');
            $crit->addCondition('hide is FALSE');
            $crit->addColumnCondition(array('switchable' => 0, 'dimable' => 0));
        }
        if ($location !== 'All') {
            $crit->with = 'l_location';
            $crit->addCondition("l_location.name='$location'");
        }
        return $crit;
    }

    protected function getActions($obj) {
        if (isset($obj->deviceValue1->value)) {
            $tmp = str_replace('Dim ', '', $obj->deviceValue1->value);
            if ($tmp == 'Off')
                $tmp = 0; else
            if ($tmp == 'On')
                $tmp = 100;
            $valueOne = (!is_numeric($tmp) ? 0 : $tmp);
            $dimmer = '<div class="slider-container" style="text-align:center;margin:0px;"><input type="text" class="slider" value="" data-slider-min="0" data-slider-max="100" data-slider-step="1" data-slider-value="' . $valueOne . '" data-slider-orientation="horizontal" data-device="' . $obj->id . '" data-slider-selection="after" data-slider-tooltip="hide">&nbsp;<span style="font-weigth:bold;"></span></div>';
            $space = '<div class="fixSpace"></div>';
            $buttons = '<button type="button" name="but" onClick="btAction(event,this)" data-action="Off" data-device="' . $obj->id . '" class="btn btn-primary btn-mini">Off</button>&nbsp;<button type="button" onClick="btAction(event,this)" data-action="On" data-device="' . $obj->id . '" class="btn btn-primary btn-mini">On</button>';
            if ($obj->SPdevice) {
                $comma = FALSE;
                $tmp = $obj->deviceValue1->value;
                if (strpos($tmp, 'SP') !== FALSE)
                    $tmp = str_replace('SP ', '', $tmp);

                $buff = '<button type="button" name="but" class="btSetPoint btMoins">-</button>'
                    . '<input type="text" class="inputSetPoint" value="' . $tmp . '">'
                    . '<button type="button" class="btSetPoint btPlus">+</button>'
                    . '&nbsp;&nbsp;<button type="button" data-device="' . $obj->id . '" class="btn btn-primary btn-mini btSetPoint">Set</button>';
                return $buff;
            }
            if ($obj->switchable == -1) {
                return $space . $buttons;
            } else if ($obj->dimable == -1)
                return $dimmer . $buttons;
            else
                return "";
        } else {
            return "";
        }
    }
}
