<?php

use yii\bootstrap\ButtonDropdown;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */


$this->title = 'To-Do List';

?>

    <a href='?r=task-list/today' class='link-cstm'><h3>Today <small><?= date('D, d-M-Y')?></small></h3></a>

    <p>
        <?= Html::a('Create New Task', ['task-list/create'], ['class' => 'btn btn-primary pull-right']) ?>
    </p>

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
                                        return Html::a('<span class="glyphicon glyphicon-ok text-primary"></span>', ['task-list/mark_done', 'id' => $model->task_id,'route'=>Yii::$app->getRequest()->getQueryString()],['title'=>'Mark it as completed?']);
                                    }else{
                                        return Html::tag('div','<span class="glyphicon glyphicon-stop text-danger"></span>',['title'=>'The task has been completed.']);
                                    }
                                }
            ],
            ['contentOptions' => ['class'=>'pull-right',],
                'content' =>function ($model, $key, $index, $column) {
                                return Html::a('<span class="glyphicon glyphicon-trash"></span>', ['task-list/delete', 'id' => $model->task_id,'route'=>Yii::$app->getRequest()->getQueryString()], ['data' => ['confirm' => 'Are you sure you want to delete this item?','method'=>'post']]);
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

