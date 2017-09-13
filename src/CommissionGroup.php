<?php

namespace whitelabeled\AwinApi;

/**
 * Commission group object
 * @package whitelabeled\AwinApi
 */
class CommissionGroup {
    const TYPE_FIXED = 'fix';
    const TYPE_PERCENTAGE = 'percentage';

    /**
     * @var integer
     */
    public $id;

    /**
     * @var integer
     */
    public $advertiserId;

    /**
     * @var string
     */
    public $code;

    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $type;

    /**
     * @var double
     */
    public $amount;

    /**
     * @var string
     */
    public $currency;

    /**
     * @var double
     */
    public $percentage;
}