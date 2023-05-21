<!-- Modal -->
<div class="modal fade" id="customer_add_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form action="" method="post" id="addCustomerForm">
        @csrf
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Customer</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="errMsgContainer mb-3">
                    </div>


                    <div class="form-group row">
                        <label for="name" class="col-md-3">Name</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control"  id="name"  name="name" placeholder="Enter Your Name">
                            <span class="text-danger" id="name"></span>

                        </div>

                    </div>

                    <br/>
                    <div class="form-group row">
                        <label for="mobile" class="col-md-3">Mobile</label>
                        <div class="col-md-9">
                            <input type="number" class="form-control" id="mobile" name="mobile" placeholder="Phone Number">
                            <span class="text-danger" id="mobile"></span>
                        </div>
                    </div>
                    <br/>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary add-customer">Save changes</button>
                </div>
            </div>
        </div>
    </form>
</div>

