<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\MyModels\Admin\Leftsideicon;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use App\Src\Facades\UploadFacades;

class LeftSideController extends Controller {

    protected $_path = "/images/icons/";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $icons = Leftsideicon::all();
        return view('Admin.leftSideIndex', ['icons' => $icons]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $this->validate($request, ['name' => 'required',
            'link' => 'required',
            'img'  => 'image']);
        $icon = $request->all();
        if ($request->hasFile('img')) {
            $file        = Input::file('img');
            $icon['img'] = UploadFacades::Upload($file, $this->_path, 250);
        }
        try {
            Leftsideicon::create($icon);
        } catch (\Exception $e) {
            UploadFacades::removeImg();
            $request->session()->flash('errorDetails', $e->getMessage());
            $request->session()->flash('errorMsg', "Oops something went wrong !!");
        }


        return redirect()->route("leftsSide.index");
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $item = Leftsideicon::findOrFail($id);
        return view('Admin.leftSideedit', ['item' => $item]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $target = Leftsideicon::find($id);
        $exImg  = $target->img;
        $this->validate($request, ['name' => 'required',
            'link' => 'required',
            'img'  => 'image']);
        $data   = $request->all();


        if ($request->hasFile('img')) {
            $file        = Input::file('img');
            $data['img'] = UploadFacades::Upload($file, $this->_path, 250);
        }
        try {
            $target->update($data);
            (isset($exImg) && $request->hasFile('img')) ? UploadFacades::removeExImg($exImg, $this->_path) : '';
        } catch (\Exception $e) {
            UploadFacades::removeImg();
            $request->session()->flash('errorDetails', $e->getMessage());
            $request->session()->flash('errorMsg', "Oops something went wrong !!");
        }
        return redirect()->route("leftsSide.index");
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $target = Leftsideicon::find($id);
        $exImg  = $target->img;
        (isset($exImg) ) ? UploadFacades::removeExImg($exImg, $this->_path) : '';
        $target->delete();
        Session::flash('deleteStatus', "Item No: {$id} is Deleted !!");
        return redirect()->route("leftsSide.index");
    }

}