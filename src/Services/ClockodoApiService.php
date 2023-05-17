<?php

namespace Fs98\ClockodoClient\Services;

use Fs98\ClockodoClient\Interfaces\ClockodoApiInterface;

class ClockodoApiService implements ClockodoApiInterface
{
  protected $clockodoHeaders;
  protected $clockodoApiUrl;

  public function __construct(
    array $clockodoHeaders,
    string $clockodoApiUrl
  ) {
    $this->clockodoHeaders = $clockodoHeaders;
    $this->clockodoApiUrl = $clockodoApiUrl;
  }

  public function getRequestHeaders(): array
  {
    return $this->clockodoHeaders;
  }

  public function getApiUrl($endpoint): string
  {
    return $this->clockodoApiUrl . $endpoint;
  }
}
