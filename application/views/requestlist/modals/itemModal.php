
<!-- RE-ISSUED ITEM MODAL BEGIN-->
<div class="modal fade" id="itemModal">
   <div class="modal-dialog">
     <div class="modal-content">
       <div class="modal-header">
         <h4 class="modal-title"><?php echo 'Re-issue Item';?></h4>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button>
       </div>
         <form style="position: relative;" id="itemForm"  action="<?php echo base_url()?>requestlistitem/addvehicle/" method="post">
            <div class="modal-body" id="itemForm">
                 <div class="form-row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="vehicle_no">Vehicle No.</label>
                            <select form="itemForm" class="form-control select2" name="vehicle_id">
                                <option value="">Select Vehicle</option>
                                <?php foreach($vehicles as $vehicle):?>
                                    <option value="<?php echo $vehicle->vehicle_no?>" <?php //echo selected_option($vehicle->vehicle_no, $item->re_issue_to)?>><?php echo $vehicle->vehicle_no?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="qty">Quantity</label>
                            <input form="itemForm" type="number" id="qty" class="form-control" min="0" value="" name="qty">
                        </div>
                    </div>
                </div>
                
            </div>
            <div class="modal-footer justify-content-between">
                <input type="hidden" form="itemForm" value="issued" name="status"/>
                <button type="button" form="itemForm" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" form="itemForm" id='itemFormBtn'  class="btn btn-primary">Save changes</button>
            </div>
        </form>
     </div>
     <!-- /.modal-content -->
   </div>
   
   <!-- /.modal-dialog -->
 </div>
 

 <script>
//  $(document).ready(function(){
//     var endpoint = `<?php echo base_url()?>/requestlistitem/`;

//     $(`#itemFormBtn`).click(function(){
//         $(`#itemForm`).serialize();
//         console.log($(`#itemForm`).serialize());
//         $.ajax({
//             url: endpoint,
//             data: $('#itemForm').serialize
//         })
//     })
//     // $(`#itemModal`).on('shown.bs.modal', function () {

//     // });
//  })
 </script>