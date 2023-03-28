<?php
declare(strict_types=1);


namespace App\Services;

use Illuminate\Contracts\Redis\Connection;
use Illuminate\Log\Logger;
use Illuminate\Support\Facades\Redis;

class VisitsCountProcessor
{

    private const CACHE_KEY = 'country:visits';

    public function __construct(
        private readonly Connection $redisConnection,
        private readonly Logger $logger,
    )
    {
    }

    /**
     * @return string[]
     */
    public function getAllCountriesCount(): array
    {
        $result = [];
        try {
            /** @var string[] $result */
            $result = $this->redisConnection->command('hgetall', [self::CACHE_KEY]);
        } catch (\Throwable) {
            $this->logger->error('Country visits getting failed');
        }
        return $result;
    }

    public function incrementForCountry(string $countryCode): bool
    {
        $result = false;
        try {
            $this->redisConnection->command('hincrby', [self::CACHE_KEY, $countryCode, 1]);
            $result = true;
        } catch (\Throwable) {
            $this->logger->error('Country increment failed', [$countryCode]);
        }
        return $result;
    }

}

