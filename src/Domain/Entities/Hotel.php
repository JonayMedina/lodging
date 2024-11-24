<?php
namespace App\Domain\Entities;

/**
 * Hotel accommodation type
 * 
 * @package App\Domain\Entities
 */
class Hotel extends Accommodation
{
    /**
     * @var int
     */
    private int $stars;

    /**
     * @var string
     */
    private string $roomType;

    /**
     * Constructor
     *
     * @param int $id Hotel ID
     * @param string $code Unique code
     * @param string $name Hotel name
     * @param string $city City name
     * @param string $province Province name
     * @param int $stars Number of stars
     * @param string $roomType Standard room type
     */
    public function __construct(
        int $id,
        string $code,
        string $name,
        string $city,
        string $province,
        int $stars,
        string $roomType
    ) {
        parent::__construct($id, $code, $name, $city, $province);
        $this->stars = $stars;
        $this->roomType = $roomType;
    }

    /**
     * Get number of stars
     *
     * @return int
     */
    public function getStars(): int
    {
        return $this->stars;
    }

    /**
     * Get standard room type
     *
     * @return string
     */
    public function getRoomType(): string
    {
        return $this->roomType;
    }

    /**
     * Convert hotel to string representation
     *
     * @return string
     */
    // public function toString(): string
    // {
    //     return sprintf(
    //         '%s, %d stars, %s, %s, %s',
    //         $this->name,
    //         $this->stars,
    //         $this->roomType,
    //         $this->city,
    //         $this->province
    //     );
    // }
    public function toString(): string
    {
        return sprintf(
            $this->getTranslation('hotel_format'),
            $this->name,
            $this->stars,
            $this->roomType,
            $this->city,
            $this->province
        );
    }
}