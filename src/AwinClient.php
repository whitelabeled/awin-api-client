<?php

namespace whitelabeled\AwinApi;

use DateTime;
use Httpful\Request;

class AwinClient {
    private $authToken;
    private $publisherId;


    protected $endpoint = 'https://api.awin.com';
    protected $itemsPerPage = 200;

    /**
     * DaisyconClient constructor.
     * @param $authToken      string Awin auth token
     * @param $publisherId    string Awin Publisher ID
     */
    public function __construct($authToken, $publisherId) {
        $this->authToken = $authToken;
        $this->publisherId = $publisherId;
    }

    /**
     * Get all transactions from $startDate until $endDate.
     *
     * @param DateTime $startDate Start date
     * @param DateTime $endDate   End date
     * @param string   $timezone  Awin timezone format, see http://wiki.awin.com/index.php/API_get_transactions_list
     * @return array Transaction objects. Each part of a transaction is returned as a separate Transaction.
     */
    public function getTransactions(DateTime $startDate, DateTime $endDate, $timezone = 'Europe/Paris') {
        $params = [
            'startDate' => $startDate->format('Y-m-d\TH:i:s'),
            'endDate'   => $endDate->format('Y-m-d\TH:i:s'),
            'timezone'  => $timezone
        ];

        $query = '?' . http_build_query($params);
        $response = $this->makeRequest("/publishers/{$this->publisherId}/transactions/", $query);

        $transactions = [];
        $transactionsData = $response->body;

        if ($transactionsData != null) {
            foreach ($transactionsData as $transactionData) {
                $transaction = Transaction::createFromJson($transactionData);
                $transactions[] = $transaction;
            }
        }

        return $transactions;
    }

    protected function makeRequest($resource, $query = "") {
        $uri = $this->endpoint . $resource;

        $request = Request::get($uri . $query)
            ->addHeader('Authorization', 'Bearer ' . $this->authToken)
            ->expectsJson();

        $response = $request->send();

        // Check for errors
        if ($response->hasErrors()) {
            if (isset($response->body->description)) {
                throw new \Exception('API Error: '.$response->body->description);
            } else {
                throw new \Exception('Invalid data');
            }
        }

        return $response;
    }
}
