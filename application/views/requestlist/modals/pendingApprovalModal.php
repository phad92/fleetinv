<div class="modal fade" id="pendingApprovalModal_<?php echo $request->id?>">
   <div class="modal-dialog">
     <div class="modal-content">
       <div class="modal-header">
         <h4 class="modal-title"><?php echo $modalTitle;?></h4>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button>
       </div>
         <form action="<?php echo base_url()?>requestapproval/approvalAction/<?php echo $request->id?>" method="post">
            <div class="modal-body">
                <div class="form-row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="request_name">Request Name</label>
                            <input type="text" disabled name="request_name" value="<?php echo $request->request_name?>" class="form-control" value="" id="request_name" placeholder="Request Name">
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="request_status">Request Status</label>
                            <select name="request_status" id="request_status"  class="form-control" style="width: 100%;">
                                <option  selected="selected">Select Status</option>
                                <?php foreach($approvalStatus as $status):?>
                                    <option value="<?php echo $status?>" <?php echo selected_option($status, $request->request_status)?>><?php echo $status?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="request_remarks">Approval Remarks</label>
                            <textarea name="request_remarks" id="request_remarks" class="form-control"><?php echo $request->approval_remarks?></textarea>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer justify-content-between">
                <!-- <input type="hidden" value="<?php //echo $item->request_id?>" name="request_id"/> -->
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </form>
     </div>
     <!-- /.modal-content -->
   </div>
   <!-- /.modal-dialog -->
 </div>