<?php

namespace Fs98\ClockodoClient\Absences;

use Illuminate\Support\Facades\Http;

class Absences
{
    protected $clockodoHeaders;

    protected $clockodoApiUrl;

    /**
     * Get absences for a specific year with optional parameters.
     *
     * @param  int  $year The year for which to retrieve absences.
     * @param  array  $optionalParameters Additional optional parameters:
     *        - users_id: (null|int) ID of the corresponding co-worker
     */
    public function get(int $year, array $optionalParameters = []): array
    {
        return Http::withHeaders($this->clockodoHeaders)
            ->get(
                $this->clockodoApiUrl.'/absences',
                [
                    'year' => $year,
                    ...$optionalParameters,
                ]
            )->json();
    }

    /**
     * Get a selected absence.
     *
     * @param  int  $id ID of the absence.
     */
    public function getOne(int $id): array
    {
        return Http::withHeaders($this->clockodoHeaders)
            ->get($this->clockodoApiUrl.'/absences/'.$id)
            ->json();
    }

    /**
     * Add a new absence / absence request
     *
     * @param  string  $dateSince Start date in YYYY-MM-DD format.
     * @param  string  $dateUntil End date in YYYY-MM-DD format.
     * @param  int  $type Type of the absence:
     *        1: Regular holiday
     *        2: Special leaves
     *        3: Reduction of overtime
     *        4: Sick day
     *        5: Sick day of a child
     *        6: School / further education
     *        7: Maternity protection
     *        8: Home office (planned hours are applied)
     *        9: Work out of office (planned hours are applied)
     *        10: Special leaves (unpaid)
     *        11: Sick day (unpaid)
     *        12: Sick day of a child (unpaid)
     *        13: Quarantine (only full days)
     *        14: Military / alternative service (only full days)
     *        15: Sick day (sickness benefit)
     *        Only with access rights for absence administration or in case of own absences
     * @param  array  $optionalParameters Additional optional parameters:
     *        - users_id: (null|int) ID of the corresponding co-worker, if not submitted, the absence will be added for the current API user.
     *        - note (null|string) Note.
     *        - count_days (float) Amount of absence days (null for overtime reduction), 0.5 for a half day. Gets calculated automatically for longer absences.
     *        - count_hours (null|float) Amount of hours of overtime reduction (null in other cases). Will be calculated if empty.
     *        - status (integer) Only 0 or 1.
     *        - sick_note (null|boolean) Is there a doctor's sick note? For the types 4 and 5.
     */
    public function create(string $dateSince, string $dateUntil, int $type, array $optionalParameters = []): array
    {
        return Http::withHeaders($this->clockodoHeaders)
            ->post(
                $this->clockodoApiUrl.'/absences',
                [
                    'date_since' => $dateSince,
                    'date_until' => $dateUntil,
                    'type' => $type,
                    ...$optionalParameters,
                ]
            )->json();
    }
}
