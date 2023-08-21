<?php
/**
 * @var \common\models\Lesson $lesson
 * @var boolean $complete
 */
$completeHtml = "";
if($complete)
    $completeHtml = '<img src="../images/check-lg.svg">';
?>

<div class="card" style="width: 18rem;">
    <div class="card-body">
        <h5 class="card-title"><?= $lesson->title ?> <?= $completeHtml ?></h5>
        <p class="card-text"><?= $lesson->description ?></p>
        <?= \yii\helpers\Html::a('Пройти', \yii\helpers\Url::to(['course/lesson', 'lessonId' => $lesson->id]), ['class' => 'btn btn-primary']); ?>
    </div>
</div>