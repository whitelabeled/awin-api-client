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

    /**
     * Construct a CommissionGroup from JSON
     * @param $commissionGroupData array Commission group JSON data
     * @param $advertiserId        integer Advertiser ID
     * @return CommissionGroup
     */
    public static function createFromJson($commissionGroupData, $advertiserId) {
        $commissionGroup = new self();

        $commissionGroup->id = $commissionGroupData['groupId'];
        $commissionGroup->advertiserId = $advertiserId;
        $commissionGroup->code = $commissionGroupData['groupCode'];
        $commissionGroup->name = $commissionGroupData['groupName'];
        $commissionGroup->type = $commissionGroupData['type'];

        if ($commissionGroup->type == self::TYPE_FIXED) {
            $commissionGroup->currency = $commissionGroupData['currency'];
            $commissionGroup->amount = $commissionGroupData['amount'];
        } else {
            $commissionGroup->percentage = $commissionGroupData['percentage'];
        }

        return $commissionGroup;
    }
}