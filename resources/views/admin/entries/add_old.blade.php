<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="row">
                    <div class="col-md-6">
                        <h5 class="modal-title" id="exampleModalLongTitle">
                            <span ng-if="type == 1">Pods</span>
                            <span ng-if="type == 2">Sigle Suit Babin</span>
                            <span ng-if="type == 3">Double Bed</span>
                        </h5>
                    </div>
                    <div class="col-md-6" style="text-align:right;">
                        <button type="button" class="close" ng-click="hideModal();" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                
            </div>
            <div class="modal-body">
                <form name="myForm1" novalidate="novalidate" ng-submit="onSubmit(myForm1.$valid)">

                    <div class="row">
                        <div class="col-md-4 form-group">
                            <label>Name</label>
                            <input type="text" ng-model="formData.name" class="form-control" required />
                        </div>
                        <div class="col-md-4 form-group">
                            <label>Mobile No.</label>
                            <input type="number" ng-model="formData.mobile_no" class="form-control" required />
                        </div>
                        
                        
                    </div>
                    <div class="row">
                        <div class="col-md-3 form-group" ng-if="formData.id > 0">
                            <label>Check In</label>
                           
                            <input type="text" class="form-control" ng-model="formData.check_in" readonly>
                        </div>
                        <div class="col-md-3 form-group">
                            <label>PNR/UID</label>
                            <input type="text" ng-model="formData.pnr_uid" class="form-control" />
                        </div>                        
                        <div class="col-md-3 form-group">
                            <label>Hours</label>
                            <select ng-model="formData.hours_occ" class="form-control" ng-change="changeAmount()" required convert-to-number >
                                <option value="">--select--</option>
                                <option ng-repeat="item in hours" value="@{{item.value}}">@{{ item.label}}</option>
                            </select>
                        </div>
                        <div class="col-md-3 form-group">
                            <label>Pay Type</label>
                            <select ng-model="formData.pay_type" class="form-control" required  convert-to-number>
                                <option value="">--select--</option>
                                <option ng-repeat="item in pay_types" value="@{{item.value}}">@{{ item.label}}</option>
                            </select>
                        </div>
                       
                        <div class="col-md-12 form-group" ng-if="entry_id == 0 && type == 1">
                            <label>Available PODS</label>
                            <br>
                            <span ng-repeat="item in avail_pods">
                               <label> <input type="checkbox" ng-click="insPods(item.id)">&nbsp;@{{item.e_no}}</label> &nbsp;&nbsp;
                            </span>
                        </div>
                        <div class="col-md-3 form-group" ng-if="entry_id != 0 && type == 1">
                            <label>PODS</label>
                            <input type="text" ng-model="formData.e_ids" class="form-control" required readonly />

                        </div>

                        <div class="col-md-12 form-group" ng-if="entry_id == 0 && type == 2">
                            <label>Available Single Suit Cabins</label>
                            <br>
                            <span ng-repeat="item in avail_cabins">
                               <label> <input type="checkbox" ng-click="insCabins(item.id)">&nbsp;@{{item.e_no}}</label> &nbsp;&nbsp;
                            </span>
                        </div>
                        <div class="col-md-3 form-group" ng-if="entry_id != 0 && type == 2">
                            <label>Single Suit Cabins</label>
                            <input type="text" ng-model="formData.e_ids" class="form-control" required readonly />

                        </div>

                        <div class="col-md-12 form-group" ng-if="entry_id == 0 && type == 3">
                            <label>Available Double Beds</label>
                            <br>
                            <span ng-repeat="item in avail_beds">
                               <label> <input type="checkbox" ng-click="insBeds(item.id)">&nbsp;@{{item.e_no}}</label> &nbsp;&nbsp;
                            </span>
                        </div>
                        <div class="col-md-3 form-group" ng-if="entry_id != 0 && type == 3">
                            <label>Double Beds</label>
                            <input type="text" ng-model="formData.e_ids" class="form-control" required readonly />

                        </div>
                        
                        <div class="col-md-3 form-group">
                            <label>Total Amount</label>
                            <input type="number" ng-model="formData.total_amount" class="form-control" readonly />
                        </div>
                       
                        <div class="col-md-3 form-group">
                            <label>Discount Amount</label>
                            <input type="text" ng-model="formData.discount_amount" ng-keyup="disAmount()" class="form-control" />
                        </div>
                        <div class="col-md-3 form-group">
                            <label>Paid Amount</label>
                            <input type="number" ng-model="formData.paid_amount" class="form-control" readonly />
                        </div>                      
                        <div ng-if="entry_id !=0" class="col-md-3 form-group">
                            <label>Balance Amount</label>
                            <input type="number" ng-model="formData.balance_amount" class="form-control" readonly />
                        </div>                        
                        
                        <div class="col-md-12 form-group">
                            <label>Remarks</label>
                            <textarea ng-model="formData.remarks" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="pt-4">
                        <button type="submit" class="btn btn-primary" ng-disabled="loading">
                            <span ng-if="!loading">Submit</span>
                            <span ng-if="loading">Loading...</span>
                        </button> 
                    </div>  
                    
               </form>
            </div>
           
        </div>
    </div>
