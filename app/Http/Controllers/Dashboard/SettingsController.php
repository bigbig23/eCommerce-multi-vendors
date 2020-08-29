<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    //

    public function editShippingMethods($type)
    {
        //3 type of shippings: free/ inner / outer for shippings methods
        //with this package of transaltion, no need for making relations its auto
        //return Setting::all();

        if ($type === 'free') {
            $shippings = Setting::where('key', 'free_shipping_label')->first();
        }elseif ($type === 'inner') {
            $shippings = Setting::where('key', 'local_label')->first();
        }elseif ($type === 'outer') {
            $shippings = Setting::where('key', 'outer_label')->first();
        }else{
            $shippings = Setting::where('key', 'free_shipping_label')->first();
        }

        return view('dashboard.settings.shippings.edit',compact('shippings'));

    }


    public function updateShippingMethods($id){

    }
}
