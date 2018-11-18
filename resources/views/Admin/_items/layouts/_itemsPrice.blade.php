<div id="price" class="tab-pane fade">
    <h3>Price</h3>

    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label>First Price Sort</label>
                <input class="form-control" value="{{itemValueResolve('price',$item,'st_name')}}"
                       name="item[price][st_name]" required>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label>First Price</label>
                <input type="number" class="form-control" value="{{itemValueResolve('price',$item,'st_price')}}"
                       name="item[price][st_price]"
                       required>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label>Second Price Sort</label>
                <input class="form-control" value="{{itemValueResolve('price',$item,'sec_name')}}"
                       name="item[price][sec_name]" required>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label>Second Price </label>
                <input type="number" class="form-control" value="{{itemValueResolve('price',$item,'sec_price')}}"
                       name="item[price][sec_price]"
                       required>
            </div>
        </div>
    </div>
</div>