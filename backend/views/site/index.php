<?php

/**
 * @var yii\web\View $this
 * @var DataProvider $dataProvider
 */

use yii\grid\GridView;

$this->title = 'Task';
?>
<div class="site-index">
    <p> <a href="" class="btn btn-primary">Создать задачу</a> </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
    ])?>
</div>
