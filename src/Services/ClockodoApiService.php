<?php

namespace Fs98\ClockodoClient\Services;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;

class ClockodoApiService
{
  protected $clockodoHeaders;
  protected $clockodoApiUrl;

  public function __construct()
  {
    $this->clockodoHeaders = Config::get('clockodo-client.headers');
    $this->clockodoApiUrl = Config::get('clockodo-client.api_url');
  }

  protected function getRequestHeaders()
  {
    return $this->clockodoHeaders;
  }

  protected function getApiUrl($endpoint)
  {
    return $this->clockodoApiUrl . $endpoint;
  }
}
