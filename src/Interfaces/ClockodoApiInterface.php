<?php

namespace Fs98\ClockodoClient\Interfaces;

interface ClockodoApiInterface
{
    public function getRequestHeaders(): array;

    public function getApiUrl(string $endpoint): string;

    public function performGetRequest(string $endpoint, array $data = []): array;

    public function performPostRequest(string $endpoint, array $data = []): array;

    public function performPutRequest(string $endpoint, array $data = []): array;

    public function performDeleteRequest(string $endpoint, array $data = []): array;
}
