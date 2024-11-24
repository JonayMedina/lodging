<?php
namespace Tests\Unit\Infrastructure\Factories;

use PHPUnit\Framework\TestCase;
use App\Infrastructure\Factories\AccommodationFactory;
use App\Domain\Entities\Hotel;
use App\Domain\Entities\Apartment;

class AccommodationFactoryTest extends TestCase
{
    private AccommodationFactory $factory;

    protected function setUp(): void
    {
        $this->factory = new AccommodationFactory();
    }

    public function testCreateHotel(): void
    {
        $data = [
            'id' => 1,
            'type' => 'hotel',
            'code' => 'HTEST',
            'name' => 'Hotel Test',
            'city' => 'Ciudad Test',
            'province' => 'Provincia Test',
            'stars' => 4,
            'room_type' => 'Habitación Doble'
        ];

        $hotel = $this->factory->create($data);

        $this->assertInstanceOf(Hotel::class, $hotel);
        $this->assertEquals('Hotel Test', $hotel->getName());
    }

    public function testCreateApartment(): void
    {
        $data = [
            'id' => 1,
            'type' => 'apartment',
            'code' => 'ATEST',
            'name' => 'Apartamentos Test',
            'city' => 'Ciudad Test',
            'province' => 'Provincia Test',
            'total_units' => 10,
            'adult_capacity' => 4
        ];

        $apartment = $this->factory->create($data);

        $this->assertInstanceOf(Apartment::class, $apartment);
        $this->assertEquals('Apartamentos Test', $apartment->getName());
    }

    public function testCreateWithInvalidType(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        $data = [
            'id' => 1,
            'type' => 'invalid',
            'name' => 'Test'
        ];

        $this->factory->create($data);
    }
}