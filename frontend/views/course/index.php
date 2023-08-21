<?php
/**
 * @var \common\models\Lesson[] $lessons
 * @var $lessonStatus
 */
?>

<?php if(\common\models\UserLesson::courseComplete(Yii::$app->user->identity->id)): ?>

<div class="alert alert-success" role="alert">
    Вы прошли курс!
</div>

<?php endif; ?>

<div class="container text-center">
    <div class="row row-cols-3">
        <?php foreach ($lessons as $lesson): ?>
            <div class="col">
                <?= $this->render('lesson_card', ['lesson' => $lesson, 'complete' => $lessonStatus[$lesson->id]]) ?>
            </div>
        <?php endforeach; ?>
    </div>
</div>

