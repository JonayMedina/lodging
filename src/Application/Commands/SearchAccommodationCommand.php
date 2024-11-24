<?php

declare(strict_types=1);

namespace App\Application\Commands;

use App\Infrastructure\Database\MySQLConnection;
use App\Infrastructure\Factories\AccommodationFactory;
use App\Infrastructure\Repositories\MySQLAccommodationRepository;

/**
 * Command for searching accommodations
 */
class SearchAccommodationCommand
{
    private MySQLAccommodationRepository $repository;

    /**
     * Constructor
     */
    public function __construct()
    {
        $config = require __DIR__ . '/../../../config/database.php';
        $connection = MySQLConnection::getInstance($config);
        $factory = new AccommodationFactory();
        $this->repository = new MySQLAccommodationRepository($connection, $factory);
    }

    /**
     * Execute the search command
     *
     * @param string $prefix Search prefix
     * @return void
     */
    public function execute(string $prefix, $lang): void
    {
        try {
            $accommodations = $this->repository->findByNamePrefix($prefix, $lang);

            if (empty($accommodations)) {
                echo "No se encontraron resultados para: $prefix\n";
                return;
            }

            foreach ($accommodations as $accommodation) {
                echo $accommodation->toString() . "\n";
            }
        } catch (\Exception $e) {
            echo "Error: " . $e->getMessage() . "\n";
        }
    }
}