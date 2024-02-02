
app.controller('entryCtrl', function($scope , $http, $timeout , DBService) {
    $scope.loading = false;
    $scope.formData = {
        name:'',
        mobile:"",
        paid_amount:0,
        no_of_day:'',
        locker_id:'',
        discount_amount:0,
    };
    $scope.type = 0;
    $scope.filter = {};

    $scope.entry_id = 0;

    $scope.check_shift = "";
    $scope.pay_types = [];
    $scope.avail_pods = [];
    $scope.avail_cabins = [];
    $scope.avail_beds = [];
    $scope.hours = [];

    $scope.sl_pods = [];
    $scope.sl_cabins = [];
    $scope.sl_beds = [];
    $scope.total_amount = 0;
    $scope.paid_amount = 0;
    $scope.balance_amount = 0;
    
    $scope.init = function () {
        DBService.postCall($scope.filter, '/api/entries/init/'+$scope.type).then((data) => {
            if (data.success) {
                $scope.pay_types = data.pay_types;
                $scope.entries = data.entries;
                $scope.avail_pods = data.avail_pods;
                $scope.avail_cabins = data.avail_cabins;
                $scope.avail_beds = data.avail_beds;
                $scope.hours = data.hours;
            }
        });
    }
    $scope.filterClear = function(){
        $scope.filter = {};
        $scope.init();
    }

    $scope.edit = function(entry_id){
        $scope.entry_id = entry_id;
        $scope.sl_pods = [];
        DBService.postCall({entry_id : $scope.entry_id}, '/api/entries/edit-init').then((data) => {
            if (data.success) {
                console.log(data.l_entry.discount_amount+'hhhhh');
                $scope.formData = data.l_entry;
                $scope.total_amount = data.l_entry.total_amount;

                $scope.sl_pods = data.sl_pods;
                $("#exampleModalCenter").modal("show");
            }
            
        });
    }    

    $scope.checkoutLoker = function(entry_id){
        $scope.entry_id = entry_id;
        
        if(confirm("Are you sure?") == true){
            DBService.postCall({entry_id : $scope.entry_id}, '/api/entries/checkout-init').then((data) => {
                if (data.timeOut) {
                    $scope.formData = data.l_entry;
                    
                    $("#checkoutModal").modal("show");
                }else{
                    $scope.init(); 
                }
                
            });
        }
    }

    $scope.add = function(){
        $scope.entry_id = 0;
        $scope.sl_pods = [];
        $("#exampleModalCenter").modal("show");    
    }

    $scope.hideModal = () => {
        $("#exampleModalCenter").modal("hide");
        $("#checkoutModal").modal("hide");
        $scope.entry_id = 0;
        $scope.formData = {
            name:'',
            mobile:"",
            total_amount:0,
            paid_amount:0,
            balance_amount:0,
            discount_amount:0,
        };
    }

    $scope.onSubmit = function () {

        $scope.formData.type = $scope.type;
       
        if($scope.type == 1 && $scope.sl_pods.length == 0 ){
            alert('Please select at least one pods');
            return;
        }

        if($scope.type == 2 && $scope.sl_cabins.length == 0 ){
            alert('Please select at least one single cabins');
            return;
        }

        if($scope.type == 3 && $scope.sl_beds.length == 0 ){
            alert('Please select at least one double bed');
            return;
        }

        $scope.loading = true;

        if($scope.type == 1){
            $scope.formData.sl_pods = $scope.sl_pods;
        }
        if($scope.type == 2){
            $scope.formData.sl_cabins = $scope.sl_cabins;
        }
        if($scope.type == 3){
            $scope.formData.sl_beds = $scope.sl_beds;
        }

        DBService.postCall($scope.formData, '/api/entries/store/'+$scope.type).then((data) => {
            if (data.success) {
                $scope.loading = false;

                $("#exampleModalCenter").modal("hide");
                $scope.entry_id = 0;
                $scope.formData = {
                    name:'',
                    mobile:"",
                    paid_amount:0,
                    hours_occ:'',
                    discount_amount:0,
                    
                };
                $scope.sl_pods = [];
                $scope.sl_beds = [];
                $scope.sl_cabins = [];
                $scope.init();
                setTimeout(function(){
                    window.open(base_url+'/admin/entries/print/'+data.id,'_blank');
                }, 800);

            }
            $scope.loading = false;
        });
    }
    $scope.onCheckOut = function () {
        $scope.loading = true;
        DBService.postCall($scope.formData, '/api/entries/checkout-store').then((data) => {
            if (data.success) {
                $("#checkoutModal").modal("hide");
                $scope.entry_id = 0;
                $scope.formData = {
                    name:'',
                    mobile:"",
                    total_amount:0,
                    paid_amount:0,
                    balance_amount:0,
                    hours_occ:0,
                    check_in:'',
                    check_out:'',
                    discount_amount:0,
                };
                $scope.init();
            }
            $scope.loading = false;
        });
    }



    $scope.changeAmount = () => {
        if($scope.type == 1){
            $scope.changeAmountPod();
        }

        if($scope.type == 2){
            $scope.changeAmountCabin();
        }

        if($scope.type == 3){
            $scope.changeAmountBed();
        }
    }
  
    $scope.changeAmountPod = () => {

        var total_amount = 0;

        if($scope.formData.hours_occ == 6){
           total_amount= $scope.sl_pods.length*299;
        }else if($scope.formData.hours_occ == 12){
           total_amount= $scope.sl_pods.length*499;
        }else if($scope.formData.hours_occ == 24){
           total_amount= $scope.sl_pods.length*799;
        }
        $scope.total_amount = total_amount;
        $scope.formData.total_amount = total_amount;

        if($scope.entry_id == 0){
            if($scope.formData.discount_amount > 0){
                $scope.formData.paid_amount = total_amount - $scope.formData.discount_amount;
            }else{
                $scope.formData.paid_amount = total_amount;

            }
            $scope.formData.balance_amount = total_amount - $scope.formData.paid_amount;   

        }else{
            $scope.formData.balance_amount = total_amount - ($scope.formData.paid_amount + $scope.formData.discount_amount); 



        }
        $scope.balance_amount = $scope.formData.balance_amount; 
    }

    $scope.changeAmountCabin = () => {
        var total_amount = 0;

        if($scope.formData.hours_occ == 6){
           total_amount = $scope.sl_cabins.length*399;
        }else if($scope.formData.hours_occ == 12){
           total_amount = $scope.sl_cabins.length*599;
        }else if($scope.formData.hours_occ == 24){
           total_amount = $scope.sl_cabins.length*1199;
        }
        $scope.total_amount = total_amount;
        $scope.formData.total_amount = total_amount;

        if($scope.formData.discount_amount > 0){
            $scope.formData.paid_amount = total_amount - $scope.formData.discount_amount;
        }else{
            $scope.formData.paid_amount = total_amount;

        }
        $scope.formData.balance_amount = total_amount - $scope.formData.paid_amount;  
    }

    $scope.changeAmountBed = () => {

        var total_amount = 0;
        if($scope.formData.hours_occ == 6){
           total_amount = $scope.sl_beds.length*599;
        }else if($scope.formData.hours_occ == 12){
           total_amount = $scope.sl_beds.length*899;
        }else if($scope.formData.hours_occ == 24){
           total_amount = $scope.sl_beds.length*1699;
        }

        $scope.total_amount = total_amount;
        $scope.formData.total_amount = total_amount;

        if($scope.formData.discount_amount > 0){
            $scope.formData.paid_amount = total_amount - $scope.formData.discount_amount;
        }else{
            $scope.formData.paid_amount = total_amount;
        }
        $scope.formData.balance_amount = total_amount - $scope.formData.paid_amount;   
    }

    $scope.delete = function (id) {
        if(confirm("Are you sure?") == true){
            DBService.getCall('/api/entries/delete/'+id).then((data) => {
                alert(data.message);
                $scope.init();
            });
        }
    }

    $scope.insPods = (pod_id) => {
        let idx = $scope.sl_pods.indexOf(pod_id);
        if(idx == -1){
            $scope.sl_pods.push(pod_id);
        }else{
            $scope.sl_pods.splice(idx,1);
        }
        $scope.changeAmountPod();
    }

    $scope.insCabins = (cabin_id) => {
        let idx = $scope.sl_cabins.indexOf(cabin_id);
        if(idx == -1){
            $scope.sl_cabins.push(cabin_id);
        }else{
            $scope.sl_cabins.splice(idx,1);
        }
        $scope.changeAmountCabin();
    }

    $scope.insBeds = (bed_id) => {
        let idx = $scope.sl_beds.indexOf(bed_id);
        if(idx == -1){
            $scope.sl_beds.push(bed_id);
        }else{
            $scope.sl_beds.splice(idx,1);
        }
        $scope.changeAmountBed();
    }

    $scope.disAmount = () => {

        if($scope.formData.discount_amount > 0 && $scope.formData.total_amount > 0){
            if($scope.entry_id == 0){
                $scope.formData.paid_amount = $scope.total_amount - $scope.formData.discount_amount;
            }else{
                var str_data = (parseInt($scope.formData.paid_amount) + parseInt($scope.formData.discount_amount));
                
                $scope.formData.balance_amount = $scope.total_amount - str_data;
            }
            
        }


    }
});

app.controller('shiftCtrl', function($scope , $http, $timeout , DBService) {
    $scope.loading = false;

    $scope.filter = {
        input_date:'',
    }
    $scope.serach = function(){
        $scope.init();
    }
    $scope.init = function () {
        $scope.loading = false;

        DBService.postCall($scope.filter, '/api/shift/init').then((data) => {
            if (data.success) {                 
                $scope.pod_data = data.pod_data ; 
                $scope.cabin_data = data.cabin_data ; 
                $scope.bed_data = data.bed_data ; 

                
                $scope.total_shift_upi = data.total_shift_upi ; 
                $scope.total_shift_cash = data.total_shift_cash ; 
                $scope.total_collection = data.total_collection ; 

                $scope.last_hour_upi_total = data.last_hour_upi_total ; 
                $scope.last_hour_cash_total = data.last_hour_cash_total ; 
                $scope.last_hour_total = data.last_hour_total ;

                $scope.check_shift = data.check_shift ; 
                $scope.shift_date = data.shift_date ; 
            }
            $scope.loading = true;
        });
    }    

   
    
});


