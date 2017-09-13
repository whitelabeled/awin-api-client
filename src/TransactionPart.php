<?php

namespace whitelabeled\AwinApi;

/**
 * Transaction part object
 * @package whitelabeled\AwinApi
 */
class TransactionPart {
    /**
     * @var integer
     */
    public $commissionGroupId;

    /**
     * @var CommissionGroup|null
     */
    public $commissionGroup;

    /**
     * @var double
     */
    public $amount;

    /**
     * @var double
     */
    public $commissionAmount;
}