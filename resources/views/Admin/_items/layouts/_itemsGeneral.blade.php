<div id="general" class="tab-pane fade in active">
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label>Category</label>
                <select name="category_id" class="form-control select-options" required>
                    <option value="">Select a Category</option>
                    @foreach(categoriesAll() as $category)
                        <?php
                        $selected = !is_null($item) && $category->id == $item->category_id ? "selected" : null;
                        ?>
                        <option value="{{$category->id}}" {{$selected}}>{{$category->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>Name</label>
                <input name="name" value="{{itemValueResolve("name",$item)}}" class="form-control" required>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>Title</label>
                <input name="title" value="{{itemValueResolve("title",$item)}}" class="form-control" required>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label>Meta Keywords</label>
                <input name="keywords" value="{{itemValueResolve("keywords",$item)}}" class="form-control">

                </select>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>Meta Description</label>
                <input name="description" value="{{itemValueResolve("description",$item)}}" class="form-control">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>Status</label>
                <select name="status" class="form-control">
                    <?php $status = itemValueResolve('status', $item); ?>
                    <option value="1">show</option>
                    <option value="0" {!! !$status&&!is_null($status)?"selected":null !!}>hidden</option>
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label>Recommended</label>
                <select name="recommended" class="form-control">
                    <?php $recommended = itemValueResolve('recommended', $item); ?>
                    <option value="1">true</option>
                    <option value="0" {!! !$recommended&&!is_null($recommended)?"selected":null !!}>false</option>
                </select>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>Hot Offer</label>
                <select name="recommended" class="form-control">
                    <?php $offer = itemValueResolve('offer', $item); ?>
                    <option value="1">true</option>
                    <option value="0" {!! !$offer&&!is_null($offer)?"selected":null !!}>false</option>
                </select>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>Arrangement</label>
                <input type="number" name="arrangement" value="{{sprintf('%d',itemValueResolve("arrangement",$item))}}" class="form-control">
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label>Intro Image</label>
                <input type="file" name="img" class="form-control">
            </div>
        </div>
    </div>
</div>