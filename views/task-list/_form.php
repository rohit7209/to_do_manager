<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

//use dosamigos\datepicker\DatePicker;
//use kartik\date\DatePicker;
use kartik\datetime\DateTimePicker;
/* @var $this yii\web\View */
/* @var $model app\models\TaskList */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="task-list-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'task_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'task_time')->widget(DateTimePicker::classname(), [
                'type' => DateTimePicker::TYPE_COMPONENT_PREPEND,
                'options' => ['placeholder' => 'Enter task time ...','style'=>'max-width:300px'],
                'readonly'=>true,
                'removeButton' => false,
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'D, dd-M-yyyy, HH:ii P',
                    'showMeridian' => true,
                    'todayHighlight' => true,
                    'minuteStep' => 5,
                    'todayBtn' => true
                ]
        ]);
    ?>
    
    <?= $form->field($model, 'task_location')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'task_description')->textarea(['rows' => 6]) ?>
    
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
