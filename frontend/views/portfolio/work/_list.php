<?php

/** @var $this yii\web\View */
/** @var $dataProvider yii\data\ActiveDataProvider */

use yii\widgets\ListView;
use yii\widgets\LinkPager;
use yii\widgets\Pjax;

?>

<?php Pjax::begin() ?>

    <div class="container clearfix">
        <?= ListView::widget([
            'dataProvider' => $dataProvider,
            'layout' => "{items} \n",
            'itemView' => '_work',
        ]) ?>
    </div>

    <div class="container clearfix no-header">
        <div class="col-lg-12 white-text centered">
            <?= LinkPager::widget([
                'pagination' => $dataProvider->getPagination(),
                'options' => [
                    'class' => 'pagination clearfix',
                ],
                'activePageCssClass' => 'active-page',
                'disabledPageCssClass' => 'none'
            ]) ?>
        </div>
    </div>

<?php Pjax::end() ?>