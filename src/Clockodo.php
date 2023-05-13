<?php

namespace Fs98\ClockodoClient;

use Fs98\ClockodoClient\Absences\Absences;

class Clockodo
{
    public $absences;

    public function __construct()
    {
        $this->absences = new Absences();
    }
}
