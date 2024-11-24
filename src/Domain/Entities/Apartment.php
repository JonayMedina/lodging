<?php
namespace App\Domain\Entities;

/**
 * Apartment accommodation type
 * 
 * @package App\Domain\Entities
 */
class Apartment extends Accommodation
{
    /**
     * @var int
     */
    private int $totalUnits;

    /**
     * @var int
     */
    private int $adultCapacity;

    /**
     * Constructor
     *
     * @param int $id Apartment ID
     * @param string $code Unique code
     * @param string $name Apartment name
     * @param string $city City name
     * @param string $province Province name
     * @param int $totalUnits Total number of units
     * @param int $adultCapacity Capacity for adults
     */
    public function __construct(
        int $id,
        string $code,
        string $name,
        string $city,
        string $province,
        int $totalUnits,
        int $adultCapacity
    ) {
        parent::__construct($id, $code, $name, $city, $province);
        $this->totalUnits = $totalUnits;
        $this->adultCapacity = $adultCapacity;
    }

    /**
     * Get total number of units
     *
     * @return int
     */
    public function getTotalUnits(): int
    {
        return $this->totalUnits;
    }

    /**
     * Get adult capacity
     *
     * @return int
     */
    public function getAdultCapacity(): int
    {
        return $this->adultCapacity;
    }

    /**
     * Convert apartment to string representation
     *
     * @return string
     */
    // public function toString(): string
    // {
    //     return sprintf(
    //         '%s, %d apartamentos, %d adultos, %s, %s',
    //         $this->name,
    //         $this->totalUnits,
    //         $this->adultCapacity,
    //         $this->city,
    //         $this->province
    //     );
    // }

    public function toString(): string
    {
        return sprintf(
            $this->getTranslation('apartment_format'),
            $this->name,
            $this->totalUnits,
            $this->adultCapacity,
            $this->city,
            $this->province
        );
    }
}