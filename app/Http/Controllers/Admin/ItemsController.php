<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Item;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Src\Images\Image;

class ItemsController extends Controller
{

    /**
     * @var string imageFolder Direction of saved images
     */
    const path = "/images/items/";

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Item::all();
        return view('Admin._items.itemsIndex', ['items' => $items, 'active' => 'item']);
    }

    /**
     * Creating Item list
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin._items.itemsCreate', ['item' => null]);
    }

    /**
     * Storing newly item
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */

    public function store(Request $request)
    {
        DB::beginTransaction();
        $data = $request->all();
        $this->validator($data);
        $request->request->add(['path' => self::path]);
        /** @var  Image $imgResolver */
        $imgResolver = resolve(Image::class);
        $imgResolver->upload($data);
        try {
            $item = Item::create($data);
            $item->exploration()->create($data['item']['exploration']);
            $item->price()->create($data['item']['price']);
            $this->itemCreateMany($item->includes(), $data['item'], 'includes');
            $this->itemCreateMany($item->excludes(), $data['item'], 'excludes');
            $this->itemCreateMany($item->packages(), $data['item'], 'packages');
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            $imgResolver->remove($data['img']);
            return redirect()->route('item.index')->with([
                'alert' => 'Data Unsuccessful Stored',
                'alertType' => 'alert-danger',
                'alertDetails' => $e->getMessage()
            ]);
        }
        return redirect()->route('item.index')->with([
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
        $item = Item::find($id);
        return view('Admin._items.itemsEdit', ['item' => $item, 'active' => 'item']);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        $item = Item::findOrFail($id);
        $data = $request->all();
        $this->validator($data);
        $request->request->add(['path' => self::path, 'current' => $item->img]);
        /** @var  Image $imgResolver */
        $imgResolver = resolve(Image::class);
        $imgResolver->upload($data);
        try {
            $item->update($data);
            $item->exploration()->update($data['item']['exploration']);
            $item->price()->update($data['item']['price']);
            syncHasMany($item->includes(), $data['item'], 'includes')->exec();
            syncHasMany($item->excludes(), $data['item'], 'excludes')->exec();
            syncHasMany($item->packages(), $data['item'], 'packages')->exec();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            $imgResolver->remove($data['img']);
            return redirect()->route('item.index')->with([
                'alert' => 'Data Unsuccessful Stored',
                'alertType' => 'alert-danger',
                'alertDetails' => $e->getMessage()
            ]);
        }
        return redirect()->route('item.index')->with([
            'alert' => 'Data Successful stored',
            'alertType' => 'alert-success'
        ]);

    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */

    public function destroy(Request $request, $id)
    {
        $item = Item::find($id);
        $request->request->add(['path' => self::path]);
        $currentImage = $item->img;
        /** @var  Image $imgResolver */
        $imgResolver = resolve(Image::class);
        $item->delete();
        $imgResolver->remove($currentImage);
        return redirect()->route('item.index')->with([
            'alert' => 'Data Successful Deleted',
            'alertType' => 'alert-warning'
        ]);
    }

    /**
     * @param HasMany $relation
     * @param array $data
     * @param $key
     */
    private function itemCreateMany(HasMany $relation, array $data, $key)
    {
        if (array_key_exists($key, $data)) {
            $relation->createMany($data[$key]);
        }
    }

    /**
     * @param array $data
     * @return mixed
     */
    private function validator(array $data)
    {
        return Validator::make($data, array_merge([
            'name' => 'required',
            'category_id' => 'required | integer',
            'title' => 'required',
            'arrangement' => 'required | integer',
            'img' => 'image'
        ], $this->prepareAllRules($data['item'], 'item', 'includes', ['txt' => 'required|string']),
            $this->prepareAllRules($data['item'], 'item', 'excludes', ['txt' => 'required|string']),
            $this->prepareAllRules($data['item'], 'item', 'exploration', ['txt' => 'required|string']),
            $this->prepareAllRules($data['item'], 'item', 'price', [
                'st_name' => 'required|string',
                'sec_name' => 'required|string',
                'st_price' => 'required|integer|min:1',
                'sec_price' => 'required|integer|min:0',
            ]),
            $this->prepareAllRules($data['item'], 'item', 'packages', [
                'min' => 'required|integer|min:1',
                'max' => 'required|integer|min:2',
                'st_price' => 'required|integer|min:1',
                'sec_price' => 'required|integer|min:0',
            ])))->validate();

    }

    /**
     * @param array $data
     * @param $prefix
     * @param $key
     * @param array $rules
     * @return array
     */
    private function prepareAllRules(array $data, $prefix, $key, array $rules)
    {
        if (array_key_exists($key, $data)) {
            return $this->rulesResolver($data[$key], $prefix . "." . $key, $rules);
        }
        return [];
    }

    /**
     * @param array $data
     * @param $prefix
     * @param $rules
     * @param array $return
     * @return array
     */
    private function rulesResolver(array $data, $prefix, $rules, &$return = [])
    {
        foreach ($data as $key => $val) {
            if (is_array($val)) {
                $this->rulesResolver($val, $prefix . "." . $key, $rules, $return);
            } else {
                if (array_key_exists($key, $rules)) {
                    $return[$prefix . "." . $key] = $rules[$key];
                }
            }
        }

        return $return;
    }

}