<?php

namespace Fs98\ClockodoClient\Services;

use Fs98\ClockodoClient\Interfaces\ClockodoApiInterface;
use Illuminate\Support\Facades\Http;

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

  public function performGetRequest($endpoint, $data = []): array
  {
    return Http::withHeaders($this->getRequestHeaders())
      ->get($this->getApiUrl($endpoint), $data)
      ->json();
  }

  public function performPostRequest($endpoint, $data = []): array
  {
    return Http::withHeaders($this->getRequestHeaders())
      ->post($this->getApiUrl($endpoint), $data)
      ->json();
  }

  public function performPutRequest($endpoint, $data = []): array
  {
    return Http::withHeaders($this->getRequestHeaders())
      ->put($this->getApiUrl($endpoint), $data)
      ->json();
  }

  public function performDeleteRequest($endpoint): array
  {
    return Http::withHeaders($this->getRequestHeaders())
      ->delete($this->getApiUrl($endpoint))
      ->json();
  }
}
