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
}
