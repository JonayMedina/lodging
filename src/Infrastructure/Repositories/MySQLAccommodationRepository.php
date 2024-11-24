<?php


namespace App\Infrastructure\Repositories;

use PDO;
use App\Domain\Interfaces\AccommodationRepositoryInterface;
use App\Infrastructure\Factories\AccommodationFactory;

/**
 * MySQL implementation of AccommodationRepositoryInterface
 */
class MySQLAccommodationRepository implements AccommodationRepositoryInterface
{
    private PDO $connection;
    private AccommodationFactory $factory;

    /**
     * Constructor
     *
     * @param PDO $connection
     * @param AccommodationFactory $factory
     */
    public function __construct(PDO $connection, AccommodationFactory $factory)
    {
        $this->connection = $connection;
        $this->factory = $factory;
    }

    /**
     * @inheritDoc
     */
    public function findByNamePrefix(string $prefix, string $languageCode): array
    {
        $query = "
            SELECT 
                a.id,
                a.code,
                a.type,
                at.name,
                c.name as city,
                c.province,
                h.stars,
                COALESCE(rtt.name, rt.code) as room_type,
                ap.total_units,
                ap.adult_capacity
            FROM accommodations a
            JOIN accommodation_translations at ON a.id = at.accommodation_id
            JOIN cities c ON a.city_id = c.id
            LEFT JOIN hotels h ON a.id = h.accommodation_id AND a.type = 'hotel'
            LEFT JOIN room_types rt ON h.room_type_id = rt.id
            LEFT JOIN room_type_translations rtt ON rt.id = rtt.room_type_id AND rtt.language_code = :language_code_room
            LEFT JOIN apartments ap ON a.id = ap.accommodation_id AND a.type = 'apartment'
            WHERE at.language_code = :language_code
            AND at.name LIKE :prefix
            ORDER BY at.name ASC";

        $stmt = $this->connection->prepare($query);
        $stmt->execute([
            'language_code' => $languageCode,
            'language_code_room' => $languageCode,
            'prefix' => "%$prefix%"
        ]);

        $accommodations = [];
        while ($row = $stmt->fetch()) {
            $accommodations[] = $this->factory->create($row);
        }
        // print_r($accommodations);
        return $accommodations;
    }
}