<?php

namespace Fs98\ClockodoClient\Clocks;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;

class Clocks
{
    protected $clockodoHeaders;
    protected $clockodoApiUrl;

    public function __construct()
    {
        $this->clockodoHeaders = Config::get('clockodo-client.headers');
        $this->clockodoApiUrl = Config::get('clockodo-client.api_url');
    }

    /**
     * Get currently running entries
     * 
     * @return array
     */
    public function currentlyRunning(): array
    {
        return Http::withHeaders($this->clockodoHeaders)
            ->get(
                $this->clockodoApiUrl . '/v2/clock'
            )->json();
    }

    /**
     * Start the clock
     * 
     * @param int $customersId ID of the corresponding customer.
     * @param int $servicesId ID of the corresponding service.
     * @param array $optionalParameters Additional optional parameters:
     *        - billable: (int) Is the entry billable? If omitted, the default value of the customer or the project is used.
     *           0: not billable
     *           1: billable
     *           2: already billed
     *        - projects_id (int) ID of the corresponding project.
     *        - text (null|string) Description text. Only in list function with enhanced list mode enabled.
     *        - users_id (int) ID of the corresponding co-worker.
     * 
     * @return array
     */
    public function start(int $customersId, int $servicesId, $optionalParameters): array
    {
        return Http::withHeaders($this->clockodoHeaders)
            ->post(
                $this->clockodoApiUrl . '/v2/clock',
                [
                    'customers_id' => $customersId,
                    'services_id' => $servicesId,
                    ...$optionalParameters
                ]
            )->json();
    }
}
