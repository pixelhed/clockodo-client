<?php

namespace Fs98\ClockodoClient;

use Fs98\ClockodoClient\Absences\Absences;
use Fs98\ClockodoClient\Clocks\Clocks;
use Fs98\ClockodoClient\Customers\Customers;

class Clockodo
{
    public $absences;

    public $clocks;

    public $customers;

    public function __construct()
    {
        $this->absences = new Absences();
        $this->clocks = new Clocks();
        $this->customers = new Customers();
    }
}
