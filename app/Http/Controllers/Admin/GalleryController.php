<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\Src\Facades\UploadFacades;
use App\MyModels\Admin\Itemsgallrie;
use App\MyModels\Admin\topics_image;

class GalleryController extends Controller {

    protected $_path = '/images/gallery/';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($topicId) {
        $images = topics_image::where('topic_id', $topicId)->get();
        return view('Admin.GalleryList', ['topicId' => $topicId, 'images' => $images]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($topicId) {
        return view('Admin.GalleryUpload', ['topicId' => $topicId]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $topicId) {
        $data             = [];
        $data['topic_id'] = $topicId;
        $this->validate($request, [
            'file' => 'image'
        ]);
        if ($request->hasFile('file')) {
            $file        = Input::file('file');
            $data['img'] = UploadFacades::Upload($file, $this->_path, 250);
        }
        topics_image::create($data);
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
        //
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $itemID) {
        $this->validate($request, [
            'id' => 'required|min:1']);
        $images = $request->id;
        foreach ($images as $imageID) {
            try {
                $image = topics_image::findOrFail($imageID);
                $exImg = $image->img;
                $image->delete();
                (isset($exImg)) ? UploadFacades::removeExImg($exImg, $this->_path) : '';
            } catch (\Exception $e) {
                $request->session()->flash('errorDetails', $e->getMessage());
                $request->session()->flash('errorMsg', "Oops something went wrong !!");
            }
        }
        //return redirect()->route('Items.edit', ['item' => $itemID]);
        return redirect()->route('Topics.edit', ['id' => $itemID]);
    }

}