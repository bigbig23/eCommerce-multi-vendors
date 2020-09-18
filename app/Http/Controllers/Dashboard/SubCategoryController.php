<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\MainCategoryRequest;
use App\Http\Requests\SubCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubCategoryController extends Controller
{

    public function index()
    {
        $categories = Category::child()->orderBy('id','desc')->get();

        return view('dashboard.subcategories.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::parent()->orderBy('id','desc')->get();
        return view('dashboard.subcategories.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SubCategoryRequest $request){

        try {

            DB::beginTransaction();
            if(!$request->has('is_active')){
                $request->request->add(['is_active'=>0]);
            }else{
                $request->request->add(['is_active'=>1]);
            }

            $category = Category::create($request->except('_token'));
            //Saving translation
            $category->name = $request->name;
            $category->save();

            DB::commit();
            return redirect()->route('admin.subcategories')->with(['success'=>'تم الحفظ بنجاح']);

        }catch (\Exception $ex){
            return redirect()->route('admin.subcategories')->with(['error'=> 'هنالك خطاء']);
            DB::rollBack();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
        $categories = Category::parent()->orderBy('id','desc')->get();

        return view('dashboard.subcategories.edit',compact('categories','category'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SubCategoryRequest $request, $id)
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
            return redirect()->route('admin.subcategories')->with(['success'=>'تم التحديث بنجاح']);

        }catch (\Exception $ex){
            return redirect()->back()->with(['error'=>'هنالك خطاء ما']);
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
