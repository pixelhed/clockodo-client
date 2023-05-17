<?php

namespace Fs98\ClockodoClient\Interfaces;

interface ClockodoApiInterface
{
  public function getRequestHeaders(): array;
  public function getApiUrl($endpoint): string;
  public function performGetRequest($endpoint, $parameters = []): array;
}
