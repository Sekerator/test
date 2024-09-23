<?php

namespace frontend\controllers;

use common\models\Task;
use Yii;
use yii\web\Controller;

class SiteController extends Controller
{
    public function actionIndex(): string
    {
        $cache = Yii::$app->cache;
        $key = 'task-list';

        $models = $cache->getOrSet($key, function () {
            return Task::find()->orderBy(['priority' => SORT_ASC])->orderBy(['title' => SORT_ASC])->all();
        }, 60); // Кэш на 60 секунд

        return $this->render('index', [
            'models' => $models,
        ]);
    }
}
