@extends('Admin.Layouts._master')
@section('title','Items Panel | Update')
@section ('Extra_Css')
<link rel="stylesheet" type="text/css" href="{{asset('css/admin/style.css')}}">
<link rel="stylesheet" href="{{asset('adminlte/plugins/select2/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('adminlte/plugins/timepicker/bootstrap-timepicker.min.css')}}">
@endsection
@section('content')
<div class="content-wrapper">
    @if(Session::has('errorMsg'))
    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h4><i class="icon fa fa-ban"></i> {{Session('errorMsg')}} </h4>
        ..<a href="#" id="errorDetails">Details</a>
        {!! (Session::has('errorDetails'))?'<p id="ErrorMsgDetails">'.Session('errorDetails').'</p>':'' !!}
    </div>
    @endif
    <!-- Directory&Header -->
    <section class="content-header">
        <h1>Items <small>Items Update</small> </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> C-Panel</a></li>
            <li><a href="#">Update Items : {{$Item->name}}</a></li>
        </ol>
    </section>
    <!-- end Directory&Header -->
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <!-- box -->
                <div class="box">
                    <div class="box-header with-border">
                        <div class="form-group">
                            <button type="submit" class="btn btn-default form-control" id="addNew"><i class="fa fa-paw"></i> Update: <a href="#">{{$Item->name}}</a></button>
                        </div>
                    </div>
                    <div id="basicToggle">
                        <form method="post" action="{{route('Items.update',['id'=>$Item->id])}}" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="_method" value="PUT">
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Category Name:</label>
                                            <select class="form-control" name="sort_id">
                                                <option value="">Select  Category</option>
                                                @foreach (App\MyModels\Admin\Sort::all() as $category)
                                                <option value="{{$category->id}}" {!!($category->id==$Item->sort_id)?'selected="selected"':''!!}>{{$category->name}} -- {{$category->basicsort->name}}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Item Name:</label>
                                            <input class="form-control" value="{{$Item->name}}" name="name" placeholder="Main category Name" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Item Title:</label>
                                            <input class="form-control" value="{{$Item->title}}" name="title" placeholder="Main category Title" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Status</label>
                                            <select class="form-control" name="status">
                                                <option value="1" >Show</option>
                                                <option value="0" {!! (! $Item->status)?'selected="selected"':'' !!}>Hidden</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Home Shortcut</label>

                                            <select class="form-control" name="recommended">
                                                <option value="1">Show</option>
                                                <option value="0" {!! (! $Item->recommended)?'selected="selected"':'' !!}>Hidden</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Hot Offer</label>

                                            <select class="form-control" name="offer">
                                                <option value="1">True</option>
                                                <option value="0" {!! (! $Item->offer)?'selected="selected"':'' !!}>False</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group {{$errors->has('arrangement')?'has-error':''}}">
                                            <label>Arrangment</label>
                                            <input  value="{{$Item->arrangement}}" name="arrangement" class="form-control">
                                            @if($errors->has('arrangement'))
                                            <span class="help-block">The Arrangment has to be Integer</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group {{$errors->has('img')?'has-error':''}}">
                                            <label>Image</label>
                                            <input type="file" class="form-control" name="img">
                                            @if($errors->has('img'))
                                            <span class="help-block">It has to be an Image File</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Keywords:</label>
                                            <input class="form-control" value="{{$Item->keywords}}" name="keywords" placeholder="-- Keywords --" >
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Description:</label>
                                            <input class="form-control" value="{{$Item->description}}" name="description" placeholder="-- Description --" >
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Intro</label>
                                            <textarea class="form-control" name="intro">{{$Item->intro}}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group"> <input type="submit" class="btn btn-primary" value="Update Item"></div>
                                <div class="form-group"> </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Item Price -->
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-money"></i> <a href="#">Item Prices</a> Table</h3>
                    </div>
                    <div class="box-body">
                        @if(count($Item->price)>0)
                        <table class="table table-hover">
                            <tr>
                                <th>First Price Name</th>
                                <th>First Price</th>
                                <th>Second Price Name</th>
                                <th>Second price</th>
                                <th></th>
                            </tr>
                            <tr>
                                <td>{{$Item->price->st_name}}</td>
                                <td>{{$Item->price->st_price}}</td>
                                <td>{{$Item->price->sec_name}}</td>
                                <td>{{$Item->price->sec_price}}</td>
                                <td>
                                    <form method="post" action="{{ route('Price.destroy',['itemID'=>$Item->id,'id'=>$Item->price->id]) }}">
                                        <a href="{{ route('Price.edit',['itemID'=>$Item->id,'id'=>$Item->price->id]) }}"class="btn btn-sm btn-info"><i class="fa fa-edit"></i> Edit</a>
                                        <input type="hidden" name="_token" value="{{ csrf_token()}}">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        </table>
                        @else
                        <form method="post" action="{{route('Price.store',['itemId'=>$Item->id])}}">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <input type="hidden" name="item_id" value="{{$Item->id}}">
                            <div class="row">
                                <div class="col-md-3"><input class="form-control" type="text" name="st_name" placeholder="First Price Name"></div>
                                <div class="col-md-2"><input class="form-control" type="text" name="st_price" placeholder="First Price"></div>
                                <div class="col-md-3"><input class="form-control" type="text" name="sec_name" placeholder="Second Price Name"></div>
                                <div class="col-md-2"><input class="form-control" type="text" name="sec_price" placeholder="Second Price"></div>
                                <div class="col-md-2"><button class="btn btn-success">Add New Price</button></div>

                            </div>
                        </form>
                        @endif
                    </div>
                </div>
                <!-- Item Price End -->
                <!-- Item Exploration  -->
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title"><a href="#"><i class="fa fa-clock-o"></i> Exploration </a></h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <select class="form-control" name="galleryAction" id="galleryNav">
                                        <option value="">Select an Action</option>
                                        <option value="{{route('Exploration.create',['itemID'=>$Item->id])}}">Add New</option>
                                        <option value="{{ route('Exploration.index',['itenID'=>$Item->id]) }}">Exploration List</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Item Exploration End -->


                <div>
                    <form action="{{route('Information.create',['itemID'=>$Item->id])}}" method="get">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Add New Details To This Items</label>
                                    <select name="modelName" class="form-control" id="detailsNavigatore">
                                        <option value="">Select Details to Add</option>
                                        <option value="inclusion">Inclusions</option>
                                        <option value="exclusion">Exclusions</option>
                                        <option value="additional">Additional Information </option>
                                        <option value="dresse">Dresses</option>
                                        <option value="note">Notes</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <!-- Inclusions -->
                        <div class="box">
                            <div class="box-header">
                                <h3 class="box-title">Inclusions Table</h3>
                            </div>
                            <div class="box-body no-padding">
                                <table class="table table-striped">
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Inclusions Text</th>
                                        <th>Edit</th>
                                        <th style="width: 40px">Delete</th>
                                    </tr>
                                    <?php $oredr = 1 ?>
                                    @foreach($Item->inclusion as $inclusion)
                                    <tr>
                                        <td>{{$oredr}}</td>
                                        <td>{{$inclusion->txt}}</td>
                                        <td><a href="{{route('Information.edit',['item'=>$Item->id,'Information'=>$inclusion->id,'modelName'=>'inclusion'])}}" class="btn btn-xs btn-warning">Edit</a></td>
                                        <td><a href="{{route('Information.show',['item'=>$Item->id,'Information'=>$inclusion->id,'modelName'=>'inclusion'])}}"><i class="fa fa-trash"></i></a></td>
                                    </tr>
                                    <?php $oredr++ ?>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                        <!-- end Inclusions-->
                        <!-- Additional Information -->
                        <div class="box">
                            <div class="box-header">
                                <h3 class="box-title">Additional Information Table</h3>
                            </div>
                            <div class="box-body no-padding">
                                <table class="table table-striped">
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Information Text</th>
                                        <th>Edit</th>
                                        <th style="width: 40px">Delete</th>
                                    </tr>
                                    <?php $oredr = 1 ?>
                                    @foreach($Item->additional as $additional)
                                    <tr>
                                        <td>{{$oredr}}</td>
                                        <td>{{$additional->txt}}</td>
                                        <td><a href="{{route('Information.edit',['item'=>$Item->id,'rowID'=>$additional->id,'modelName'=>'additional'])}}" class="btn btn-xs btn-warning">Edit</a></td>
                                        <td><a href="{{route('Information.show',['item'=>$Item->id,'rowID'=>$additional->id,'modelName'=>'additional'])}}"><i class="fa fa-trash"></i></a></td>
                                    </tr>
                                    <?php $oredr++ ?>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                        <!-- end Additional Information-->
                        <!-- Dresses -->
                        <div class="box">
                            <div class="box-header">
                                <h3 class="box-title">Dresses Table</h3>
                            </div>
                            <div class="box-body no-padding">
                                <table class="table table-striped">
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Dresses Text</th>
                                        <th>Edit</th>
                                        <th style="width: 40px">Delete</th>
                                    </tr>
                                    <?php $oredr = 1 ?>
                                    @foreach($Item->dresse as $dresse)
                                    <tr>
                                        <td>{{$oredr}}</td>
                                        <td>{{$dresse->txt}}</td>
                                        <td><a href="{{route('Information.edit',['item'=>$Item->id,'rowID'=>$dresse->id,'modelName'=>'dresse'])}}" class="btn btn-xs btn-warning">Edit</a></td>
                                        <td><a href="{{route('Information.show',['item'=>$Item->id,'rowID'=>$dresse->id,'modelName'=>'dresse'])}}"><i class="fa fa-trash"></i></a></td>
                                    </tr>
                                    <?php $oredr++ ?>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                        <!-- end Dresses-->

                    </div>
                    <div class="col-md-6">
                        <!-- Inclusions -->
                        <div class="box">
                            <div class="box-header">
                                <h3 class="box-title">Exclusions Table</h3>
                            </div>
                            <div class="box-body no-padding">
                                <table class="table table-striped">
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Exclusions Text</th>
                                        <th>Edit</th>
                                        <th style="width: 40px">Delete</th>
                                    </tr>
                                    <?php $oredr = 1 ?>
                                    @foreach($Item->exclusion as $exclusion)
                                    <tr>
                                        <td>{{$oredr}}</td>
                                        <td>{{$exclusion->txt}}</td>
                                        <td><a href="{{route('Information.edit',['item'=>$Item->id,'Information'=>$exclusion->id,'modelName'=>'exclusion'])}}" class="btn btn-xs btn-warning">Edit</a></td>
                                        <td><a href="{{route('Information.show',['item'=>$Item->id,'Information'=>$exclusion->id,'modelName'=>'exclusion'])}}"><i class="fa fa-trash"></i></a></td>
                                    </tr>
                                    <?php $oredr++ ?>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                        <!-- end Inclusions-->
                        <!-- Notes -->
                        <div class="box">
                            <div class="box-header">
                                <h3 class="box-title">Notes Table</h3>
                            </div>
                            <div class="box-body no-padding">
                                <table class="table table-striped">
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Notes Text</th>
                                        <th>Edit</th>
                                        <th style="width: 40px">Delete</th>
                                    </tr>
                                    <?php $oredr = 1 ?>
                                    @foreach($Item->note as $note)
                                    <tr>
                                        <td>{{$oredr}}</td>
                                        <td>{{$note->txt}}</td>
                                        <td><a href="{{route('Information.edit',['item'=>$Item->id,'rowID'=>$note->id,'modelName'=>'note'])}}" class="btn btn-xs btn-warning">Edit</a></td>
                                        <td><a href="{{route('Information.show',['item'=>$Item->id,'rowID'=>$note->id,'modelName'=>'note'])}}"><i class="fa fa-trash"></i></a></td>
                                    </tr>
                                    <?php $oredr++ ?>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                        <!-- end Notes-->
                        <!-- Item Gallery -->
                        <div class="box">
                            <div class="box-header with-border">
                                <h3 class="box-title"><a href="#"><i class="fa fa-android"></i> Gallery </a></h3>
                            </div>
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <select class="form-control" name="galleryAction" id="galleryNav">
                                                <option value="">Select an Action</option>
                                                <option value="{{route('ItemGallery.create',['itemID'=>$Item->id])}}">Upload New Images</option>
                                                <option value="{{ route('ItemGallery.index',['itenID'=>$Item->id]) }}">Gallery List</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Item Gallery End -->

                    </div>

                </div>


                <!-- Items Details -->
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title"><a href="#"><i class="fa fa-th"></i> Item Details</a> Table</h3>
                    </div>
                    <div class="box-body">
                        @if(count($Item->detail)>0)
                        <div class="row">
                            <div class="col-md-2"><span class="h4">Started At</span></div>
                            <div class="col-md-1">{{ $Item->detail->started_at }}</div>
                            <div class="col-md-2"><span class="h4">Ended At</span></div>
                            <div class="col-md-1">{{ $Item->detail->ended_at }}</div>

                            <div class="col-md-2">
                                <span class="h4"> Availability</span>
                            </div>
                            <div class="col-md-2">
                                @if(isset($Item->detail->availability))
                                @foreach(unserialize($Item->detail->availability) as $day)
                                <span class="label label-default">{{ $day }}</span>
                                @endforeach
                                @endif
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <a href="{{ route('Detail.edit',['itemID'=>$Item->id,'detail'=>$Item->detail->id]) }}" class="btn btn-info"><i class="fa fa-hand-pointer-o"></i> Update Details</a>
                                </div>
                            </div>
                        </div>
                        @else
                        <form method="post" action="{{route('Detail.store',['itemID'=>$Item->id])}}">
                            <input type="hidden" value="{{ csrf_token() }}" name="_token">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="bootstrap-timepicker">
                                        <div class="form-group">
                                            <label>Started At:</label>
                                            <div class="input-group">
                                                <input type="text" name="started_at" class="form-control timepicker">
                                                <div class="input-group-addon"> <i class="fa fa-clock-o"></i> </div>
                                            </div>
                                            <!-- /.input group -->
                                        </div>
                                        <!-- /.form group -->
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="bootstrap-timepicker">
                                        <div class="form-group">
                                            <label>Ended At:</label>
                                            <div class="input-group">
                                                <input type="text" name="ended_at" class="form-control timepicker">
                                                <div class="input-group-addon"> <i class="fa fa-clock-o"></i> </div>
                                            </div>
                                            <!-- /.input group -->
                                        </div>
                                        <!-- /.form group -->
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Availability</label>
                                        <select name="availability[]" class="form-control select2" multiple="multiple" data-placeholder="Select a Day">
                                            <option>Saturday</option>
                                            <option>Sunday</option>
                                            <option>Monday</option>
                                            <option>Tuesday</option>
                                            <option>Thursday</option>
                                            <option>Wednesday</option>
                                            <option>Friday</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label></label>
                                        <button class="btn btn-primary form-control"><i class="fa fa-paw"></i> Add Details</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        @endif
                    </div>
                </div>
                <!-- Items Details End -->





            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- end content -->
</div>
@endsection
@section('Extra_Js')
<script src="{{asset('js/admin/admin.js')}}"></script>
<script src="{{asset('adminlte/plugins/select2/select2.full.min.js')}}"></script>
<script src="{{asset('adminlte/plugins/timepicker/bootstrap-timepicker.min.js')}}"></script>
<script>
$(function() {
    $(".select2").select2();
    $(".timepicker").timepicker({
        showInputs: false,
        showMeridian: false
    });
});
</script>

@endsection