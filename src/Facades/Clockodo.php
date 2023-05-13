<?php

namespace Fs98\ClockodoClient\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Fs98\ClockodoClient\Clockodo
 */
class Clockodo extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Fs98\ClockodoClient\Clockodo::class;
    }
}
