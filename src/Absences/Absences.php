<?php

namespace Fs98\ClockodoClient\Absences;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\Response;

class Absences
{
  protected $clockodoHeaders;
  protected $clockodoApiUrl;

  public function __construct()
  {
    $this->clockodoHeaders = Config::get('clockodo-client.headers');
    $this->clockodoApiUrl = Config::get('clockodo-client.api_url');
  }

  public function get(int $year, array $optionalParameters = []): Response
  {
    $clockodoResponse = Http::withHeaders($this->clockodoHeaders)
      ->get(
        $this->clockodoApiUrl . '/absences',
        [
          'year' => $year,
          ...$optionalParameters
        ]
      );
    return $clockodoResponse;
  }

  public function create($data)
  {
    // Implementation for creating an absence in Clockodo API
    // Return the created absence

    return $this;
  }

  // Add other methods for update, delete, or any other operations related to absences
}
