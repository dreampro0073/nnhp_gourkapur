@extends('admin.layout')

@section('main')

<div class="main">
    <h1 class="h3 mb-2 text-gray-800">Dashboard</h1>	
   	

</div>
@endsection


@section('footer_scripts')
    <?php $version = "0.0.3"; ?>
        
    <script type="text/javascript" src="{{url('assets/scripts/core/client_ctrl.js?v='.$version)}}" ></script>

    
@endsection
