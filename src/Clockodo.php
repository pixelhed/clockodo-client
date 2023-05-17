<?php

namespace Fs98\ClockodoClient;

use Fs98\ClockodoClient\Absences\Absences;
use Fs98\ClockodoClient\Clocks\Clocks;
use Fs98\ClockodoClient\Customers\Customers;
use Fs98\ClockodoClient\Services\ClockodoApiService;
use Illuminate\Support\Facades\Config;

class Clockodo
{
    public $absences;

    public $clocks;

    public $customers;

    public function __construct()
    {
        $this->clocks = new Clocks();

        $this->absences = new Absences(
            new ClockodoApiService(
                Config::get('clockodo-client.headers'),
                Config::get('clockodo-client.api_url')
            ),
        );
        $this->customers = new Customers(
            new ClockodoApiService(
                Config::get('clockodo-client.headers'),
                Config::get('clockodo-client.api_url')
            ),
        );
    }
}
