<?php
/**
 * @var \common\models\Lesson $lesson
 * @var \common\models\UserLesson $nextLesson
 */

$this->params['breadcrumbs'][] = ['label' => 'Уроки', 'url' => ['index']];
$this->params['breadcrumbs'][] = $lesson->title;
?>
<h1><?= $lesson->title ?></h1>
<hr>
<span><?= $lesson->description ?></span>
<hr>
<iframe width="512" height="390"
        src="<?= $lesson->url ?>">
</iframe>
<hr>
<?php
echo \yii\helpers\Html::a(
    "Урок просмотрен",
    "#",
    ['class' => 'btn btn-primary', 'onclick' => 'completeLesson('.$lesson->id.')']
);



