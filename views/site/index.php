<?php

use yii\bootstrap\ButtonDropdown;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */

$this->title = 'My To-Do Manager';

?>

<div class="col-md-12">
    
    <?= Html::tag('h1',date('D').', <small>'.date('d-M-Y').'</small>',['class'=>'pull-left'])?>

    <?= Html::tag('h1',date('h:i A'),['class'=>'pull-right'])?>
    
    
    <?php
        if(count($todays_task)==8){
            ?>
                <div class="col-md-12" style="margin: 120px 0;border-radius: 3px;box-shadow: 1px 1px 10px rgba(0,0,0,0.3)">
                    <div class="" style="color:white;width:200px;margin-top: -35px;text-align: center;float:left;font-size: 20px">
                        <div style="border-radius: 3px 3px 0 0;background:rgb(55,150,198);height:35px;line-height: 35px;">Today Next</div>
                        <div style="color:rgb(55,150,198);font-size: 45px"><?php echo date('h:i A',strtotime($todays_task['task_time']));?></div>
                    </div>
                    <h4 class="pull-right"><strong><?php echo $todays_task['task_location'];?></strong></h4>
                    <br><h3 class="" style="margin-top:50px;clear:both"><strong><?php echo $todays_task['task_name'];?></strong></h3>
                    <div class="full-stretch" style=";padding-bottom:8px;"><h4 style=";text-align: justify;line-height: 25px">
                            <?php echo $todays_task['task_description'];?>
                        </h4>
                    </div>
                </div>
            <?php
        }else{
            ?>
            <div class="col-md-12" style="text-align: center;margin:90px 0px">
                <?= Html::a('<img src="images/calender_plus_1600.png" style="width:250px;margin: auto" alt="Image">',['task-list/create'],['title'=>'Add New Task'])?>
                <?= Html::tag('div','<h4>Seems no task today.</h4><h4><strong>Enjoy your day!</strong></h4>',['class'=>'col-sm-12 text-center']);?>
            </div>
            <?php
        }
    ?>
    
    <h3 style="clear: both">Next Tasks</h3>
    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'showHeader' => false,
        'tableOptions'=>['class'=>'table displayTable'],
        'summary'=>false,
        'columns' => [
            ['contentOptions' => ['class'=>'cellFlashDate',],
                'content'=>function ($model,$key,$index,$column){
                    return date('d', strtotime($model->task_date));
                }
            ],
            ['contentOptions' => ['class'=>'cellFlashDay',],
                'content'=>function ($model,$key,$index,$column){
                    return date('D', strtotime($model->task_date));
                }
            ],
            ['contentOptions' => ['class'=>'cellFlashTime','style'=>''],
                'content'=>function($model,$key,$index,$column){
                    return date('h:i A', strtotime($model->task_time));
                }
            ],
            ['contentOptions' => ['class'=>'cellFlashName','style'=>''],
                'content'=>function ($model,$key,$index,$column){
                    return Html::a($model->task_name, ['task-list/view', 'id'=>$model->task_id],['style'=>'text-decoration:none']);
                }
            ],
            ['contentOptions' => ['class'=>'pull-right',],
                'content' =>    function ($model, $key, $index, $column) {
                                    if ($model->status == 'notdone') {
                                        return Html::a('<span class="glyphicon glyphicon-ok text-primary"></span>', ['task-list/mark_done', 'id' => $model->task_id,'route'=>'site/index'],['title'=>'No more to do?']);
                                    }else{
                                        return Html::tag('div','<span class="glyphicon glyphicon-stop text-danger"></span>',['title'=>'This task has been done.']);
                                    }
                                }
            ],
            ['contentOptions' => ['class'=>'pull-right',],
                'content' =>function ($model, $key, $index, $column) {
                                return Html::a('<span class="glyphicon glyphicon-trash"></span>', ['task-list/delete', 'id' => $model->task_id,'route'=>'site/index'], ['data' => ['confirm' => 'Are you sure you want to delete this item?','method'=>'post']]);
                            }
            ],
            ['contentOptions' => ['class'=>'cellFloatRight',],
                'content' =>    function ($model, $key, $index, $column) {
                                    if ($model->status == 'notdone') {
                                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', ['task-list/update', 'id' => $model->task_id]);
                                    }else{
                                        return Html::tag('div','<span class="glyphicon glyphicon-ban-circle"></span>');
                                    }
                                }
            ],
            ['contentOptions' => ['class'=>'pull-right',],
                'content' =>function ($model, $key, $index, $column) {
                                return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', ['task-list/view', 'id' => $model->task_id]);
                            }
            ],
            ['contentOptions' => ['class'=>'cellFloatRight',],
                'content'=>function ($model,$key,$index,$column){
                    return date('D, d-M-Y', strtotime($model->task_date));
                }
            ]
        ],
    ]); ?>
</div>


