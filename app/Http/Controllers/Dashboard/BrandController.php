<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\BrandRequest;
use App\Models\Brand;
use Illuminate\Http\Request;
use DB;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::orderBy('id','desc')->paginate(PAGINATION_COUNT);

        return view('dashboard.brands.index',compact('brands'));
    }

    public function create()
    {
        return view('dashboard.brands.create');
    }

    public function store(BrandRequest $request)
    {
        //return $request;


        //validation

        if (!$request->has('is_active'))
            $request->request->add(['is_active' => 0]);
        else
            $request->request->add(['is_active' => 1]);


        $fileName = "";
        if ($request->has('photo')) {

            $fileName = savePhoto('brands', $request->photo);

        }

        $brand = Brand::create($request->except('_token','photo'));

        //save translations
        $brand->name = $request->name;
        $brand -> photo = $fileName;

        $brand->save();

        return redirect()->route('admin.brands')->with(['success' => 'تم ألاضافة بنجاح']);

     }


    public function edit($id)
    {
        //get specific categories and its translations
        $brand = Brand::find($id);

        if (!$brand)
            return redirect()->route('admin.brands')->with(['error' => 'هذا الماركة غير موجود ']);

        return view('dashboard.brands.edit', compact('brand'));

    }



}
