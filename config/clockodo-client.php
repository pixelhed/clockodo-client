<?php

// config for Fs98/Clockodo
return [

  /*
   * Mandatory headers for clockodo request authentication
   */
  'headers' => [
    'X-Clockodo-External-Application' => env('CLOCKODO_EXTERNAL_APPLICATION'),
    'X-ClockodoApiUser' => env('CLOCKODO_API_USER'),
    'X-ClockodoApiKey' => env('CLOCKODO_API_KEY')
  ],

  /*
   * List of clockodo absence <typ></typ>es
   */
  'absence_types' => [
    1 => 'Regular holiday',
    2 => 'Special leaves',
    3 => 'Reduction of overtime',
    4 => 'Sick day',
    5 => 'Sick day of a child',
    6 => 'School / further education',
    7 => 'Maternity protection',
    8 => 'Home office (planned hours are applied)',
    9 => 'Work out of office (planned hours are applied)',
    10 => 'Special leaves (unpaid)',
    11 => 'Sick day (unpaid)',
    12 => 'Sick day of a child (unpaid)',
    13 => 'Quarantine (only full days)',
    14 => 'Military / alternative service (only full days)',
    15 => 'Sick day (sickness benefit)',
  ],

  /*
   * List of clockodo absence statuses
   */
  'absence_statuses' => [
    0 => 'enquired/reported',
    1 => 'approved',
    2 => 'declined',
    3 => 'approval cancelled',
    4 => 'request cancelled'
  ]
];
