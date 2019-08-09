<?php

/** @var \yii\web\View */
/** @var $relatedWorksList array */

?>

<?php foreach ($relatedWorksList as $work): ?>
    <?= $this->render('_work', [
        'item' => $work
    ]) ?>
<?php endforeach; ?>
