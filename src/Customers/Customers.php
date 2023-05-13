<?php

namespace Fs98\ClockodoClient\Customers;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;

class Customers
{
    protected $clockodoHeaders;

    protected $clockodoApiUrl;

    public function __construct()
    {
        $this->clockodoHeaders = Config::get('clockodo-client.headers');
        $this->clockodoApiUrl = Config::get('clockodo-client.api_url');
    }

    /**
     * List customers.
     *
     * @param  array  $optionalParameters Additional optional parameters:
     *        - filter[active]: (boolean|null) Is the customer active?
     *        - page (integer|null) Because the result can have many customers, the use of page-by-page output is enabled for this request.
     */
    public function get(array $optionalParameters = []): array
    {
        return Http::withHeaders($this->clockodoHeaders)
            ->get(
                $this->clockodoApiUrl.'/v2/customers',
                $optionalParameters
            )->json();
    }

    /**
     * Search for customers.
     *
     * @param  int  $customersId ID of the corresponding customer.
     */
    public function getOne(int $customerId): array
    {
        return Http::withHeaders($this->clockodoHeaders)
            ->get(
                $this->clockodoApiUrl.'/v2/customers/'.$customerId,
            )->json();
    }
}
