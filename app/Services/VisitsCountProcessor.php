<?php
declare(strict_types=1);


namespace App\Services;

use Illuminate\Log\Logger;
use Illuminate\Support\Facades\Redis;

class VisitsCountProcessor
{

    private const CACHE_KEY = 'country:visits';

    public function __construct(
        private readonly Logger $logger,
    )
    {
    }

    /**
     * @return array{string: int}
     */
    public function getAllCountriesCount(): array
    {
        $result = [];
        try {
            $result = Redis::hgetall(self::CACHE_KEY);
        } catch (\Throwable) {
            $this->logger->error('Country visits getting failed');
        }
        return $result;
    }

    public function incrementForCountry(string $countryCode): bool
    {
        $result = false;
        try {
            Redis::hincrby(self::CACHE_KEY, $countryCode, 1);
            $result = true;
        } catch (\Throwable) {
            $this->logger->error('Country increment failed', [$countryCode]);
        }
        return $result;
    }

}
