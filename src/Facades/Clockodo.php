<?php

namespace Fs98\Clockodo\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Fs98\Clockodo\Clockodo
 */
class Clockodo extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Fs98\Clockodo\Clockodo::class;
    }
}
