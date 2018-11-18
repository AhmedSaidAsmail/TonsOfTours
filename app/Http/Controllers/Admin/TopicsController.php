<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\MyModels\Admin\Topic;
use App\MyModels\Admin\Topics_text;

class TopicsController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $data = Topic::all();
        return view('Admin.Topics', ['data' => $data, 'activeTopics' => 1]);
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
            'title' => 'required',
            'arrangement' => 'integer']);
        $insert = $request->all();
        try {
            $id = Topic::create($insert)->id;
            Topics_text::create(['topic_id' => $id]);
        } catch (\Exception $e) {
            $request->session()->flash('errorDetails', $e->getMessage());
            $request->session()->flash('errorMsg', "Oops something went wrong !!");
        }
        return redirect()->route('Topics.index');
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
        $topic = Topic::find($id);
        if (!is_null($topic)) {
            return view('Admin.TopicEdit', ['topic' => $topic]);
        }
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
        $this->validate($request, ['name' => 'required',
            'title' => 'required',
            'arrangement' => 'integer']);
        $update = $request->all();
        $topic = Topic::find($id);
        try {
            $topic->update($update);
            $request->session()->flash('addStatus', "The Topic $topic->name has been updated");
            return redirect()->route('Topics.index');
        } catch (\Exception $e) {
            
        }
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id) {
        $topic = Topic::find($id);
        $request->session()->flash('addStatus', "The Topic $topic->name has been deleted");
        $topic->delete();
        return redirect()->route('Topics.index');
    }

}
