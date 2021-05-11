<div class="modal fade" id="addRequestListItem">
   <div class="modal-dialog">
     <div class="modal-content">
       <div class="modal-header">
         <h4 class="modal-title"><?php echo $modalTitle;?></h4>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button>
       </div>
         <form id="modalForm" action="<?php echo base_url()?>requestlistitem/save" method="post">
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
                <input type="hidden" value="<?php echo $request->id?>" name="request_id">
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </form>
     </div>
     <!-- /.modal-content -->
   </div>
   <!-- /.modal-dialog -->
 </div>
