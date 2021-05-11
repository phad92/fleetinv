<div class="modal fade" id="editRequestListItem_<?php echo $item->id?>">
   <div class="modal-dialog">
     <div class="modal-content">
       <div class="modal-header">
         <h4 class="modal-title"><?php echo $modalTitle;?></h4>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button>
       </div>
         <form id="approveItemForm" action="<?php echo base_url()?>requestlistitem/update/<?php echo $item->id?>" method="post">
            <div class="modal-body">
                 <div class="form-row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="vehicle_id">Vehicle No</label>
                            <select name="vehicle_id" <?php echo set_readonly('requestlistitem')?> id="vehicle_no1" class="form-control select2">
                                <option value="">Select Vehicle No.</option>
                                <?php foreach($vehicles as $vehicle):?>
                                    <option value="<?php echo $vehicle->vehicle_id?>" <?php echo selected_option($vehicle->vehicle_id, $item->vehicle_id)?>><?php echo $vehicle->vehicle_no?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="re_assigned_to">Re-assign To</label>
                            <select class="form-control select2" name="re_assigned_to">
                                <option value="">Select Vehicle</option>
                                <?php foreach($vehicles as $vehicle):?>
                                    <option value="<?php echo $vehicle->vehicle_no?>" <?php echo selected_option($vehicle->vehicle_no, $item->re_assigned_to)?>><?php echo $vehicle->vehicle_no?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="qty">Quantity</label>
                            <input type="number" min='0' name="qty" value="<?php echo $item->qty?>" class="form-control" id="qty" placeholder="Quantity">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="remarks">Remarks</label>
                            <textarea name="remarks" class="form-control"><?php echo $item->remarks?></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <input type="hidden" value="<?php echo $item->request_id?>" name="request_id"/>
                <input type="hidden" value="<?php echo $item->id?>" name="item_id"/>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </form>
     </div>
     <!-- /.modal-content -->
   </div>
   <!-- /.modal-dialog -->
 </div>