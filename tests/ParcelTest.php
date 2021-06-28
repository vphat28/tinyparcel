<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class ParcelTest extends TestCase
{
    public function testWeightQuoteParcel()
    {
        $parcel = new \App\Models\Parcel;
        $parcel->setRawAttributes([
            "item_name"      => "New smartphone",
            "weight"         => 5.1,
            "volume"         => 0.0003,
            "declared_value" => 4,
        ]);
        $parcel->save();

        $this->assertEquals(25.5, $parcel->getAttribute('quote'));
        $this->assertEquals('by_weight', $parcel->getAttribute('chosen_model'));
    }

    public function testVolumeQuoteParcel()
    {
        $parcel = new \App\Models\Parcel;
        $parcel->setRawAttributes([
            "item_name"      => "New smartphone",
            "weight"         => 1,
            "volume"         => 1,
            "declared_value" => 400,
        ]);
        $parcel->save();

        $this->assertEquals(1000, $parcel->getAttribute('quote'));
        $this->assertEquals('by_volume', $parcel->getAttribute('chosen_model'));
    }

    public function testValueQuoteParcel()
    {
        $parcel = new \App\Models\Parcel;
        $parcel->setRawAttributes([
            "item_name"      => "New smartphone",
            "weight"         => 1,
            "volume"         => 1,
            "declared_value" => 40000,
        ]);
        $parcel->save();

        $this->assertEquals(1200, $parcel->getAttribute('quote'));
        $this->assertEquals('by_value', $parcel->getAttribute('chosen_model'));
    }
}
