@extends('Admin.Layouts._master')
@section('title','Items Panel')
@section ('Extra_Css')
    <style>
        .row-to-repeat {
            margin-bottom: 10px;
        }
    </style>
@endsection
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1> Items
                <small>Items Images</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> C-Panel</a></li>
                <li><a href="#">Images</a></li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Upload New Images</h3>
                        </div>
                        <div class="box-body">
                            <form method="post" action="{{route('images.store')}}" enctype="multipart/form-data">
                                {{csrf_field()}}
                                <sction class="rows">
                                    <div class="row row-to-repeat">
                                        <div class="col-md-5">
                                            <input class="form-control" name="images[][title]"
                                                   placeholder="Image Title">
                                        </div>
                                        <div class="col-md-5">
                                            <input type="file" class="form-control" name="images[][image]">
                                        </div>
                                        <div class="col-md-2">
                                            <a href="#" class="btn btn-danger" id="removeRow">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </div>
                                    </div>
                                </sction>
                                <a class="btn btn-primary" id="addRow">
                                    <i class="fa fa-plus"></i>
                                </a>
                                <button class="btn btn-success">
                                    <i class="fa fa-upload"></i> Upload
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@section('Extra_Js')
    <script>
        let row = document.getElementsByClassName('row-to-repeat')[0].outerHTML;
        $(function () {
            $("a#addRow").click(function (event) {
                event.preventDefault();
                let section = $(".rows");
                section.append(row);
                removeRow();

            });
            removeRow();

            function removeRow() {
                $('a#removeRow').click(function (event) {
                    event.preventDefault();
                    let row=$(this).closest('.row');
                    row.remove();
                });
            }
        });
    </script>
@endsection