</div>

<div class="modal fade" id="checkoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="row">
                    <div class="col-md-6">
                        <h5 class="modal-title" id="exampleModalLongTitle">
                            <span ng-if="type == 1">Pods</span>
                            <span ng-if="type == 2">Sigle Suit Babin</span>
                            <span ng-if="type == 3">Double Bed</span>
                        </h5>
                    </div>
                    <div class="col-md-6" style="text-align:right;">
                        <button type="button" class="close" ng-click="hideModal();" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                
            </div>
            <div class="modal-body">
                <form name="myForm" novalidate="novalidate" ng-submit="onCheckOut(myForm.$valid)">
                    <div class="row">
                        <div class="col-md-3 form-group">
                            <label>Name</label>
                            <input type="text" ng-model="formData.name" class="form-control" readonly />
                        </div>
                        <div class="col-md-3 form-group">
                            <label>Mobile No.</label>
                            <input type="number" ng-model="formData.mobile_no" class="form-control" readonly />

                        </div>
                        <div class="col-md-3 form-group">
                            <label>PNR/UID</label>
                            <input type="number" ng-model="formData.pnr_uid" class="form-control" readonly />
                        </div>
                        <div class="col-md-3 form-group">
                            <label>Hours Occ</label>
                            <input type="text"  ng-model="formData.hours_occ" class="form-control" readonly>
                           
                        </div>
                        
                    
                    </div>
                    <div class="row">
                        <div class="col-md-3 form-group">
                            <label>Check In</label>
                           
                            <input type="text" class="form-control" ng-model="formData.check_in" readonly />
                        </div>
                         <div class="col-md-3 form-group">
                            <label>Check Out</label>
                           
                            <input type="text" class="form-control" ng-model="formData.check_out" readonly />
                        </div>

                        <div class="col-md-3 form-group">
                            <label>Hours Late</label>
                            <input type="text"  ng-model="formData.hour" class="form-control" readonly>
                           
                        </div>
                      
                        
                        
                        <div class="col-md-3 form-group" ng-if="entry_id != 0">
                            <label>
                                <span ng-if="type == 1">Pods</span>
                                <span ng-if="type == 2">Sigle Suit Babin</span>
                                <span ng-if="type == 3">Double Bed</span>
                            </label>
                            <input type="text" ng-model="formData.e_ids" class="form-control"  readonly />

                        </div>
                    </div>
                  
                    <div class="row">  
                        
                        
                        <div class="col-md-3 form-group">
                            <label>Pay Type</label>
                            <select ng-model="formData.pay_type" class="form-control"   convert-to-number>
                                <option value="">--select--</option>
                                <option ng-repeat="item in pay_types" value="@{{item.value}}">@{{ item.label}}</option>
                            </select>
                        </div>
                        <div class="col-md-3 form-group">
                            <label>Total Amount</label>
                            <input type="number" ng-model="formData.total_balance" class="form-control" readonly />
                        </div> 

                        <div class="col-md-3 form-group" >
                            <label>Paid Amount</label>
                            <input type="number" ng-model="formData.paid_amount" class="form-control" readonly />
                        </div> 
                        <div class="col-md-3 form-group">
                            <label>Balance Amount</label>
                            <input type="number" ng-model="formData.balance" class="form-control" readonly />
                        </div>                        
                        
                        
                        <div class="col-md-12 form-group">
                            <label>Remarks</label>
                            <textarea ng-model="formData.remarks" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="pt-4">
                        <button type="submit" class="btn btn-primary" ng-disabled="loading">
                            <span ng-if="!loading">Collect</span>
                            <span ng-if="loading">Loading...</span>
                        </button> 
                    </div>  
                    
               </form>
            </div>
           
        </div>
    </div>
</div>



