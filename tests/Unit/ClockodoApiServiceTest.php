<?php

use Fs98\ClockodoClient\Services\ClockodoApiService;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;

uses()->group('unit');

$clockodoHeaders = [
    'X-Clockodo-External-Application' => null,
    'X-ClockodoApiUser' => null,
    'X-ClockodoApiKey' => null,
];
$clockodoApiUrl = 'https://my.clockodo.com/api/';

it('returns the request headers', function () use ($clockodoHeaders, $clockodoApiUrl) {

    // Act
    $clockodoApiService = new ClockodoApiService($clockodoHeaders, $clockodoApiUrl);
    $headers = $clockodoApiService->getRequestHeaders();

    // Assert
    expect($headers)->toBe($clockodoHeaders);
});

it('returns the API URL for a given endpoint', function () use ($clockodoHeaders, $clockodoApiUrl) {
    $endpoint = 'users';

    // Act
    $clockodoApiService = new ClockodoApiService($clockodoHeaders, $clockodoApiUrl);
    $apiUrl = $clockodoApiService->getApiUrl($endpoint);

    // Assert
    expect($apiUrl)->toBe('https://my.clockodo.com/api/users');
});

test('performRequest sends HTTP request and returns JSON response', function () use ($clockodoHeaders, $clockodoApiUrl) {
    $mockResponse = ['absences' => []];
    $mockMethod = 'GET';
    $mockEndpoint = 'absences';
    $mockData = ['year' => 2023, 'users_id' => 1];

    Http::fake([
        '*' => Http::response($mockResponse),
    ]);

    // Act
    $clockodoApiService = new ClockodoApiService($clockodoHeaders, $clockodoApiUrl);
    $result = $clockodoApiService->performRequest($mockMethod, $mockEndpoint, $mockData);

    // Assert
    Http::assertSentCount(1);
    Http::assertSent(function (Request $request) use ($mockEndpoint, $mockData, $clockodoApiService, $mockMethod, $clockodoHeaders) {
        $mockRequestUrl = $clockodoApiService->getApiUrl($mockEndpoint).'?'.http_build_query($mockData);

        return $request->url() == $mockRequestUrl &&
            $request->method() === $mockMethod &&
            $request->headers($clockodoHeaders);
    });

    expect($result)->toEqual($mockResponse);
});

test('performGetRequest sends GET request and returns JSON response', function () use ($clockodoHeaders, $clockodoApiUrl) {
    // Arrange
    $mockResponse = ['data' => []];
    $mockEndpoint = 'absences';
    $mockData = ['year' => 2023];

    Http::fake([
        '*' => Http::response($mockResponse),
    ]);

    // Act
    $clockodoApiService = new ClockodoApiService($clockodoHeaders, $clockodoApiUrl);
    $result = $clockodoApiService->performGetRequest($mockEndpoint, $mockData);

    // Assert
    Http::assertSentCount(1);
    Http::assertSent(function (Request $request) use ($mockEndpoint, $mockData, $clockodoApiUrl, $clockodoHeaders) {
        $mockRequestUrl = $clockodoApiUrl.$mockEndpoint.'?'.http_build_query($mockData);

        return $request->url() == $mockRequestUrl &&
            $request->method() === 'GET' &&
            $request->headers($clockodoHeaders);
    });

    expect($result)->toEqual($mockResponse);
});

test('performPostRequest sends POST request and returns JSON response', function () use ($clockodoHeaders, $clockodoApiUrl) {
    // Arrange
    $mockResponse = ['data' => []];
    $mockEndpoint = 'absences';
    $mockData = [
        'date_since' => '2023-05-05',
        'date_until' => '2023-05-05',
        'type' => 1,
    ];

    Http::fake([
        '*' => Http::response($mockResponse),
    ]);

    // Act
    $clockodoApiService = new ClockodoApiService($clockodoHeaders, $clockodoApiUrl);
    $result = $clockodoApiService->performPostRequest($mockEndpoint, $mockData);

    // Assert
    Http::assertSentCount(1);
    Http::assertSent(function (Request $request) use ($mockEndpoint, $clockodoApiUrl, $clockodoHeaders) {
        $mockRequestUrl = $clockodoApiUrl.$mockEndpoint;

        return $request->url() == $mockRequestUrl &&
            $request->method() === 'POST' &&
            $request->headers($clockodoHeaders);
    });

    expect($result)->toEqual($mockResponse);
});

test('performPutRequest sends PUT request and returns JSON response', function () use ($clockodoHeaders, $clockodoApiUrl) {
    // Arrange
    $mockResponse = ['data' => []];
    $mockEndpoint = 'absences/123';
    $mockData = [
        'date_until' => '2023-05-05',
    ];

    Http::fake([
        '*' => Http::response($mockResponse),
    ]);

    // Act
    $clockodoApiService = new ClockodoApiService($clockodoHeaders, $clockodoApiUrl);
    $result = $clockodoApiService->performPutRequest($mockEndpoint, $mockData);

    // Assert
    Http::assertSentCount(1);
    Http::assertSent(function (Request $request) use ($mockEndpoint, $clockodoApiUrl, $clockodoHeaders) {
        $mockRequestUrl = $clockodoApiUrl.$mockEndpoint;

        return $request->url() == $mockRequestUrl &&
            $request->method() === 'PUT' &&
            $request->headers($clockodoHeaders);
    });

    expect($result)->toEqual($mockResponse);
});

test('performDeleteRequest sends DELETE request and returns JSON response', function () use ($clockodoHeaders, $clockodoApiUrl) {
    // Arrange
    $mockResponse = ['data' => []];
    $mockEndpoint = 'absences/123';

    Http::fake([
        '*' => Http::response($mockResponse),
    ]);

    // Act
    $clockodoApiService = new ClockodoApiService($clockodoHeaders, $clockodoApiUrl);
    $result = $clockodoApiService->performDeleteRequest($mockEndpoint);

    // Assert
    Http::assertSentCount(1);
    Http::assertSent(function (Request $request) use ($mockEndpoint, $clockodoApiUrl, $clockodoHeaders) {
        $mockRequestUrl = $clockodoApiUrl.$mockEndpoint;

        return $request->url() == $mockRequestUrl &&
            $request->method() === 'DELETE' &&
            $request->headers($clockodoHeaders);
    });

    expect($result)->toEqual($mockResponse);
});
