<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "taskList".
 *
 * @property integer $task_id
 * @property string $task_name
 * @property string $task_description
 * @property string $task_time
 * @property string $task_location
 * @property string $created_on
 * @property string $status
 */
class TaskList extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'taskList';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['task_name', 'task_description', 'task_date', 'task_time', 'task_location', 'created_on', 'status'], 'required'],
            [['task_description', 'status'], 'string'],
            ['created_on', 'safe'],
            [['task_name', 'task_location'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'task_id' => 'Task ID',
            'task_name' => 'Task Name',
            'task_description' => 'Task Description',
            'task_time' => 'Task Time',
            'task_date' => 'Task Date',
            'task_location' => 'Task Location',
            'created_on' => 'Created On',
            'status' => 'Status',
        ];
    }
}
