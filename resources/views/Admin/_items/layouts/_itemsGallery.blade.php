<div id="gallery" class="tab-pane fade">
    <h3>Gallery</h3>
    <div class="box">
        <div class="box-header with-border">
            <h3>Selected</h3>
            <ul class="list-inline">
                @foreach($item->images as $image)
                    <li class="gallery-item-container">
                        <div class="gallery-item">
                            <img src="{{asset('images/gallery/thumb/'.$image->image)}}">
                            <input type="checkbox" name="gallery[][image_id]" value="{{$image->id}}" checked>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="box-body">
            <div class="gallery-holder">
                <ul class="list-inline">
                    @foreach($gallery as $image)
                        @if(!in_array($image->id,$item_images_id))
                            <li class="gallery-item-container">
                                <div class="gallery-item">
                                    <img src="{{asset('images/gallery/thumb/'.$image->image)}}">
                                    <input type="checkbox" name="gallery[][image_id]" value="{{$image->id}}">
                                </div>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
@section('Extra_Css')
    @parent
    <style>
        .gallery-holder {
            width: 100%;
            height: 450px;
            background-color: #e0e0e0;
            overflow-y: auto;
        }

        .gallery-item-container {
            padding: 7px;
            border: 1px solid #e0dfe3;
            margin: 5px;
        }

        .gallery-item {
            position: relative;
            width: 120px;
            height: 120px;
            overflow: hidden;
        }

        .gallery-item > img {
            position: absolute;
            min-width: 100%;
            height: 100%;
            margin: auto;
            top: 0;
            right: 0;
            left: 0;
            bottom: 0;
            z-index: 1;
        }

        .gallery-item > input[type=checkbox] {
            position: absolute;
            left: 5px;
            top: 5px;
            z-index: 2;
        }
    </style>
@endsection