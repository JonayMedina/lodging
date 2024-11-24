<?php

namespace Tests\Unit\Domain\Entities;

use PHPUnit\Framework\TestCase;
use App\Domain\Entities\Apartment;

class ApartmentTest extends TestCase
{
    public function testToString(): void
    {
        $apartment = new Apartment(
            1,
            'ATEST',
            'Apartamentos Test',
            'Ciudad Test',
            'Provincia Test',
            10,
            4
        );

        $expected = 'Apartamentos Test, 10 apartamentos, 4 adultos, Ciudad Test, Provincia Test';
        $this->assertEquals($expected, $apartment->toString());
    }
}