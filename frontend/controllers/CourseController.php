<?php

namespace frontend\controllers;

use common\models\Lesson;
use common\models\UserLesson;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\web\Controller;

/**
 * Course controller
 */
class CourseController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }
    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        if(Yii::$app->request->isAjax)
        {
            if(!$this->lessonComplete($_POST['lessonId']))
                Yii::$app->user->setFlash('error', "Ошибка сохранения");
        }

        $lessons = Yii::$app->user->identity->lessons;
        $lessonStatus = Yii::$app->user->identity->getLessonMap();

        return $this->render('index', ['lessons' => $lessons, 'lessonStatus' => $lessonStatus]);
    }

    public function actionLesson($lessonId)
    {
        if(Yii::$app->request->isAjax)
        {
            if(Yii::$app->request->isAjax)
            {
                if(!$this->lessonComplete($lessonId))
                    Yii::$app->user->setFlash('error', "Ошибка сохранения");

                $nextLesson = UserLesson::find()->where(['user_id' => Yii::$app->user->identity->id, 'status' => 0])
                    ->andWhere(['<>', 'lesson_id', $lessonId])->one();

                if(!$nextLesson) {
                    $lessons = Yii::$app->user->identity->lessons;
                    $lessonStatus = Yii::$app->user->identity->getLessonMap();
                    return $this->render('index', ['lessons' => $lessons, 'lessonStatus' => $lessonStatus]);
                }

                $lessonId = $nextLesson->lesson_id;
            }
        }

        $lesson = Lesson::findOne(['id' => $lessonId]);
        $nextLesson = UserLesson::find()->where(['user_id' => Yii::$app->user->identity->id, 'status' => 0])
            ->andWhere(['<>', 'lesson_id', $lessonId])->one();

        return $this->render('lesson', ['lesson' => $lesson, 'nextLesson' => $nextLesson]);
    }

    public function lessonComplete($lessonId)
    {
        $userLessonModel = UserLesson::find()->where(['user_id' => Yii::$app->user->identity->id, 'lesson_id' => $lessonId])->one();
        $userLessonModel->status = 1;
        if(!$userLessonModel->save())
            return false;

        return true;
    }
}
