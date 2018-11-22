<div id="details" class="tab-pane fade">
    <h3>Details</h3>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label>Duration</label>
                <input class="form-control" name="details[duration]"
                       value="{{itemValueResolve('details',$item,'duration')}}" required>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label>Transfer</label>
                <input type="checkbox" name="details[transfer]"
                       value="1" {!! itemValueResolve('details',$item,'transfer')?"checked":null !!}>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label>Has Deposit</label>
                <input type="checkbox" name="details[has_deposit]"
                       value="1" {!! itemValueResolve('details',$item,'has_deposit')?"checked":null !!}>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>Deposit Percentage</label>
                <input type="number" class="form-control" name="details[deposit_percentage]"
                       value="{!! !is_null(itemValueResolve('details',$item,'deposit_percentage'))?itemValueResolve('details',$item,'deposit_percentage'):0 !!}"
                       min="0" max="100">
            </div>
        </div>
    </div>
</div>