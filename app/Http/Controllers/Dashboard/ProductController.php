<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Enumerations\CategoryType;
use App\Http\Requests\GeneralProductRequest;
use App\Http\Requests\MainCategoryRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index()
    {
        $categories = Category::with('_parent')->orderBy('id','desc')->paginate(PAGINATION_COUNT);

        return view('dashboard.categories.index',compact('categories'));
    }


    public function create()
    {
        $data = [];
        $data['brands'] = Brand::active()->select('id')->get();
        $data['tags'] = Tag::select('id')->get();
        $data['categories'] = Category::active()->select('id')->get();
        //return $data;

        return view('dashboard.products.general.create', $data);
    }





    public function store(GeneralProductRequest $request)
    {
        return $request;


    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {

        $category = Category::orderBy('id','desc')->find($id);
        if(!$category){
            return redirect()->back()->with(['error'=>'هذا القسم غير موجود']);
        }
        return view('dashboard.categories.edit',compact('category'));

    }


    public function update(MainCategoryRequest $request, $id)
    {
        //return $request;
        try {
            if(!$request->has('is_active')){
                $request->request->add(['is_active'=> 0]);
            }else{
                $request->request->add(['is_active'=> 1]);
            }

            $category = Category::find($id);

            if(!$category){
                return redirect()->back()->with(['error'=>'هذا القسم غير موجود']);
            }

            $category->update($request->all());
            //save translation
            $category->name = $request->name;
            $category->save();
            return redirect()->back()->with(['success'=>'تم التحديث بنجاح']);

        }catch (\Exception $ex){
            return redirect()->back()->with(['error'=>'هنالك خطاء ما']);
        }


    }

    public function destroy($id)
    {
        $category = Category::orderBy('id','desc')->find($id);
        if(!$category){
            return redirect()->back()->with(['error'=>'هذا القسم غير موجود']);
        }
        $category->delete();
        return redirect()->back()->with(['success'=>'تم الحزف بنجاح']);

    }
}
