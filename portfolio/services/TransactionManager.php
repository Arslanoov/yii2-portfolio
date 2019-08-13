<?php

namespace portfolio\services;

use portfolio\dispatchers\DeferredEventDispatcher;
use Yii;
use Exception;

/**
 * Class TransactionManager
 * @package blog\services
 */
class TransactionManager
{
    /** @var DeferredEventDispatcher */
    private $dispatcher;

    /**
     * TransactionManager constructor.
     * @param DeferredEventDispatcher $dispatcher
     */
    public function __construct(DeferredEventDispatcher $dispatcher)
    {
        $this->dispatcher = $dispatcher;
    }

    /**
     * @param callable $function
     * @throws Exception
     */
    public function wrap(callable $function): void
    {
        $transaction = Yii::$app->db->beginTransaction();
        try {
            $function();
            $transaction->commit();
        } catch (Exception $e) {
            $transaction->rollBack();
            throw $e;
        }
    }
}