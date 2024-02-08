@extends('admin.layout')

@section('main')

<div class="main">
    <h1 class="h3 mb-2 text-gray-800">Dashboard</h1>

    <div class="row">
        <div class="col-md-4">
            <div class="box card">
                <h4>{{sizeof($avail_pods)}}</h4>

                <h5>
                    Available PODs
                </h5>
                <span>
                    <?php echo implode(', ',$avail_pods); ?>
                </span>
            </div>
        </div>
        <div class="col-md-4">
            <div class="box card">
                <h4>{{sizeof($avail_cabins)}}</h4>

                <h5>
                    Available Single Suit Cabins
                </h5>
                <span>
                    <?php echo implode(', ',$avail_cabins); ?>
                </span>
            </div>
        </div>
        <div class="col-md-4">
            <div class="box card">
                <h4>{{sizeof($avail_beds)}}</h4>

                <h5>
                    Double Beds
                </h5>
                <span>
                    <?php echo implode(', ',$avail_beds); ?>
                </span>

            </div>
        </div>
       
    </div>	
    <div class="row" style="margin-top:20px;">
        <div class="col-md-4">
            <div class="box card">
                <h4>{{sizeof($booked_pods)}}</h4>

                <h5>
                    Bookes PODs
                </h5>
                <span>
                    <?php echo implode(', ',$booked_pods); ?>
                </span>
            </div>
        </div>
        <div class="col-md-4">
            <div class="box card">
                <h4>{{sizeof($booked_cabins)}}</h4>

                <h5>
                    Booked Single Suit Cabins
                </h5>
                <span>
                    <?php echo implode(', ',$booked_cabins); ?>
                </span>
            </div>
        </div>
        <div class="col-md-4">
            <div class="box card">
                <h4>{{sizeof($booked_beds)}}</h4>

                <h5>
                    Booked Double Beds
                </h5>
                <span>
                    <?php echo implode(', ',$booked_beds); ?>
                </span>

            </div>
        </div>
    </div>
   	

</div>
@endsection


@section('footer_scripts')
    



    
@endsection
