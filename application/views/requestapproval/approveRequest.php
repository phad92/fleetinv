       <div class="row">
        <div class="col-md-12">
            <?php echo get_flashdata();?>
            <?php echo get_validation_errors();?>
            <div class="card card-default">
                <form id="apprvFrm" action="<?php echo base_url()?>/requestlist/updaterequestapproval/<?php echo $request->id?>" method="post">
                    <div class="card-body">
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="request_name">Request Name</label>
                                    <input type="text" class="form-control"  <?php echo set_readonly()?> value="<?php echo $request->request_name?>" name="vehicle_no">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="request_name">Item Name</label>
                                     <select name="request_status" <?php echo set_readonly()?> class="form-control">
                                        <?php foreach($stockitems as $item): ?>
                                        <option value="<?php echo $item->id?>" <?php echo selected_option($item->id, $request->item_id)?>><?php echo $item->item_name?></option>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="qty">Total Quantity</label>
                                    <input id="total_qty" type="text" class="form-control" <?php echo set_readonly()?> value="<?php echo $request->total_qty?>" name="qty">
                                </div>
                            </div>
                         <div class="col-md-3">
                                <div class="form-group">
                                    <label for="request_status">Update Status</label>
                                    <select name="request_status" class="form-control">
                                        <?php foreach(['approved', 'denied'] as $status): ?>
                                        <option value="<?php echo $status?>" <?php echo selected_option($status, $request->request_status)?>><?php echo ucfirst($status)?></option>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="remarks">Remarks</label>
                                <textarea name="remarks" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer " id="apprvFrmFooter">
                        <input type="submit" value="Save Changes" name="submit" class="btn btn-primary" />
                        <a href="#requestdetail_<?php echo $request->id?>" data-toggle="modal" class="btn btn-info">View Details</a>
                    </div>
                </form>
            </div>
        </div>
       </div>

           



          <?php $viewParam['request']=$request; 
                          // $viewParam['issued_qty'] = $issued_qty;
                          $this->load->view('requestapproval/modals/requestdetailmodal',$viewParam)?> 
          <!--/.col (left) -->

        <script>

$(document).ready(function(){
 
  
  $('#apply').click((e)=>{
    
    const val = [];
    const requestId = <?php echo $request->id?>;
    const selectedStatus = $('#selectStatus').val();

    $('.action:checkbox:checked').each((i) => {
        var count = i + 1;
        val[i] = $('#check'+count+':checkbox:checked').val();
        console.log(val);
    })
    
    const selectedItems = val.length > 1 ? val : val[0];
    console.log(selectedItems);

    var current_url = <?php //echo current_url()?>
    $.ajax({
        url:'<?php echo base_url()?>/requestlist/jqUpdateItemStatus',
        type: 'POST',
        data: {requestId, selectedStatus, selectedItems: selectedItems},
        success: function(data){
            // $("#apprvFrm").load(window.location.href + " #apprvFrmFooter");
            // $("#apprvTable").load(window.location.href + " #itemsTable");
            // console.log('success => ', $('#itemsTable').html());
            location.reload();
        },
        error: function(){
            console.log("Fail")
        }
    });
    e.preventDefault();

  })

})

</script>