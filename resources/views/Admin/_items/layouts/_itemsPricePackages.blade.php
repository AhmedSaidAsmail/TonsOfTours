<div id="pricePackages" class="tab-pane fade">
    <h3>Price Packages</h3>
    <div id="packages-group">
        @if(!is_null($item))
            @foreach($item->packages as $package)
                <div class="row" data-id="{{$package->id}}">
                    <input type="hidden" name="item[packages][{{$package->id}}][id]" value="{{$package->id}}">
                    <div class="col-md-2">
                        <span>Min</span>
                        <input class="form-control" type="number" name="item[packages][{{$package->id}}][min]"
                               value="{{$package->min}}">
                    </div>
                    <div class="col-md-2">
                        <span>Max</span>
                        <input class="form-control" type="number" name="item[packages][{{$package->id}}][max]"
                               value="{{$package->max}}">
                    </div>
                    <div class="col-md-3">
                        <span>First Price</span>
                        <input class="form-control" name="item[packages][{{$package->id}}][st_price]"
                               value="{{$package->st_price}}">
                    </div>
                    <div class="col-md-3">
                        <span>Second Price</span>
                        <input class="form-control" name="item[packages][{{$package->id}}][sec_price]"
                               value="{{$package->sec_price}}">
                    </div>
                    <div class="col-md-2">
                        <span style="display: block">#</span>
                        <a class=" btn btn-default" id="deleteRow"><i class="fa fa-fw fa-trash-o"></i></a>
                    </div>
                </div>
            @endforeach
        @endif
        {{-- Appending Area--}}
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <a class="btn btn-success" id="addPackage"><i class="fa fa-fw fa-plus"></i>Add Package</a>
            </div>
        </div>

    </div>
</div>
@section('Extra_Js')
    @parent
    <script>
        $("a#addPackage").on('click', function (event) {
            event.preventDefault();
            let groupStack = $("#packages-group");
            let id = generateId(groupStack);
            groupStack.append('<div class="row" data-id="' + id + '">\n' +
                '            <div class="col-md-2">\n' +
                '                <span>Min</span>\n' +
                '                <input class="form-control" type="number" name="item[packages][' + id + '][min]" value="0">\n' +
                '            </div>\n' +
                '            <div class="col-md-2">\n' +
                '                <span>Max</span>\n' +
                '                <input class="form-control" type="number" name="item[packages][' + id + '][max]" value="0">\n' +
                '            </div>\n' +
                '            <div class="col-md-3">\n' +
                '                <span>First Price</span>\n' +
                '                <input class="form-control" name="item[packages][' + id + '][st_price]">\n' +
                '            </div>\n' +
                '            <div class="col-md-3">\n' +
                '                <span>Second Price</span>\n' +
                '                <input class="form-control" name="item[packages][' + id + '][sec_price]">\n' +
                '            </div>\n' +
                '            <div class="col-md-2">\n' +
                '                <span style="display: block">#</span>\n' +
                '                <a class=" btn btn-default" id="deleteRow"><i class="fa fa-fw fa-trash-o"></i></a>\n' +
                '            </div>\n' +
                '        </div>');
            removeRow();
        });
        removeRow();

        function generateId(groupStack) {
            if (!groupStack.find(".row").length) {
                return 0;
            }
            let lastRow = groupStack.children('.row').last();
            return parseInt(lastRow.attr('data-id')) + 1;
        }

        function removeRow() {
            $("a#deleteRow").on('click', function (event) {
                event.preventDefault();
                let row = $(this).closest('.row');
                row.remove();
            });
        }
    </script>
@endsection