<?php

namespace Fs98\ClockodoClient;

use Fs98\ClockodoClient\Absences\Absences;
use Fs98\ClockodoClient\Clocks\Clocks;

class Clockodo
{
    public $absences;
    public $clocks;

    public function __construct()
    {
        $this->absences = new Absences();
        $this->clocks = new Clocks();
    }
}
