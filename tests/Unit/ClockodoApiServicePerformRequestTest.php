<?php

use Fs98\ClockodoClient\Services\ClockodoApiService;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;

uses()->group('unit', 'perform-request-function');

$clockodoHeaders = [
    'X-Clockodo-External-Application' => null,
    'X-ClockodoApiUser' => null,
    'X-ClockodoApiKey' => null,
];
$clockodoApiUrl = 'https://my.clockodo.com/api/';

test('performRequest sends HTTP GET request with correct URL, method, and headers', function () use ($clockodoHeaders, $clockodoApiUrl) {
    $mockMethod = 'GET';
    $mockEndpoint = 'absences';
    $mockData = ['year' => 2023, 'users_id' => 1];

    Http::fake([
        '*' => Http::response([
            'data' => []
        ]),
    ]);

    // Act
    $clockodoApiService = new ClockodoApiService($clockodoHeaders, $clockodoApiUrl);
    $clockodoApiService->performRequest($mockMethod, $mockEndpoint, $mockData);

    // Assert
    Http::assertSentCount(1);
    Http::assertSent(function (Request $request) use ($mockEndpoint, $mockData, $clockodoApiUrl, $mockMethod, $clockodoHeaders) {
        $mockRequestUrl = $clockodoApiUrl . $mockEndpoint . '?' . http_build_query($mockData);

        return $request->url() == $mockRequestUrl &&
            $request->method() === $mockMethod &&
            $request->headers($clockodoHeaders);
    });
});

test('performRequest sends HTTP POST request with correct URL, method, headers, and data', function () use ($clockodoHeaders, $clockodoApiUrl) {
    $mockMethod = 'POST';
    $mockEndpoint = 'absences';
    $mockData = ['year' => 2023];

    Http::fake([
        '*' => Http::response([
            'data' => []
        ]),
    ]);

    // Act
    $clockodoApiService = new ClockodoApiService($clockodoHeaders, $clockodoApiUrl);
    $clockodoApiService->performRequest($mockMethod, $mockEndpoint, $mockData);
    // Assert
    Http::assertSentCount(1);
    Http::assertSent(function (Request $request) use ($mockEndpoint, $mockData, $clockodoApiUrl, $mockMethod, $clockodoHeaders) {
        $mockRequestUrl = $clockodoApiUrl . $mockEndpoint;
        return $request->url() == $mockRequestUrl &&
            $request->method() === $mockMethod &&
            $request->headers($clockodoHeaders) &&
            $request->data() === $mockData;
    });
});

test('performRequest sends HTTP PUT request with correct URL, method, headers, and data', function () use ($clockodoHeaders, $clockodoApiUrl) {
    $mockMethod = 'PUT';
    $mockEndpoint = 'absences';
    $mockData = [
        'date_until' => '2023-05-05',
    ];

    Http::fake([
        '*' => Http::response([
            'data' => []
        ]),
    ]);

    // Act
    $clockodoApiService = new ClockodoApiService($clockodoHeaders, $clockodoApiUrl);
    $clockodoApiService->performRequest($mockMethod, $mockEndpoint, $mockData);
    // Assert
    Http::assertSentCount(1);
    Http::assertSent(function (Request $request) use ($mockEndpoint, $mockData, $clockodoApiUrl, $mockMethod, $clockodoHeaders) {
        $mockRequestUrl = $clockodoApiUrl . $mockEndpoint;
        return $request->url() == $mockRequestUrl &&
            $request->method() === $mockMethod &&
            $request->headers($clockodoHeaders) &&
            $request->data() === $mockData;
    });
});

test('performRequest sends HTTP DELETE request with correct URL, method, and headers', function () use ($clockodoHeaders, $clockodoApiUrl) {
    $mockMethod = 'DELETE';
    $mockEndpoint = 'absences/123';

    Http::fake([
        '*' => Http::response([
            'data' => []
        ]),
    ]);

    // Act
    $clockodoApiService = new ClockodoApiService($clockodoHeaders, $clockodoApiUrl);
    $clockodoApiService->performRequest($mockMethod, $mockEndpoint);
    // Assert
    Http::assertSentCount(1);
    Http::assertSent(function (Request $request) use ($mockEndpoint, $clockodoApiUrl, $mockMethod, $clockodoHeaders) {
        $mockRequestUrl = $clockodoApiUrl . $mockEndpoint;
        return $request->url() == $mockRequestUrl &&
            $request->method() === $mockMethod &&
            $request->headers($clockodoHeaders);
    });
});
