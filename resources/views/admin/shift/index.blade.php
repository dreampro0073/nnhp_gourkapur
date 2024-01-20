@extends('admin.layout')

@section('main')
    <div class="main" ng-controller="shiftCtrl" ng-init="init();"> 
        <div class="card shadow mb-4 p-4">    
            <div class="row">
                <div class="col-md-6">
                    <h2 class="">Total Shift Collection (@{{shift_date}} - @{{check_shift}})</h2>
                </div>
                <div class="col-md-6 text-right" style="padding-top: 25px;">
                    <a href="{{url('/admin/shift/print/1')}}" class="btn btn-sm btn-warning"  target="_blank">
                        Print
                    </a>
                </div>
            </div>
            <hr>
             <table class="table table-bordered table-striped" style="width:100%;">
                <thead>
                    <tr>
                        <th rowspan="2"></th>
                        <th colspan="3">Last Hour</th>
                        <th colspan="3">Your Collection</th>

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
                           Sitting
                       </td> 
                       
                        <td>
                            @{{shitting_data.last_hour_upi_total}}
                        </td>
                        <td>
                            @{{shitting_data.last_hour_cash_total}}

                        </td>
                        <td>
                            @{{shitting_data.last_hour_total}}
                        </td>
                        <td>
                            @{{shitting_data.total_shift_upi}}
                        </td>
                        <td>
                            @{{shitting_data.total_shift_cash}}

                        </td>
                        <td>
                            @{{shitting_data.total_collection}}

                        </td>
                    </tr>
                    <tr>
                       <td>
                           Massage
                       </td> 
                        <td>
                            @{{massage_data.last_hour_upi_total}}
                        </td>
                        <td>
                            @{{massage_data.last_hour_cash_total}}

                        </td>
                        <td>
                            @{{massage_data.last_hour_total}}
                        </td>

                        <td>
                            @{{massage_data.total_shift_upi}}
                        </td>
                        <td>
                            @{{massage_data.total_shift_cash}}

                        </td>
                        <td>
                            @{{massage_data.total_collection}}

                        </td>
                    </tr>
                    <tr>
                       <td>
                           Locker
                       </td> 
                        <td>
                            @{{locker_data.last_hour_upi_total}}
                        </td>
                        <td>
                            @{{locker_data.last_hour_cash_total}}

                        </td>
                        <td>
                            @{{locker_data.last_hour_total}}
                        </td>

                        <td>
                            @{{locker_data.total_shift_upi}}
                        </td>
                        <td>
                            @{{locker_data.total_shift_cash}}

                        </td>
                        <td>
                            @{{locker_data.total_collection}}

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
                            <b>@{{total_shift_upi}}</b>
                        </td>
                        <td>
                            <b>@{{total_shift_cash}}</b>

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
    
    