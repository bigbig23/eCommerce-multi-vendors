<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\ShippingsRequest;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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


    public function updateShippingMethods(ShippingsRequest $request,$id){
        //validation
        //update
        try {


        $shipping_method = Setting::find($id);

        DB::beginTransaction();
        //update plain_value
        $shipping_method->update(['plain_value' => $request->plain_value]);
        //save translations with default value of value
        $shipping_method->value = $request->value;
        $shipping_method->save();
        DB::commit();
        return back()->with(['success'=>'  تم التحديث بنجاح']);


        }catch (\Exception $ex){
            return back()->with(['error'=>'  هنالك خطاء ما']);
            DB::rollBack();

        }
    }
}
