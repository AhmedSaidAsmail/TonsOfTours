<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\MyModels\Admin\Item;
use App\Exceptions\CustomException;

class ItemDetailsController extends Controller {

    protected $_model = "\App\MyModels\Admin\\";
    protected function checkModel($model) {
        $this->_model .= ucfirst($model);
        if (!class_exists($this->_model)) {
            throw new CustomException("Oops This {$model}  is Not a Model");
        }
        return $this->_model;
    }
    public function create(Request $request, $item) {
        $this->validate($request, [
            'modelName' => 'required'
        ]);
        $this->checkModel($request->modelName);
        $Item = Item::find($item);
        return view('Admin.ItemDetailsCreate', ['Item' => $Item, 'modelName' => $request->modelName]);
    }
    public function store(Request $request, $itemID) {
        $this->validate($request, [
            'modelName' => 'required',
            'text.*'    => 'required|min:1'
        ]);
        $this->checkModel($request->modelName);
        $data            = [];
        $data['item_id'] = $itemID;
        $modelName       = "\App\MyModels\Admin\\" . ucfirst($request->modelName);
        foreach ($request->text as $text) {
            $data['txt'] = $text;
            $modelName::create($data);
        }
        return redirect()->route('Items.edit', ['item' => $itemID]);
    }
    public function edit(Request $request, $itemID, $rowID) {
        $Item  = Item::find($itemID);
        $model = $this->checkModel($request->modelName);
        $data  = $model::find($rowID);
        return view('Admin.ItemDetailsEdit', ['Data' => $data, 'Item' => $Item, 'modelName' => $request->modelName]);
    }
    public function update(Request $request, $itemID, $rowID) {
        $updatedData        = [];
        $model              = $this->checkModel($request->modelName);
        $data               = $model::find($rowID);
        $updatedData['txt'] = $request->text;
        $data->update($updatedData);
        return redirect()->route('Items.edit', ['item' => $itemID]);
    }
    public function show(Request $request, $itemID, $rowID) {
        $item = Item::find($itemID);
        return view('Admin.ItemDetailDelete', ['rowID' => $rowID, 'Item' => $item, 'modelName' => $request->modelName]);
    }
    public function destroy(Request $request, $itemID, $rowID) {
        $model  = $this->checkModel($request->modelName);
        $detail = $model::find($rowID);
        $detail->delete();
        return redirect()->route('Items.edit', ['Item' => $itemID]);
    }

}