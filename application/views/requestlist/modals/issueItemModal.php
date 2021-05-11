<div class="modal fade" id="issueItem">
   <div class="modal-dialog">
     <div class="modal-content">
       <div class="modal-header">
         <h4 class="modal-title"><?php echo $modalTitle;?></h4>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button>
       </div>
         <form id="issueForm" action="<?php echo base_url()?>requestlist/issueRequestItem" method="post">
            <div class="modal-body" id="assignForm1">
                <div class="form-row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="vehicle_id">Vehicle No</label>
                            <select name="vehicle_id" id="vehicle_id" class="form-control select2">
                                <option value="">Select Vehicle No.</option>
                                <?php foreach($vehicles as $vehicle):?>
                                    <option value="<?php echo $vehicle->vehicle_id?>"><?php echo $vehicle->vehicle_no?></option>
                                <?php endforeach;?>
                                <!-- <option value="other">other</option> -->
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="qty">Quantity</label>
                            <input type="number" min="0" name="qty" class="form-control" value="" id="qty" placeholder="Quantity">
                        </div>
                    </div>
                </div>
                <input type="hidden" name="status" value="<?php //echo $request->request_status;?>">
                <input type="hidden" value="<?php echo $request->id?>" name="request_id">
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" id="submitIssue" class="btn btn-primary">Save changes</button>
            </div>
        </form>
     </div>
     <!-- /.modal-content -->
   </div>
   <!-- /.modal-dialog -->
 </div>

 
 <script>
 $(document).ready(function(){
     $('#qty').change(() => {
         $(".form1").remove();
         
        var qty = $('#qty').val();
        var i = 0;
        // $('#assignForm1').append('<h4>Provide Serial Numbers Below</h4>')
        for(var i=0; i < qty; i++){
               
                $("#assignForm1").append(`<div class="form-row form1" id="test${i}">
                    <div class="col-md-2">
                        <strong>Serial# </strong>
                    </div>
                    <div class="col-md-10">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Provide Serial Number" name="serial_no[]";>
                        </div>
                    </div>
                    </div>`);
                }
            })
            

   

    
 })
 </script>