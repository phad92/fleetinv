
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
         <form style="position: relative;" id="issueForm<?php echo $item->id?>"  action="<?php echo base_url()?>requestlist/reIssueItem/<?php echo $item->id?>" method="post">
            <div class="modal-body" id="re-issueForm<?php echo $item->id?>">
                 <div class="form-row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="vehicle_no">Currently Issued to</label>
                            <input  form="issueForm<?php echo $item->id?>" type="text" class="form-control" <?php echo set_readonly()?> value="<?php echo $item->vehicle_no?>" name="vehicle_no">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="vehicle_no">Re-issue To</label>
                            <select form="issueForm<?php echo $item->id?>" class="form-control select2" name="re_issued_to">
                                <option value="">Select Vehicle</option>
                                <?php foreach($vehicles as $vehicle):?>
                                    <option value="<?php echo $vehicle->vehicle_no?>" <?php //echo selected_option($vehicle->vehicle_no, $item->re_issue_to)?>><?php echo $vehicle->vehicle_no?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="qty">Adjust Quantity</label>
                            <input form="issueForm<?php echo $item->id?>" type="number" id="aj_qty<?php echo $item->id?>" class="form-control" min="0" value="<?php echo $item->qty?>" name="qty">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="remarks">Remarks</label>
                            <textarea form="issueForm<?php echo $item->id?>" name="remarks" class="form-control"><?php echo $item->remarks?></textarea>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <button type="button" id="addBtn<?php echo $item->id?>" class="btn btn-primary btn-sm">Add New</button>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <input type="hidden" form="issueForm<?php echo $item->id?>" value="<?php echo $item->request_id?>" name="request_id"/>
                <input type="hidden" form="issueForm<?php echo $item->id?>" value="issued" name="status"/>
                <button type="button" form="issueForm<?php echo $item->id?>" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" form="issueForm<?php echo $item->id?>" id='issueFormbtn<?php echo $item->id?>'  class="btn btn-primary">Save changes</button>
            </div>
        </form>
     </div>
     <!-- /.modal-content -->
   </div>
   
   <!-- /.modal-dialog -->
 </div>
 

 <script>

 $(document).ready(function(){
     var item_id = `<?php echo $item->id?>`;
     var base_url = `<?php echo base_url()?>`;
     var qty = $('#aj_qty' +item_id).val();
     var count = 0;
    $(`#re-issueModal_${item_id}`).on("shown.bs.modal", function () {
	    $(".form1").remove();
	// console.log(`${base_url}requestlist/getserialno/${item_id}`);
	
        $.ajax({
            url: `${base_url}requestlist/getserialno`,
            type: 'GET',
            data: {item_id},
            success: function(resultset){
                const { message, data } = resultset;
                console.log('hello world');
                if (message == "success") {
                        if(data === true){
                            data.forEach((data, i) => {
                            $(`#re-issueForm${item_id}`)
                                .append(`<div class="form-row form1" id="test${i}">
                                    <div class="col-md-2">
                                        <strong>Serial# </strong>
                                    </div>
                                    <div class="col-md-10">
                                        <div class="form-group">
                                            <input type="text" form="issueForm<?php echo $item->id?>" value="${data}" class="form-control" placeholder="Provide Serial Number" name="serial_no[]";>
                                        </div>
                                    </div>
                                </div>`);
                        
                            });
                        }else{
                            var x = 0;
                            for (var i = 0; i < qty; i++) {
                                    $(`#re-issueForm${item_id}`)
                                        .append(`<div class="form-row form1" id="test${x}">
                                            <div class="col-md-2">
                                                <strong>Serial# </strong>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <input type="text" form="issueForm<?php echo $item->id?>" class="form-control" placeholder="Provide Serial Number" name="serial_no[]";>
                                                </div>
                                            </div>
                                            <div className="col-md-2" ><i class="fa fa-trash text-danger" style="cursor: pointer" id="trash${i} onclick="deleteItem(${i})"></i></div>
                                        </div>`);
                                }
                                x++;
                            }
                }
            },
            error: function(){
                console.log('error');
            }
        })    
    })

    $(`#addBtn${item_id}`).click(() => {
			qty = parseInt(qty) + 1;

			$(`#aj_qty${item_id}`).val(qty);

			$(`#re-issueForm${item_id}`)
				.append(`<div class="form-row form1" id="test">
                <div class="col-md-2">
                    <strong>Serial# </strong>
                </div>
                <div class="col-md-10">
                    <div class="form-group">
                        <input type="text" form="issueForm<?php echo $item->id?>" class="form-control" placeholder="Provide Serial Number" name="serial_no[]";>
                    </div>
                </div>
                </div>`);
		});

    function deleteItem(item_id){
        console.log(item_id)
    }
})

   
 </script>