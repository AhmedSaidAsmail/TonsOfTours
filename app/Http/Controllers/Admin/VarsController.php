<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\MyModels\Admin\Variable as Vars;
use Illuminate\Support\Facades\Session;

class VarsController extends Controller
{

    protected $_word;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $varss = Vars::all();
        return view('Admin.Lang', ['langs' => $varss]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, ['word' => 'required',
            'lang' => 'required']);
        $data = $request->all();
        Vars::create($data);
        return redirect()->route("vars.index");
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $target = Vars::find($id);
        $target->delete();
        Session::flash('deleteStatus', "Item No: {$id} is Deleted !!");
        return redirect()->route("vars.index");
    }

    public static function getVar($word)
    {
        $fixedWord = strtolower($word);
        $target = Vars::where('word', $fixedWord)->get()->first();
        if (isset($target->lang)) {
            return ucfirst($target->lang);
        }
        return str_replace("_", " ", $word);
        //return ucfirst($word);
    }

    /**
     * @param $word
     * @return string
     */
    public static function translate($word)
    {
        $translated = Vars::where('word', strtolower($word))->first();
        if (isset($translated->lang)) {
            return ucfirst($translated->lang);
        }
        return str_replace("_", " ", $word);

    }

    public function __toString()
    {
        return $this->getVar();
    }

}