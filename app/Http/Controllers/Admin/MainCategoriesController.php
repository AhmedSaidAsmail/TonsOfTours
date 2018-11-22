<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\MainCategory;
use App\Src\Images\Image;

class MainCategoriesController extends Controller
{
    /**
     * @var string imageFolder Direction of saved images
     */
    const path = "/images/mainCategories/";

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mainCategories = MainCategory::all();
        return view('Admin._mainCategories.mainCategoriesIndex', ['mainCategories' => $mainCategories, 'active' => 'mainCategory']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
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
            MainCategory::create($data);
        } catch (\Exception $e) {
            $imgResolver->rollback();
            return redirect()->back()->with([
                'alert' => 'Data Unsuccessful Stored',
                'alertType' => 'alert-danger',
                'alertDetails' => $e->getMessage()
            ]);
        }
        return redirect()->route('mainCategory.index')->with([
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
        $mainCategory = MainCategory::findOrFail($id);
        return view('Admin._mainCategories.mainCategoriesEdit', ['mainCategory' => $mainCategory, 'active' => 'mainCategory']);
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
        $mainCategory = MainCategory::find($id);
        $request->request->add(['path' => self::path, 'current' => $mainCategory->img]);
        /** @var  Image $imgResolver */
        $imgResolver = resolve(Image::class);
        $imgResolver->upload($data);
        try {
            $mainCategory->update($data);
        } catch (\Exception $e) {
            $imgResolver->rollback();
            return redirect()->back()->with([
                'alert' => 'Data Unsuccessful Stored',
                'alertType' => 'alert-danger',
                'alertDetails' => $e->getMessage()
            ]);
        }

        return redirect()->route('mainCategory.index')->with([
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
    public function destroy(Request $request,$id)
    {
        $mainCategory = MainCategory::find($id);
        $request->request->add(['path' => self::path]);
        $currentImage = $mainCategory->img;
        /** @var  Image $imgResolver */
        $imgResolver = resolve(Image::class);
        $mainCategory->delete();
        $imgResolver->remove($currentImage);
        return redirect()->route('mainCategory.index')->with([
            'alert' => 'Data Successful Deleted',
            'alertType' => 'alert-warning'
        ]);
    }

    /**
     * @param array $data
     * @return mixed
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required',
            'title' => 'required',
            'arrangement' => 'integer',
            'img' => 'image'
        ])->validate();
    }

}