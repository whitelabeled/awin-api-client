<?php

namespace whitelabeled\AwinApi;

use DateTime;

class Transaction {
    /**
     * @var string
     */
    public $id;


    /**
     * @var DateTime
     */
    public $transactionDate;

    /**
     * @var DateTime
     */
    public $clickDate;

    /**
     * @var DateTime
     */
    public $validationDate;

    /**
     * @var string
     */
    public $advertiserId;

    /**
     * @var string
     */
    public $clickDevice;

    /**
     * @var string
     */
    public $transactionDevice;

    /**
     * @var string
     */
    public $commissionStatus;

    /**
     * @var string
     */
    public $declineReason;

    /**
     * @var string []
     */
    public $clickRefs;

    /**
     * @var double Effective commission for this sale
     */
    public $commissionAmount;

    /**
     * @var double Total commission for this sale
     */
    public $totalCommissionAmount;

    /**
     * @var boolean Whether the commission for this sale is shared with a service provider
     */
    public $sharedCommission;

    /**
     * @var double Percentage of the total sale commission
     */
    public $commissionPercentage;

    /**
     * @var string
     */
    public $orderReference;

    /**
     * @var double
     */
    public $saleAmount;

    /**
     * @var string
     */
    public $siteName;

    /**
     * @var string
     */
    public $url;

    /**
     * @var boolean
     */
    public $paid;

    /**
     * @var TransactionPart[]
     */
    public $transactionParts = [];

    /**
     * @var string
     */
    public $transactionType;

    /**
     * Create a Transaction object from two JSON objects
     * @param $transData \stdClass Transaction data
     * @return Transaction
     */
    public static function createFromJson($transData) {
        $transaction = new Transaction();

        $transaction->id = $transData->id;
        $transaction->transactionDate = self::parseDate($transData->transactionDate);
        $transaction->clickDate = self::parseDate($transData->clickDate);
        $transaction->validationDate = self::parseDate($transData->validationDate);
        $transaction->advertiserId = $transData->advertiserId;
        $transaction->clickDevice = $transData->clickDevice;
        $transaction->transactionDevice = $transData->transactionDevice;
        $transaction->commissionStatus = $transData->commissionStatus;
        $transaction->declineReason = $transData->declineReason;
        $transaction->clickRefs = (array)$transData->clickRefs;
        $transaction->commissionAmount = $transData->commissionAmount->amount;
        $transaction->orderReference = $transData->orderRef;
        $transaction->saleAmount = $transData->saleAmount->amount;
        $transaction->siteName = $transData->siteName;
        $transaction->url = $transData->publisherUrl;
        $transaction->paid = $transData->paidToPublisher;
        $transaction->transactionType = $transData->type;

        $transaction->totalCommissionAmount = 0;

        // Process transaction parts:
        foreach ($transData->transactionParts as $transactionPartData) {
            $transactionPart = new TransactionPart();

            $transactionPart->commissionGroupId = $transactionPartData->commissionGroupId;
            $transactionPart->amount = $transactionPartData->amount;
            $transactionPart->commissionAmount = $transactionPartData->commissionAmount;

            // Add transaction part
            $transaction->transactionParts[] = $transactionPart;

            // Keep track of total commission (over all transaction parts)
            $transaction->totalCommissionAmount += $transactionPart->commissionAmount;
        }

        // Determine whether the commission for this sale is shared with other publisher:
        if ($transaction->totalCommissionAmount > 0 && $transaction->totalCommissionAmount != $transaction->commissionAmount) {
            $transaction->sharedCommission = true;
            $transaction->commissionPercentage = $transaction->commissionAmount / $transaction->totalCommissionAmount * 100;
        } else {
            $transaction->sharedCommission = false;
            $transaction->commissionPercentage = 100;
        }

        return $transaction;
    }

    /**
     * Parse a date
     * @param $date string Date/time string
     * @return DateTime|null
     */
    private static function parseDate($date) {
        if ($date == null) {
            return null;
        } else {
            return new \DateTime($date);
        }
    }
}