<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Parcel extends Model {
    const QUOTE_BY_VALUE = 'by_value';
    const QUOTE_BY_VOLUME = 'by_volume';
    const QUOTE_BY_WEIGHT = 'by_weight';

    protected $table = 'parcels';

    protected $fillable = [
    ];

    public static function boot()
    {
        parent::boot();

        self::creating(function (self $model) {
            $model->calulateParcelPrice();
        });

        self::updating(function (self $model) {
            $model->calulateParcelPrice();
        });

        self::retrieved(function (self $model) {
            // Update price if environment variables changed
            $quote = $model->getAttribute('quote');
            $model->calulateParcelPrice();

            if ($quote != $model->getAttribute('quote')) {
                $model->save();
            }
        });
    }

    protected function calulateParcelPrice() {
        $kgPrice = env('PRICE_PER_KG');
        $volumePrice = env('PRICE_PER_CUBIC_METRE');
        $valuePrice = env('PRICE_PERCENT_OF_VALUE');
        $quote = 0;
        $chosenModel = '';
        $kgQuote = $kgPrice * $this->getAttribute('weight');

        if ($kgQuote > $quote) {
            $quote = $kgQuote;
            $chosenModel = self::QUOTE_BY_WEIGHT;
        }

        $volumeQuote = $volumePrice * $this->getAttribute('volume');

        if ($volumeQuote > $quote) {
            $quote = $volumeQuote;
            $chosenModel = self::QUOTE_BY_VOLUME;
        }

        $valueQuote = $valuePrice * $this->getAttribute('declared_value');

        if ($volumeQuote > $quote) {
            $quote = $valueQuote;
            $chosenModel = self::QUOTE_BY_VALUE;
        }

        $this->setAttribute('chosen_model', $chosenModel);
        $this->setAttribute('quote', $quote);
    }
}
