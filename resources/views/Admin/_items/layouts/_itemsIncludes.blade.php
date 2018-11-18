<div id="includes" class="tab-pane fade">
    <h3>Includes</h3>
    <div id="includes-group">
        @if(!is_null($item))
            @foreach($item->includes as $include)
                <div class="row">
                    <input type="hidden" name="item[includes][{{$include->id}}][id]" value="{{$include->id}}">
                    <div class="col-md-11">
                        <div class="form-group">
                            <input class="form-control" name="item[includes][{{$include->id}}][txt]" value="{{$include->txt}}" placeholder="Text"
                                   required="">
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="form-group">
                            <a class=" btn btn-default" id="deleteRow"><i class="fa fa-fw fa-trash-o"></i></a>
                        </div>

                    </div>
                </div>
            @endforeach
        @endif
        {{-- Appending Area--}}
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <a class="btn btn-success" id="addIncludes"><i class="fa fa-fw fa-plus"></i>Add Includes</a>
            </div>
        </div>

    </div>

</div>
@section('Extra_Js')
    @parent
    <script>
        $("a#addIncludes").on('click', function (event) {
            event.preventDefault();
            let groupStack = $("#includes-group");
            groupStack.append('<div class="row">\n' +
                '            <div class="col-md-11">\n' +
                '                <div class="form-group">\n' +
                '                    <input class="form-control" name="item[includes][][txt]" value="" placeholder="Text" required>\n' +
                '                </div>\n' +
                '            </div>\n' +
                '            <div class="col-md-1">\n' +
                '                <div class="form-group">\n' +
                '                    <a class=" btn btn-default" id="deleteRow"><i class="fa fa-fw fa-trash-o"></i></a>\n' +
                '                </div>\n' +
                '\n' +
                '            </div>\n' +
                '        </div>');
            removeRow();
        });

        function removeRow() {
            $("a#deleteRow").on('click', function (event) {
                event.preventDefault();
                let row = $(this).closest('.row');
                row.remove();
            });
        }
    </script>
@endsection