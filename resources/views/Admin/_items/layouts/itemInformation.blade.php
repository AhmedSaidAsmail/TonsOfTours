<div id="information" class="tab-pane fade">
    <h3>Additional Information <a href="#" id="addNewInformation" class="btn btn-primary" style="margin-left: 50px;">Insert new Information</a></h3>

    <div class="add-additional-container">
        <div class="add-additional">
            <div class="row">
                <div class="col-md-10">
                    <div class="form-group">
                        <label>Information Title</label>
                        <input class="form-control" name="itinerary-title" id="information_title">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label>Order by</label>
                        <input type="number" value="0" class="form-control" name="order_by" id="information_order_by">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Information Text</label>
                        <textarea class="ck-text" name="itinerary-text" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" id="information_text"></textarea>
                    </div>
                </div>

            </div>
            <a href="#" id="addText" class="btn btn-block btn-primary">Add Text</a>
        </div>
    </div>

    <div class="row result-text">
        <ul class="info-list">
            @if(!is_null($item))
                <?php $index = 0; ?>
                @foreach($item->additional as $info)
                    <li class="indexing" index="{{$index}}">
                        <input type="hidden" name="information[{{$index}}][id]" value="{{$info->id}}">

                        <h3>{{$info->title}}
                            <a href="#" id="removeInfo"><i class="fa fa-times-circle text-danger"></i> </a>
                            <a href="#" id="editInfo"><i class="fa fa-pencil-square text-primary"></i> </a>
                        </h3>

                        <div class="one-info-show">
                            <div class="row">
                                <div class="col-md-10">
                                    <div class="form-group">
                                        <label>Information Title</label>
                                        <input class="form-control" name="information[{{$index}}][title]" value="{{$info->title}}">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Order by</label>
                                        <input type="number" value="{{$info->order_by}}" class="form-control" name="information[{{$index}}][order_by]">
                                    </div>
                                </div>
                            </div>

                            <textarea class="full-text" name="information[{{$index}}][text]" style="width: 100%;">{{$info->text}}</textarea>
                        </div>
                    </li>
                    <?php $index++; ?>
                @endforeach
            @endif

        </ul>
    </div>

</div>