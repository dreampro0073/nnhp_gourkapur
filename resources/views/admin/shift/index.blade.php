
@extends('admin.layout')

@section('main')
    <div class="main" ng-controller="shiftCtrl" ng-init="init();"> 
        <div class="card shadow mb-4 p-4">    
            <div class="row">
                <div class="col-md-6">
                    <h2 class="">Total Shift Collection (@{{shift_date}} - @{{check_shift}})</h2>
                </div>

                @if(Auth::user()->priv != 1)

                <div class="col-md-6 text-right" style="padding-top: 25px;">
                    <a href="{{url('/admin/shift/print/1')}}" class="btn btn-sm btn-warning"  target="_blank">
                        Print
                    </a>
                </div>
                @endif
            </div>
            <hr>
            @if(Auth::user()->priv == 1)
            <div class="row">
                <div class="col-md-3 form-group">
                    <input type="text" class="datepicker form-control" ng-model="filter.input_date">
                    
                </div>
                <div class="col-md-3 form-group" >
                    <select ng-model="filter.user_id" class="form-control" convert-to-number>
                        <option value="">Select</option>
                        <option value="@{{user.id}}" ng-repeat="user in users">@{{user.name}}</option>
                    </select>
                    
                </div>
                <div class="col-md-3">
                    <button ng-click="serach()" class="btn btn-primary">
                        Search
                    </button>
                    <button ng-click="clear()" class="btn btn-warning">
                        Clear
                    </button>
                </div>
            </div>
            <hr>
            
            @endif
            
            <table class="table table-bordered table-striped" style="width:100%;">
                <thead>
                    <tr>
                        <th rowspan="2"></th>
                        <th colspan="3">Last Hour</th>
                        <th colspan="3">Shift Collection</th>
                    </tr>
                    <tr>
                        <th>UPI</th>
                        <th>Cash</th>
                        <th>Total</th>
                        <th>UPI</th>
                        <th>Cash</th>
                        <th>Total</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                       <td>
                           PODS
                       </td> 
                       
                        <td>
                            @{{pod_data.last_hour_upi_total}}
                        </td>
                        <td>
                            @{{pod_data.last_hour_cash_total}}

                        </td>
                        <td>
                            @{{pod_data.last_hour_total}}
                        </td>
                        <td>
                            @{{pod_data.total_shift_upi}}
                        </td>
                        <td>
                            @{{pod_data.total_shift_cash}}

                        </td>
                        <td>
                            @{{pod_data.total_collection}}

                        </td>
                    </tr>
                    <tr>
                       <td>
                           Single Suit Cabin
                       </td> 
                        <td>
                            @{{cabin_data.last_hour_upi_total}}
                        </td>
                        <td>
                            @{{cabin_data.last_hour_cash_total}}

                        </td>
                        <td>
                            @{{cabin_data.last_hour_total}}
                        </td>

                        <td>
                            @{{cabin_data.total_shift_upi}}
                        </td>
                        <td>
                            @{{cabin_data.total_shift_cash}}

                        </td>
                        <td>
                            @{{cabin_data.total_collection}}

                        </td>
                    </tr>
                    <tr>
                       <td>
                           Double Beds
                       </td> 
                        <td>
                            @{{bed_data.last_hour_upi_total}}
                        </td>
                        <td>
                            @{{bed_data.last_hour_cash_total}}

                        </td>
                        <td>
                            @{{bed_data.last_hour_total}}
                        </td>

                        <td>
                            @{{bed_data.total_shift_upi}}
                        </td>
                        <td>
                            @{{bed_data.total_shift_cash}}

                        </td>
                        <td>
                            @{{bed_data.total_collection}}

                        </td>
                    </tr>
                    <tr>
                       <td>
                           <b>Grand Total</b>
                       </td> 
                        <td>
                            <b>@{{last_hour_upi_total}}</b>
                        </td>
                        <td>
                            <b>@{{last_hour_cash_total}}</b>

                        </td>
                        <td>
                            <b>@{{last_hour_total}}</b>
                        </td>
                        <td>
                            <b>@{{pod_data.total_shift_upi+cabin_data.total_shift_upi+bed_data.total_shift_upi}}</b>
                        </td>
                        <td>
                            <b> <b>@{{pod_data.total_shift_cash+cabin_data.total_shift_cash+bed_data.total_shift_cash}}</b></b>

                        </td>
                        <td>
                            <b>@{{total_collection}}</b>

                        </td>
                    </tr>

                </tbody>
            </table>  
            
        </div>
    </div>
@endsection
    
    