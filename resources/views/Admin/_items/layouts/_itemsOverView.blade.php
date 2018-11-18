<div id="over_view" class="tab-pane fade">
    <h3>OverView</h3>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label>Intro</label>
                <textarea class="form-control" name="intro" required>{{itemValueResolve('intro',$item)}}</textarea>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label>Itinerary</label>
                <textarea class="text-area" name="item[exploration][txt]" placeholder="Enter text ..."
                          style="width: 100%; height: 200px">
                    {!! itemValueResolve('exploration',$item,'txt') !!}
                </textarea>
            </div>
        </div>
    </div>

</div>