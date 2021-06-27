<?php

namespace App\Http\Controllers;

use App\Models\Parcel;
use Illuminate\Http\Request;

class ParcelController extends Controller
{
    /**
     * @param $id
     *
     * @return array
     */
    public function get($id) {
        $parcel = Parcel::find($id);

        return $parcel;
    }

    /**
     * @param Request $request
     *
     * @return object
     */
    public function post(Request $request) {
        $parcel = new Parcel;
        $payload = $request->json()->all();
        $parcel->setRawAttributes($payload);
        $parcel->save();

        return $parcel;
    }

    /**
     * @param $id
     * @param Request $request
     *
     * @return object
     */
    public function put($id, Request $request) {
        /** @var Parcel $parcel */
        $parcel = Parcel::find($id);
        $payload = $request->json()->all();
        $parcel->setRawAttributes($payload);
        $parcel->setAttribute('id', $id);
        $parcel->save();
        $parcel = Parcel::find($id);

        return $parcel;
    }

    /**
     * @param $id
     *
     * @return string
     */
    public function delete($id) {
        /** @var Parcel $parcel */
        $parcel = Parcel::find($id);
        $parcel->delete();

        return $id;
    }
}
