<div class="modal fade" id="approveItem_<?php echo $item->id?>">
   <div class="modal-dialog">
     <div class="modal-content">
       <div class="modal-header">
         <h4 class="modal-title"><?php echo $modalTitle;?></h4>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button>
       </div>
         <form action="<?php echo base_url()?>requestlist/updateItemStatus/<?php echo $item->id?>" method="post">
            <div class="modal-body">
                 <div class="form-row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="vehicle_no">Vehicle No</label>
                            <input type="text" class="form-control" <?php echo set_readonly('showitems')?> value="<?php echo $item->vehicle_no?>" name="vehicle_no">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="status">Update Status</label>
                            <select name="status" class="form-control">

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

                <button type="button" class="btn btn-default float-right" <?php echo set_hidden('requestlistItem')?>>
                    <strong>Quantity Issued: </strong> <?php echo $request->issued_qty?> | 
                    <strong>Quantity Left: </strong> <?php echo $request->total_qty - $request->issued_qty?>
                </button>
            </div>
        </form>
     </div>
     <!-- /.modal-content -->
   </div>
   <!-- /.modal-dialog -->
 </div>
 