<div id="details" class="tab-pane fade in">
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label>Arrangement</label>
                <input type="number" class="form-control" name="arrangement" value="0">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label>Status</label>
                <select name="status"class="form-control">
                    <option value="1" {!! !is_null($item) && $item->status?" selected":null  !!}>Show</option>
                    <option value="0" {!! !is_null($item) && !$item->status?" selected":null  !!}>hidden</option>
                </select>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label>Home</label>
                <select name="home"class="form-control">
                    <option value="0" {!! !is_null($item) && !$item->home?" selected":null  !!}>hidden</option>
                    <option value="1" {!! !is_null($item) && $item->home?" selected":null  !!}>Show</option>
                </select>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label>Recommended</label>
                <select name="recommended"class="form-control">
                    <option value="1" {!! !is_null($item) && $item->recommended?" selected":null  !!}>Recommended</option>
                    <option value="0" {!! !is_null($item) && !$item->recommended?" selected":null  !!}>normal</option>
                </select>
            </div>
        </div>

    </div>
</div>