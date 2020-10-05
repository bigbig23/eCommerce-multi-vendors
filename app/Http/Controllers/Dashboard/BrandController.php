<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\BrandRequest;
use App\Models\Brand;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Str;

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

    public function update($id, BrandRequest $request)
    {
        //return $request;
    /*    try {*/
            //validation

            //update DB


            $brand = Brand::find($id);

            if (!$brand)
                return redirect()->route('admin.brands')->with(['error' => 'هذا الماركة غير موجود']);


     /*       DB::beginTransaction();*/
            if ($request->has('photo')) {

                //return $image = Str::after($request->photo, 'public/');
                //unlink($image);

                $fileName = savePhoto('brands', $request->photo);
                Brand::where('id', $id)
                    ->update([
                        'photo' => $fileName,
                    ]);
            }

            if (!$request->has('is_active'))
                $request->request->add(['is_active' => 0]);
            else
                $request->request->add(['is_active' => 1]);

            $brand->update($request->except('_token', 'id', 'photo'));

            //save translations
            $brand->name = $request->name;
            $brand->save();
/*
            DB::commit();*/
            return redirect()->route('admin.brands')->with(['success' => 'تم ألتحديث بنجاح']);

    /*    } catch (\Exception $ex) {

            DB::rollback();
            return redirect()->route('admin.brands')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }*/

    }


    public function destroy($id)
    {
       /* try {*/
            //get specific categories and its translations
            $brand = Brand::find($id);

            if (!$brand)
                return redirect()->route('admin.brands')->with(['error' => 'هذا الماركة غير موجود ']);

            $photo = $brand->photo;
            $image = Str::after($photo, 'public/');
            unlink($image);

            $brand->delete();

            return redirect()->route('admin.brands')->with(['success' => 'تم  الحذف بنجاح']);

     /*   } catch (\Exception $ex) {
            return redirect()->route('admin.brands')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }*/
    }




}
