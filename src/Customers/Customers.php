<?php

namespace Fs98\ClockodoClient\Customers;

use Fs98\ClockodoClient\Services\ClockodoApiService;

class Customers
{
    protected $clockodoApiService;

    public function __construct(ClockodoApiService $clockodoApiService)
    {
        $this->clockodoApiService = $clockodoApiService;
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
        return $this->clockodoApiService->performGetRequest('v2/customers', $optionalParameters);
    }

    /**
     * Search for customers.
     *
     * @param  int  $customerId ID of the corresponding customer.
     */
    public function getOne(int $customerId): array
    {
        return $this->clockodoApiService->performGetRequest('v2/customers/' . $customerId);
    }

    /**
     * Add customers
     *
     * @param  string  $name Name of the customer.
     * @param  array  $optionalParameters Additional optional parameters:
     *        - number: (null|string) Customer number.
     *        - active (null|boolean) Is the customer active?.
     *        - billable_default (boolean) Is the customer billable by default?
     *        - note (null|string) Note for the customer. Only for owners and managers.
     */
    public function create(string $name, array $optionalParameters = []): array
    {
        $data = [
            'name' => $name,
            ...$optionalParameters,
        ];

        return $this->clockodoApiService->performPostRequest('v2/customers', $data);
    }

    /**
     * Edit customers
     *
     * @param  int  $id ID of the customer.
     * @param  array  $optionalParameters Additional optional parameters:
     *        - name Name (null|string) of the customer.
     *        - number (null|string) Customer number.
     *        - active (null|boolean) Is the customer active?.
     *        - billable_default (boolean) Is the customer billable by default?
     *        - note (null|string) Note for the customer. Only for owners and managers.
     */
    public function edit(int $id, array $optionalParameters = []): array
    {
        return $this->clockodoApiService->performPutRequest('v2/customers/' . $id, $optionalParameters);
    }

    /**
     * Delete customer
     *
     * @param  int  $id ID of the customer.
     */
    public function delete(int $id): array
    {
        return $this->clockodoApiService->performDeleteRequest('v2/customers/' . $id);
    }
}
