<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\MyModels\Admin\Sort;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Admin\UploadImageController;
use Illuminate\Support\Facades\Session;
class SortController extends Controller {
    public function show() {
        $Categories = Sort::all();
        return view('Admin.Sort', ['Categories' => $Categories, 'activeCategory' => 1]);
    }
    public function store(Request $request) {
        $this->validate($request, ['name'          => 'required',
            'main_category' => 'required',
            'title'         => 'required',
            'arrangement'   => 'integer',
            'img'           => 'image']);
        $sort = $request->all();
        if ($request->hasFile('img')) {
            $file        = Input::file('img');
            $sort['img'] = UploadImageController::Upload($file, "/images/sorts/", 250);
        }
        try {
            Sort::create($sort);
        }
        catch (\Exception $e) {
            $request->session()->flash('addStatus', $e->getMessage());
        }


        return redirect(route('category'));
    }
    public function update($id) {
        $Category = Sort::find($id);
        return view('Admin.SortUpdate', ['Sort' => $Category, 'activeCategory' => 1]);
    }
    public function edit($id, Request $request) {
        $this->validate($request, ['name'          => 'required',
            'main_category' => 'required',
            'title'         => 'required',
            'arrangement'   => 'integer',
            'img'           => 'image']);
        $Sort    = $request->all();
        $category = Sort::find($id);
        if ($request->hasFile('img')) {
            $file             = Input::file('img');
            $Sort['img'] = UploadImageController::Upload($file, "/images/sorts/", 250);
        }
        $category->update($Sort);
        return redirect(route('category'));
    }
    public function delete($id) {
        $Category = Sort::find($id);
        $Category->delete();
        Session::flash('deleteStatus', "Category No: {$id} is Deleted !!");
        return redirect(route('category'));
    }
}