<?php

namespace Fs98\ClockodoClient\Interfaces;

interface ClockodoApiInterface
{
    public function getRequestHeaders(): array;

    public function getApiUrl($endpoint): string;

    public function performGetRequest($endpoint, $data = []): array;

    public function performPostRequest($endpoint, $data = []): array;

    public function performPutRequest($endpoint, $data = []): array;

    public function performDeleteRequest($endpoint): array;
}
