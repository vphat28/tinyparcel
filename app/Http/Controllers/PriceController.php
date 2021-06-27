<?php

namespace App\Http\Controllers;

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

        return $ids;
    }
}
