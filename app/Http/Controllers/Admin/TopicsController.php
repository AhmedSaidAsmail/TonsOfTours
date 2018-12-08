<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Topic;
use Illuminate\Support\Facades\Validator;

class TopicsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $topics = Topic::all();
        return view('Admin._topics.index', ['topics' => $topics, 'active' => "topics"]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin._topics.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'title' => 'required',
            'arrangement' => 'integer'
        ]);
        $data = $request->all();
        try {
            Topic::create($data);
        } catch (\Exception $e) {
            return redirect()->back()->with('failure', $e->getMessage());
        }
        return redirect()->route('topics.index')->with('success', 'Topics has been created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $topic = Topic::find($id);
        return view('Admin._topics.edit', ['topic' => $topic]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->topicsValidator($request);
        $topic = Topic::find($id);
        try {
            $topic->update($request->all());

        } catch (\Exception $e) {
            return redirect()->back()->with('failure', $e->getMessage());
        }
        return redirect()->route('topics.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $topic = Topic::find($id);
        $topic->delete();
        return redirect()->route('topics.index')->with('success', 'Topic has been deleted');
    }

    protected function topicsValidator(Request $request)
    {
        return Validator::make($request->all(), [
            'name' => 'required|alpha_dash',
            'title' => 'required',
            'arrangement' => 'integer'
        ])->validate();

    }

}
