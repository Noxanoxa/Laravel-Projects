<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function store(Request $request) {

        $validator = Validator::make($request->all(), [
            'slug' => 'required|max:191',
            'meta_title' => 'required',
            'name' => 'required|max:191',
        ]);

        if($validator->fails())
        return response()->json([
            'status' => 400,
            'errors' => $validator->getMessageBag(),
        ]);

        else
        {
        $category = new Category;
        $category->meta_keyword = $request->input('meta_keyword');
        $category->meta_description = $request->input('meta_description');
        $category->slug = $request->input('slug');
        $category->name = $request->input('name');
        $category->description = $request->input('description');
        $category->meta_title = $request->input('meta_title');
        $category->status = $request->input('status') == true ? '1' : '0';
        $category->save();
        return response()->json([
            'status' => 200,
            'message' => 'The Category Has Been Added Successfully (:',
        ]);
    }
    }

    public function index () {
        $category =  Category::all();
        return response()->json([
            'status' => 200,
            'category' => $category,
        ]);
    }

    public function edit ($id) {
        $category = Category::find($id);

        if($category)
        return response()->json([
            'status' => 200,
            'category' => $category,
        ]);
        else
        return response()->json([
            'status' => 404,
            'message' => 'No Category Id Found',
        ]);
    }

    public function update(Request $request, $id) {
        $validator = Validator::make($request->all(), [
            'slug' => 'required|max:191',
            'meta_title' => 'required',
            'name' => 'required|max:191',
        ]);

        if($validator->fails())
        return response()->json([
            'status' => 422,
            'errors' => $validator->getMessageBag(),
        ]);

        else
        {
        $category =  Category::find($id);
        if($category){
            $category->meta_keyword = $request->input('meta_keyword');
            $category->meta_description = $request->input('meta_description');
            $category->slug = $request->input('slug');
            $category->name = $request->input('name');
            $category->description = $request->input('description');
            $category->meta_title = $request->input('meta_title');
            $category->status = $request->input('status') == true ? '1' : '0';
            $category->save();
            return response()->json([
                'status' => 200,
                'message' => 'The Category Has Been Updated Successfully (:',
            ]);
        }
        else
        return response()->json([
            'status' => 404,
            'message' => 'No Id For Such Category',
        ]);
    }

    }

    public function destroy($id) {
        $category = Category::find($id);

        if($category)
        {
            $category->delete();
            return response()->json([
                'status' => 200,
                'message' => 'The Category Deleted Successfully (:',
            ]);
        }
        else
        {
            return response()->json([
                'status' => 404,
                'message' => 'No Id For Such Category',
            ]);
        }
    }

    public function allCategory() {
        $category = Category::where('status', '0')->get();
        return response()->json([
            'status' => 200,
            'category' => $category,
        ]);
    }
}
