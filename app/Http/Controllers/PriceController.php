<?php

namespace App\Http\Controllers;

use App\Models\Parcel;
use Illuminate\Http\Request;

class PriceController extends Controller
{
    /**
     * @param Request $request
     *
     * @return array
     */
    public function getPrices(Request $request) {
        $ids = $request->get('parcelIds');
        $ids = explode(',', $ids);
        $parcels = Parcel::find($ids);
        $bulkPrice = 0;

        foreach ($parcels as $parcel) {
            /** @var Parcel $parcel */
            $bulkPrice += $parcel->getAttribute('quote');
        }

        return $bulkPrice;
    }
}
