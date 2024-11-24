<?php

declare(strict_types=1);

namespace App\Infrastructure\Factories;

use App\Domain\Entities\Accommodation;
use App\Domain\Entities\Hotel;
use App\Domain\Entities\Apartment;

/**
 * Factory class for creating Accommodation objects
 */
class AccommodationFactory
{
    /**
     * Create an Accommodation instance from database data
     *
     * @param array $data Raw data from database
     * @return Accommodation
     * @throws \InvalidArgumentException
     */
    public function create(array $data): Accommodation
    {
        if (!isset($data['type'])) {
            throw new \InvalidArgumentException('Accommodation type is required');
        }

        return match ($data['type']) {
            'hotel' => new Hotel(
                (int) $data['id'],
                $data['code'],
                $data['name'],
                $data['city'],
                $data['province'],
                (int) $data['stars'],
                $data['room_type']
            ),
            'apartment' => new Apartment(
                (int) $data['id'],
                $data['code'],
                $data['name'],
                $data['city'],
                $data['province'],
                (int) $data['total_units'],
                (int) $data['adult_capacity']
            ),
            default => throw new \InvalidArgumentException('Invalid accommodation type')
        };
    }
}
