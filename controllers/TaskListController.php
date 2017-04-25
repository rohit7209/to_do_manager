<?php

namespace app\controllers;

use Yii;
use app\models\TaskList;
use app\models\TaskListSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\db\Connection;

use yii\data\ArrayDataProvider;
/**
 * TaskListController implements the CRUD actions for TaskList model.
 */
class TaskListController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }
    
    public function actionToday(){
        $model=new TaskList();
        $dataProvider = new ArrayDataProvider([
            'allModels' => $model::find()->where('task_date=CURDATE() ORDER by task_date ASC, task_time ASC')->all(),
        ]);
        
        return $this->render('view_task_list',['dataProvider'=>$dataProvider]);
    }
    
    public function actionTommorrow(){
        $model=new TaskList();
        $dataProvider = new ArrayDataProvider([
            'allModels' => $model::find()->where('task_date=adddate(CURDATE(), 1) ORDER by task_date ASC, task_time ASC')->all(),
        ]);
        
        return $this->render('view_task_list',['dataProvider'=>$dataProvider]);
    }
    
    public function actionNext7(){
        $model=new TaskList();
        $dataProvider = new ArrayDataProvider([
            'allModels' => $model::find()->where('task_date BETWEEN CURDATE() and adddate(CURDATE(), 6) ORDER by task_date ASC, task_time ASC')->all(),
        ]);
        
        return $this->render('view_task_list',['dataProvider'=>$dataProvider]);
    }
    
    
    public function actionNext30(){
        $model=new TaskList();
        $dataProvider = new ArrayDataProvider([
            'allModels' => $model::find()->where('task_date BETWEEN CURDATE() and adddate(CURDATE(), 29) ORDER by task_date ASC, task_time ASC')->all(),
        ]);
        
        return $this->render('view_task_list',['dataProvider'=>$dataProvider]);
    }
    
    
    public function actionAll(){
            $model=new TaskList();
        $dataProvider = new ArrayDataProvider([
            'allModels' => $model::find()->where('1 order by task_date ASC, task_time ASC')->all(),
        ]);
        
        return $this->render('view_task_list',['dataProvider'=>$dataProvider]);
    }
    
    public function actionMark_done($id,$route){
        $connection=Yii::$app->getDb();
        $connection->createCommand("update taskList set status='done' where task_id=".$id)->query();
        
        $route= end((explode('r=task-list/', urldecode($route))));
        return $this->redirect([$route]);
    }
    
    public function actionSearch(){
        $model=new TaskList();
        $data = Yii::$app->request->get();
        
        $date = date("Y-m-d", strtotime($data['selected_date']));
        
        $dataProvider = new ArrayDataProvider([
            'allModels' => $model::find()->where('task_date="'.$date.'" ORDER by task_date ASC, task_time ASC')->all(),
        ]);
        
        return $this->render('view_task_list',['dataProvider'=>$dataProvider]);
    }
    
    /**
     * Creates a new TaskList model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TaskList();

        if ($model->load(Yii::$app->request->post())) {
            $model->status='notdone';
            $model->created_on=date('Y-m-d h:i:s');
            $time= date("H:i:s", strtotime(substr($model->task_time, 18,8)));
            $date = date("Y-m-d", strtotime(substr($model->task_time, 5,11)));

            $model->task_time=$time;
            $model->task_date=$date;
            $model->save();
            return $this->redirect(['view', 'id' => $model->task_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing TaskList model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model->status='notdone';
            $model->created_on=date('Y-m-d h:i:s');
            $time=substr($model->task_time, 18,8);
            $date = date("Y-m-d", strtotime(substr($model->task_time, 5,11)));
            $model->task_time=$time;
            $model->task_date=$date;
            $model->save();
            return $this->redirect(['view', 'id' => $model->task_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing TaskList model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id,$route)
    {
        $this->findModel($id)->delete();

        $route= end((explode('r=task-list/', urldecode($route))));
        return $this->redirect([$route]);
    }

    /**
     * Finds the TaskList model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TaskList the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TaskList::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
}