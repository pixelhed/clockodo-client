<?php

namespace Fs98\ClockodoClient\Absences;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;

class Absences
{
    protected $clockodoHeaders;

    protected $clockodoApiUrl;

    public function __construct()
    {
        $this->clockodoHeaders = Config::get('clockodo-client.headers');
        $this->clockodoApiUrl = Config::get('clockodo-client.api_url');
    }

    /**
     * Get absences for a specific year with optional parameters.
     *
     * @param  int  $year The year for which to retrieve absences.
     * @param  array  $optionalParameters Additional optional parameters:
     *        - users_id: (null|int) ID of the corresponding co-worker
     */
    public function get(int $year, array $optionalParameters = []): Response
    {
        $clockodoResponse = Http::withHeaders($this->clockodoHeaders)
            ->get(
                $this->clockodoApiUrl.'/absences',
                [
                    'year' => $year,
                    ...$optionalParameters,
                ]
            );

        return $clockodoResponse;
    }

    /**
     * Get absences for a specific year with optional parameters.
     *
     * @param  int  $id ID of the absence.
     */
    public function getOne(int $id): Response
    {
        $clockodoResponse = Http::withHeaders($this->clockodoHeaders)
            ->get($this->clockodoApiUrl.'/absences/'.$id);

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
