
<!-- RE-ISSUED ITEM MODAL BEGIN-->
<div class="modal fade" id="re-issueModal_<?php echo $item->id?>">
   <div class="modal-dialog">
     <div class="modal-content">
       <div class="modal-header">
         <h4 class="modal-title"><?php echo 'Re-issue Item';?></h4>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button>
       </div>
         <form id="reIssueForm<?php echo $item->id?>" action="<?php echo base_url()?>requestlist/reIssueItem/<?php echo $item->id?>" method="post">
            <div class="modal-body">
                 <div class="form-row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="vehicle_no">Currently Issued to</label>
                            <input type="text" class="form-control" <?php echo set_readonly('showitems')?> value="<?php echo $item->vehicle_no?>" name="vehicle_no">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="re_issued_to">Re-issue To</label>
                            <select form="reIssueForm<?php echo $item->id?>" class="form-control select2" name="re_issued_to">
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
                            <label for="qty">Adjust Quantity</label>
                            <input form="reIssueForm<?php echo $item->id?>" type="number" class="form-control" min="0" value="<?php echo $item->qty?>" name="qty">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select form="reIssueForm<?php echo $item->id?>" name="status" class="form-control">

                                <?php foreach($approvalStatus as $status): ?>
                                <option value="<?php echo $status?>" <?php echo selected_option($status, $item->status)?>><?php echo $status?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="remarks">Remarks</label>
                            <textarea name="remarks" class="form-control"><?php echo $item->remarks?></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <input type="hidden" value="<?php echo $item->request_id?>" name="request_id"/>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </form>
     </div>
     <!-- /.modal-content -->
   </div>
   <!-- /.modal-dialog -->
 </div>
 