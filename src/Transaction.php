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
     * @var double
     */
    public $commissionAmount;

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
     * @var array
     */
    public $transactionParts;

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
        $transaction->clickRefs = $transData->clickRefs;
        $transaction->commissionAmount = $transData->commissionAmount->amount;
        $transaction->orderReference = $transData->orderRef;
        $transaction->saleAmount = $transData->saleAmount->amount;
        $transaction->siteName = $transData->siteName;
        $transaction->url = $transData->publisherUrl;
        $transaction->paid = $transData->paidToPublisher;
        $transaction->transactionParts = $transData->transactionParts;
        $transaction->transactionType = $transData->type;

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