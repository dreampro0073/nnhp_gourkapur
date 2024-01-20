<div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="row">
                    <div class="col-md-6">
                        <h5 class="modal-title" id="exampleModalLongTitle">Users</h5>
                    </div>
                    <div class="col-md-6" style="text-align:right;">
                        <button type="button" class="close" ng-click="hideModal();" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                
            </div>
            <div class="modal-body">
                <form name="myForm" novalidate="novalidate" ng-submit="onSubmit(myForm.$valid)">

                    <div class="row">
                        <div class="col-md-4 form-group">
                            <label>Name</label>
                            <input type="text" ng-model="formData.name" class="form-control"  />
                        </div>
                        <div class="col-md-4 form-group">
                            <label>Mobile No.</label>
                            <input type="number" ng-model="formData.mobile" class="form-control"  />
                        </div>

                        <div class="col-md-4 form-group">
                            <label>Email/Username</label>
                            <input type="text" ng-model="formData.email" class="form-control"  />
                        </div>
                    </div>

                    <div class="row" ng-if="user_id == 0">
                        <div class="col-md-4 form-group">
                            <label>Password</label>
                            <input type="password" ng-model="formData.password" class="form-control"  />
                        </div>
                        <div class="col-md-4 form-group">
                            <label>Confirm Password.</label>
                            <input type="password" ng-model="formData.confirm_password" class="form-control"  />
                        </div>
                    </div>
                  
                    <div class="row">
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                    
               </form>
            </div>
           
        </div>
    </div>
</div>
