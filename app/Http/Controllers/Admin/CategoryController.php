<?php

namespace App\Http\Controllers\admin;

use DB;
use Image;
use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller
{
    public function index(){

        $data['get_all'] = Category::get();
        return view('admin.category.view', $data);
    }

    public function create(){
        $data['add'] = TRUE;
        return view('admin.category.add', $data);
    }

    public function store(CategoryRequest $request){

        $Category = new Category;
        $Category->category_name = $request->category_name;
        $Category->slug = strtolower(slug($request->category_name));
        if(!empty($request->file('thumbnail'))){
            $Image = $request->file('thumbnail');
            $name = $Image->getClientOriginalName();
            $ext = explode('.',$name);
            $finalName = 'category-'.time().'.'.$ext[1];
            $uploadPath = 'public/uploads/';
            $imageUrl = $uploadPath.$finalName;
            Image::make(file_get_contents($Image))->resize(300, 200)->save($imageUrl);
            $Category->thumbnail = ($imageUrl) ? $imageUrl : '';
        }
        if($Category->save()){
            setMessage("message","success",saved_success());
        }else{
           setMessage("message","danger",exception()); 
        }
        return back();
    }

    public function edit($id){
        $data['edit'] = TRUE;
        $data['single'] = Category::findOrFail($id);
        return view('admin.category.add', $data);
    }

    public function update(Request $request, $id){

        $Category = Category::findOrFail($id);
        $Category->category_name = $request->category_name;
        $Category->slug = strtolower(slug($request->category_name));
        if($request->thumbnail != ''){
            if(!empty($Category->thumbnail)){
                unlink($Category->thumbnail);
            }
            $Image = $request->file('thumbnail');
            $name = $Image->getClientOriginalName();
            $ext = explode('.',$name);
            $finalName = 'category-'.time().'.'.$ext[1];
            $uploadPath = 'public/uploads/';
            $imageUrl = $uploadPath.$finalName;
            Image::make(file_get_contents($Image))->resize(300, 200)->save($imageUrl);
            $Category->thumbnail = $uploadPath.$finalName;
        }
        if($Category->save()){
            setMessage("message","success",updated_success());
        }else{
           setMessage("message","danger",exception()); 
        }
        return redirect(route('category.index'));
    }

    public function destroy($id){

        $Category = Category::findOrFail($id);
        if(!empty($Category->thumbnail)){
            unlink($Category->thumbnail);
        }
        if($Category->delete()){
            setMessage("message","success",deleted_success());
        }else{
            setMessage("message","danger",exception());
        }
        return back();
        
    }

    public function deleteAll(Request $request){
        $ids = $request->ids;
        $idArr = explode(",",$ids);
        for($i = 0;$i<count($idArr);$i++){
            $img = DB::table('categories')->find($idArr[$i]);
            $preImg = $img->thumbnail;
            if($preImg){
                unlink($preImg);
            }
            $result = DB::table('categories')->where('id', '=', $idArr[$i])->delete();
        }
        return response()->json(['success'=>"Selected Items Deleted successfully."]);
    }

    
}
