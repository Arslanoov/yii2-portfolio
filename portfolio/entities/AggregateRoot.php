<?php

namespace portfolio\entities;

/**
 * Interface AggregateRoot
 * @package blog\entities
 */
interface AggregateRoot
{
    /** @return array */
    public function releaseEvents(): array;
}