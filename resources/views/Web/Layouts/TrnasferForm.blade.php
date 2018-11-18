<div style="display: none">
    <form id="getDestFrom" method="get" action="{{route('searchDist')}}">

    </form>
</div>
<div class="row transfer-form">
    <div class="transfer-form-conatiner">
        <div class="col-md-12 text-center transfer-form-header">
            <h3 class="text-center" style="width: 50%; margin: 0 auto;">
                <i class="fa fa-car" aria-hidden="true"></i> {{ vars::getVar("SHARM_TRANSFER") }}</h3>
            {{ vars::getVar("easy_booking") }}

        </div>
        <form action="{{route('add.transfer.to.cart')}}" method="post">
            <input type="hidden" name="_token" value="{{csrf_token()}}"/>
            <div class="transfer-form-body">
                <div class="row" style="padding-top: 75px;">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>{{ Vars::getVar("Arrival_Date&Departure_Date") }}</label>

                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input name="date" type="text" class="form-control" id="reservation">
                            </div>
                            <!-- /.input group -->
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6" style="position:relative;">
                        <div class="loading-small"></div>
                        <div class="form-group">
                            <label>{{ vars::getVar("From") }}</label>
                            <select name="dist_from" class="form-control" style="width: 100%;" id="dist_from" required>
                                <option selected value="" >{{Vars::getVar('Select_Destination')}}</option>
                                @foreach($dist_from as $transfer)
                                <option value="{{$transfer->dist_from}}">{{$transfer->dist_from}}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ vars::getVar("To") }}</label>
                            <select name="dist_to" class="form-control" style="width: 100%;" id="dist_to">
                                <option value="" selected="selected">{{Vars::getVar('Select_Destination')}}</option>

                            </select>
                        </div>

                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>{{ vars::getVar("Transfer_Type") }}</label>
                            <select name="transfer_type" class="form-control" style="width: 100%; border: 1px solid #fe6500;" id="transfer-type" required>
                                <option  selected value="">{{ vars::getVar("Select_Transfer_Type") }}</option>
                                <option value="type_limousine">{{ vars::getVar("Limousine") }}</option>
                                <option value="type_van">{{ vars::getVar("Van") }}</option>
                                <option value="type_coaster">{{ vars::getVar("Coaster") }}</option>
                                <option value="type_bus">{{ vars::getVar("Bus") }}</option>

                            </select>
                        </div>

                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>{{ vars::getVar("One-Way/Return") }}</label>
                            <select name="transfer_times" class="form-control" style="width: 100%; border: 1px solid #fe6500;">

                                <option value="1">{{ vars::getVar("One_Way") }}</option>
                                <option value="2">{{ vars::getVar("Go/Return") }}</option>
                            </select>
                        </div>

                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 transfer-text-label">
                        <i class="fa fa-info-circle" aria-hidden="true"></i> {{vars::getVar('Please_select_the_number_of_Adults_and_Children_for_transfer')}}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>{{ vars::getVar("Pax") }}</label>
                            <input name="pax" type="number" id="pax_no" value="" min="1" max="10"  class="form-control">
                        </div>

                    </div>

                </div>
                <div class="row text-center">

                    <button class="btn btn-lg btn-success" style="margin-bottom: 10px; ">
                        <span class="glyphicon glyphicon-shopping-cart"></span> {{Vars::getVar('Add_to_basket')}} <span class="glyphicon glyphicon-arrow-right"></span>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>