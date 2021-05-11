<div class="modal fade" id="requestdetail_<?php echo $request->id?>">
   <div class="modal-dialog">
     <div class="modal-content" style="padding: 15px;">
       <div class="modal-header">
         <h4 class="modal-title"><?php echo $modalTitle;?></h4>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button>
       </div>
        <table class="table">
          <thead>
            <tr>
              <th>Name</th>
              <th class="text-right">Detail</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Request Name</td>
              <td class="text-right"><?php echo $request->request_name?></td>
            </tr>
            <tr>
              <td>Item Name</td>
              <td class="text-right"><?php echo $request->item_name?></td>
            </tr>
            <tr>
              <td>Vendor Name</td>
              <td class="text-right"><?php echo $request->vendor_name?></td>
            </tr>
            <tr>
              <td>Total Quantity</td>
              <td class="text-right"><?php echo $request->total_qty?></td>
            </tr>
            <tr>
              <td>Unit Price</td>
              <td class="text-right"><?php echo $request->unit_price?></td>
            </tr>
            <tr>
              <td>Date Needed</td>
              <td class="text-right"><?php echo $request->date_needed?></td>
            </tr>
            <tr>
              <td>Justification</td>
              <td class="text-right"><?php echo $request->justification?></td>
            </tr>
          </tbody>
        </table>
     <div class="modal-footer">
        <!-- <input type="hidden" value="<?php //echo $item->request_id?>" name="request_id"/> -->
        <button type="button" class="btn btn-default float-right" data-dismiss="modal">Close</button>
        <!-- <button type="submit" class="btn btn-primary">Save changes</button> -->
    </div>
     </div>
     <!-- /.modal-content -->
   </div>
   <!-- /.modal-dialog -->
 </div>