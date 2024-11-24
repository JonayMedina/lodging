<?php

namespace Tests\Unit\Domain\Entities;

use PHPUnit\Framework\TestCase;
use App\Domain\Entities\Hotel;

class HotelTest extends TestCase
{
    public function testToString(): void
    {
        $hotel = new Hotel(
            1,
            'HTEST',
            'Hotel Test',
            'Ciudad Test',
            'Provincia Test',
            4,
            'Habitación Doble'
        );

        $expected = 'Hotel Test, 4 estrellas, Habitación Doble, Ciudad Test, Provincia Test';
        $this->assertEquals($expected, $hotel->toString());
    }
}