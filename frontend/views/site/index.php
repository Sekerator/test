<?php

/**
 * @var yii\web\View $this
 * @var \common\models\Task[] $models
 */

$this->title = 'Tasks';
?>

<div class="site-index">
    <?php foreach ($models as $model): ?>
    <?= $this->render('card', ['model' => $model]) ?>
    <?php endforeach; ?>
</div>
