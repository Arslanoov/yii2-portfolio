<?php

namespace portfolio\helpers;

use portfolio\entities\Portfolio\Work\Work;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

class WorkHelper
{
    public static function statusList(): array
    {
        return [
            Work::STATUS_ACTIVE => 'Active',
            Work::STATUS_DRAFT => 'Draft'
        ];
    }

    public static function statusName($status): string
    {
        return ArrayHelper::getValue(self::statusList(), $status);
    }

    /**
     * @param $status
     * @return string
     */
    public static function statusLabel($status): string
    {
        switch ($status) {
            case Work::STATUS_DRAFT:
                $class = 'label label-default';
                break;
            case Work::STATUS_ACTIVE:
                $class = 'label label-success';
                break;
            default:
                $class = 'label label-default';
        }

        return Html::tag('span', ArrayHelper::getValue(self::statusList(), $status), [
            'class' => $class,
        ]);
    }
}