<?php

use Fs98\ClockodoClient\Services\ClockodoApiService;
use Fs98\ClockodoClient\Customers\Customers;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\Request;

uses()->group('unit', 'customers');

$clockodoHeaders = [
    'X-Clockodo-External-Application' => null,
    'X-ClockodoApiUser' => null,
    'X-ClockodoApiKey' => null,
];
$clockodoApiUrl = 'https://my.clockodo.com/api/';

it('sends a GET request to get customers', function () use ($clockodoHeaders, $clockodoApiUrl) {
    // Arrange
    $mockOptionalParameters = [
        'filter[active]' => true,
        'page' => 2
    ];

    Http::fake([
        '*' => Http::response([]),
    ]);

    $clockodoApiService = new ClockodoApiService($clockodoHeaders, $clockodoApiUrl);
    $customers = new Customers($clockodoApiService);

    // Act
    $customers->get($mockOptionalParameters);

    // Assert
    Http::assertSentCount(1);
    Http::assertSent(function (Request $request) use ($clockodoApiUrl, $clockodoHeaders, $mockOptionalParameters) {
        $mockRequestUrl = $clockodoApiUrl . 'v2/customers?' . http_build_query($mockOptionalParameters);

        return $request->url() == $mockRequestUrl &&
            $request->method() === 'GET' &&
            $request->headers($clockodoHeaders);
    });
});

it('sends a GET request to get a selected customer by id', function () use ($clockodoHeaders, $clockodoApiUrl) {
    // Arrange
    $mockCustomerId = 1702926;

    Http::fake([
        '*' => Http::response([]),
    ]);

    $clockodoApiService = new ClockodoApiService($clockodoHeaders, $clockodoApiUrl);
    $customers = new Customers($clockodoApiService);

    // Act
    $customers->getOne($mockCustomerId);

    // Assert
    Http::assertSentCount(1);
    Http::assertSent(function (Request $request) use ($clockodoApiUrl, $clockodoHeaders, $mockCustomerId) {
        $mockRequestUrl = $clockodoApiUrl . 'v2/customers/' . $mockCustomerId;

        return $request->url() == $mockRequestUrl &&
            $request->method() === 'GET' &&
            $request->headers($clockodoHeaders);
    });
});

it('sends a POST request to create a new customer', function () use ($clockodoHeaders, $clockodoApiUrl) {
    // Arrange
    $mockName = 'John Doe';
    $mockOptionalParameters = ['active' => true];

    Http::fake([
        '*' => Http::response([]),
    ]);

    $clockodoApiService = new ClockodoApiService($clockodoHeaders, $clockodoApiUrl);
    $customers = new Customers($clockodoApiService);

    // Act
    $customers->create($mockName, $mockOptionalParameters);

    // Assert
    Http::assertSentCount(1);
    Http::assertSent(function (Request $request) use ($clockodoApiUrl, $clockodoHeaders, $mockName, $mockOptionalParameters) {
        $mockData = [
            'name' => $mockName,
            ...$mockOptionalParameters,
        ];
        $mockRequestUrl = $clockodoApiUrl . 'v2/customers';

        return $request->url() == $mockRequestUrl &&
            $request->method() === 'POST' &&
            $request->headers($clockodoHeaders) &&
            $request->data() === $mockData;
    });
});

it('sends a PUT request to edit existing customer by id', function () use ($clockodoHeaders, $clockodoApiUrl) {
    // Arrange
    $mockCustomerId = 1702926;
    $mockOptionalParameters = ['active' => false];

    Http::fake([
        '*' => Http::response([]),
    ]);

    $clockodoApiService = new ClockodoApiService($clockodoHeaders, $clockodoApiUrl);
    $customers = new Customers($clockodoApiService);

    // Act
    $customers->edit($mockCustomerId, $mockOptionalParameters);

    // Assert
    Http::assertSentCount(1);
    Http::assertSent(function (Request $request) use ($clockodoApiUrl, $clockodoHeaders, $mockCustomerId, $mockOptionalParameters) {
        $mockRequestUrl = $clockodoApiUrl . 'v2/customers/' . $mockCustomerId;

        return $request->url() == $mockRequestUrl &&
            $request->method() === 'PUT' &&
            $request->headers($clockodoHeaders) &&
            $request->data() === $mockOptionalParameters;
    });
});

it('sends a DELETE request to delete customer by id', function () use ($clockodoHeaders, $clockodoApiUrl) {
    // Arrange
    $mockCustomerId = 1702926;

    Http::fake([
        '*' => Http::response([]),
    ]);

    $clockodoApiService = new ClockodoApiService($clockodoHeaders, $clockodoApiUrl);
    $customers = new Customers($clockodoApiService);

    // Act
    $customers->delete($mockCustomerId);

    // Assert
    Http::assertSentCount(1);
    Http::assertSent(function (Request $request) use ($clockodoApiUrl, $clockodoHeaders, $mockCustomerId) {
        $mockRequestUrl = $clockodoApiUrl . 'v2/customers/' . $mockCustomerId;

        return $request->url() == $mockRequestUrl &&
            $request->method() === 'DELETE' &&
            $request->headers($clockodoHeaders);
    });
});
