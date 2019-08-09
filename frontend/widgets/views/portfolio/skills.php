<?php

/** @var $this yii\web\View */
/** @var $skillsList array */

?>

<ul id="options" class="clearfix extra-padding-top">
    <?php foreach ($skillsList as $skill): ?>
        <?= $this->render('_skill', ['item' => $skill]) ?>
    <?php endforeach; ?>
</ul>