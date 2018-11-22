<?php

namespace App\Http\Controllers\Admin;

use App\Src\SiteVisitor\Visitor;
use App\Models\Visitor as VistorModel;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VisitorsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web')->except('store');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $visitors = VistorModel::all();
        return view('Admin.visitors.index', ['visitors' => $visitors]);
    }


    public static function store(array $page)
    {
        $visitor = (new Visitor())->detect();
        if ($visitor !== false && !is_null($visitor->ip)) {
            static::insertOrUpdate($visitor, $page);
        }
    }

    private static function insertOrUpdate(\App\Src\SiteVisitor\User $user, $page)
    {
        if (self::checkExists($user->ip)) {
            $visitor = VistorModel::create(array_merge($user->return, ['last_visit' => Carbon::now()]));
        } else {
            $visitor = VistorModel::where('ip', $user->ip)->first();
            $visitor->update(['last_visit' => Carbon::now()]);
        }
        $visitor->pages()->create($page);

    }

    private static function checkExists($ip)
    {
        if (VistorModel::where('ip', $ip)->exists()) {
            return false;
        }
        return true;
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $visitor = VistorModel::find($id);
        return view('Admin.visitors.show', ['visitor' => $visitor]);

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $visitor = VistorModel::find($id);
        $visitor->delete();
        return redirect()->route('site-visitor.index')->with([
            'alert' => 'Data Successful Deleted',
            'alertType' => 'alert-warning'
        ]);
    }
}
