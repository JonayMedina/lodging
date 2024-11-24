<?php

namespace App\Domain\Interfaces;

use App\Domain\Entities\Accommodation;

/**
 * Interface AccommodationRepositoryInterface
 * 
 * Defines the contract for accommodation data access
 * 
 * @package App\Domain\Interfaces
 */
interface AccommodationRepositoryInterface
{
    /**
     * Find accommodations by the first letters of their name
     *
     * @param string $prefix First letters to search for
     * @param string $languageCode ISO language code (e.g., 'es', 'en')
     * @return Accommodation[]
     */
    public function findByNamePrefix(string $prefix, string $languageCode): array;
}
