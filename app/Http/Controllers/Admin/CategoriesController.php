<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Src\Images\Image;

class CategoriesController extends Controller
{

    /**
     * @var string imageFolder Direction of saved images
     */
    const path = "/images/categories/";

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return view('Admin._categories.categoriesIndex', ['categories' => $categories, 'active' => 'category']);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $this->validator($data);
        $request->request->add(['path' => self::path]);
        /** @var  Image $imgResolver */
        $imgResolver = resolve(Image::class);
        $imgResolver->upload($data);
        try {
            Category::create($data);
        } catch (\Exception $e) {
            $imgResolver->remove($data['img']);
            return redirect()->back()->with([
                'alert' => 'Data Unsuccessful Stored',
                'alertType' => 'alert-danger',
                'alertDetails' => $e->getMessage()
            ]);
        }
        return redirect()->route('category.index')->with([
            'alert' => 'Data Successful stored',
            'alertType' => 'alert-success'
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('Admin._categories.categoryEdit', ['category' => $category, 'active' => 'category']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $this->validator($data);
        $category = Category::find($id);
        $request->request->add(['path' => self::path, 'current' => $category->img]);
        /** @var  Image $imgResolver */
        $imgResolver = resolve(Image::class);
        $imgResolver->upload($data);
        try {
            $category->update($data);
        } catch (\Exception $e) {
            $imgResolver->remove($data['img']);
            return redirect()->back()->with([
                'alert' => 'Data Unsuccessful Stored',
                'alertType' => 'alert-danger',
                'alertDetails' => $e->getMessage()
            ]);
        }

        return redirect()->route('category.index')->with([
            'alert' => 'Data Successful updated',
            'alertType' => 'alert-success'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $category = Category::find($id);
        $request->request->add(['path' => self::path]);
        $currentImage = $category->img;
        /** @var  Image $imgResolver */
        $imgResolver = resolve(Image::class);
        $category->delete();
        $imgResolver->remove($currentImage);
        return redirect()->route('category.index')->with([
            'alert' => 'Data Successful Deleted',
            'alertType' => 'alert-warning'
        ]);
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required',
            'main_category_id' => 'required|integer',
            'title' => 'required',
            'arrangement' => 'integer|required',
            'img' => 'image'
        ])->validate();
    }

}