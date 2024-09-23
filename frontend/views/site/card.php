<?php
/**
 * @var \common\models\Task $model
 */
?>

<div class="card" style="width: 18rem;">
    <div class="card-body">
        <h5 class="card-title"> <?= $model->title ?> </h5>
        <p class="card-text"> <?= $model->description ?? "Пусто" ?> </p>
        <p class="card-text"> <?= date('d M Y H:i:s', $model->due_date) ?> </p>
    </div>
</div>