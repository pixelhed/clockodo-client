<?php

use Fs98\ClockodoClient\Absences\Absences;
use Fs98\ClockodoClient\Services\ClockodoApiService;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;

uses()->group('unit', 'absences');

$clockodoHeaders = [
    'X-Clockodo-External-Application' => null,
    'X-ClockodoApiUser' => null,
    'X-ClockodoApiKey' => null,
];
$clockodoApiUrl = 'https://my.clockodo.com/api/';

it('sends a GET request to get absences for a specific year with optional parameters', function () use ($clockodoHeaders, $clockodoApiUrl) {
    // Arrange
    $mockYear = 2023;
    $mockOptionalParameters = ['users_id' => 1];

    Http::fake([
        '*' => Http::response([]),
    ]);

    $clockodoApiService = new ClockodoApiService($clockodoHeaders, $clockodoApiUrl);
    $absences = new Absences($clockodoApiService);

    // Act
    $absences->get($mockYear, $mockOptionalParameters);

    // Assert
    Http::assertSentCount(1);
    Http::assertSent(function (Request $request) use ($clockodoApiUrl, $clockodoHeaders, $mockYear, $mockOptionalParameters) {
        $mockData = [
            'year' => $mockYear,
            ...$mockOptionalParameters,
        ];
        $mockRequestUrl = $clockodoApiUrl.'absences?'.http_build_query($mockData);

        return $request->url() == $mockRequestUrl &&
            $request->method() === 'GET' &&
            $request->headers($clockodoHeaders);
    });
});

it('sends a GET request to get a selected absence by id', function () use ($clockodoHeaders, $clockodoApiUrl) {
    // Arrange
    $mockAbsenceId = 1702926;

    Http::fake([
        '*' => Http::response([]),
    ]);

    $clockodoApiService = new ClockodoApiService($clockodoHeaders, $clockodoApiUrl);
    $absences = new Absences($clockodoApiService);

    // Act
    $absences->getOne($mockAbsenceId);

    // Assert
    Http::assertSentCount(1);
    Http::assertSent(function (Request $request) use ($clockodoApiUrl, $clockodoHeaders, $mockAbsenceId) {
        $mockRequestUrl = $clockodoApiUrl.'absences/'.$mockAbsenceId;

        return $request->url() == $mockRequestUrl &&
            $request->method() === 'GET' &&
            $request->headers($clockodoHeaders);
    });
});

it('sends a POST request to create a new absence', function () use ($clockodoHeaders, $clockodoApiUrl) {
    // Arrange
    $mockDateSince = '2023-05-05';
    $mockDateUntil = '2023-05-05';
    $mockType = 1;
    $mockOptionalParameters = ['note' => '...'];

    Http::fake([
        '*' => Http::response([]),
    ]);

    $clockodoApiService = new ClockodoApiService($clockodoHeaders, $clockodoApiUrl);
    $absences = new Absences($clockodoApiService);

    // Act
    $absences->create($mockDateSince, $mockDateUntil, $mockType, $mockOptionalParameters);

    // Assert
    Http::assertSentCount(1);
    Http::assertSent(function (Request $request) use ($clockodoApiUrl, $clockodoHeaders, $mockDateSince, $mockDateUntil, $mockType, $mockOptionalParameters) {
        $mockData = [
            'date_since' => $mockDateSince,
            'date_until' => $mockDateUntil,
            'type' => $mockType,
            ...$mockOptionalParameters,
        ];
        $mockRequestUrl = $clockodoApiUrl.'absences';

        return $request->url() == $mockRequestUrl &&
            $request->method() === 'POST' &&
            $request->headers($clockodoHeaders) &&
            $request->data() === $mockData;
    });
});

it('sends a PUT request to edit existing absence by id', function () use ($clockodoHeaders, $clockodoApiUrl) {
    // Arrange
    $mockAbsenceId = 1702926;
    $mockOptionalParameters = ['status' => 2];

    Http::fake([
        '*' => Http::response([]),
    ]);

    $clockodoApiService = new ClockodoApiService($clockodoHeaders, $clockodoApiUrl);
    $absences = new Absences($clockodoApiService);

    // Act
    $absences->edit($mockAbsenceId, $mockOptionalParameters);

    // Assert
    Http::assertSentCount(1);
    Http::assertSent(function (Request $request) use ($clockodoApiUrl, $clockodoHeaders, $mockAbsenceId, $mockOptionalParameters) {
        $mockRequestUrl = $clockodoApiUrl.'absences/'.$mockAbsenceId;

        return $request->url() == $mockRequestUrl &&
            $request->method() === 'PUT' &&
            $request->headers($clockodoHeaders) &&
            $request->data() === $mockOptionalParameters;
    });
});

it('sends a DELETE request to delete absence by id', function () use ($clockodoHeaders, $clockodoApiUrl) {
    // Arrange
    $mockAbsenceId = 1702926;

    Http::fake([
        '*' => Http::response([]),
    ]);

    $clockodoApiService = new ClockodoApiService($clockodoHeaders, $clockodoApiUrl);
    $absences = new Absences($clockodoApiService);

    // Act
    $absences->delete($mockAbsenceId);

    // Assert
    Http::assertSentCount(1);
    Http::assertSent(function (Request $request) use ($clockodoApiUrl, $clockodoHeaders, $mockAbsenceId) {
        $mockRequestUrl = $clockodoApiUrl.'absences/'.$mockAbsenceId;

        return $request->url() == $mockRequestUrl &&
            $request->method() === 'DELETE' &&
            $request->headers($clockodoHeaders);
    });
});
