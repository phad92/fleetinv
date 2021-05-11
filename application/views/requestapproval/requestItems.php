       <div class="row">
        <div class="col-md-12">
            <div class="card card-default">
                <form id="apprvFrm" action="<?php echo base_url()?>/requestlist/updateRequestStatus/<?php echo $request->id?>" method="post">
                    <div class="card-body">
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="request_name">Request Name</label>
                                    <input type="text" class="form-control"  <?php echo set_readonly('showitems')?> value="<?php echo $request->request_name?>" name="vehicle_no">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="request_name">Item Name</label>
                                     <select name="request_status" <?php echo set_readonly('showitems')?> class="form-control">
                                        <?php foreach($items as $item): ?>
                                        <option value="<?php echo $item->id?>" <?php echo selected_option($item->id, $request->item_id)?>><?php echo $item->item_name?></option>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                         <div class="col-md-6">
                                <div class="form-group">
                                    <label for="request_status">Update Status</label>
                                    <select name="request_status" class="form-control">
                                        <?php foreach($approvalStatus as $status): ?>
                                        <option value="<?php echo $status?>" <?php echo selected_option($status, $request->request_status)?>><?php echo $status?></option>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="approval_remarks">Remarks</label>
                                <textarea name="approval_remarks" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input type="checkbox" name="applyall" class="form-check-input" id="applyall">
                                    <label class="form-check-label" for="applyall">Apply to All</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer" id="apprvFrmFooter">
                        <input type="submit" value="Save Changes" name="submit" class="btn btn-primary" />
                        <!-- <input type="submit" value="Apply to All" class="btn btn-info" name="apply"> -->
                        <button type="button" class="btn btn-default float-right" <?php echo set_hidden('requestlistItem')?>>
                            <strong>Quantity Issued: </strong> <?php echo $issued_qty?> | 
                            <strong>Quantity Left: </strong> <?php echo $request->total_qty - $request->issued_qty?>
                        </button>
                    </div>
                </form>
            </div>
        </div>
       </div>

           <?php if(!empty($requestitems)):?>
            <div class="card card-default">
              <div class="card-header">
                <h3 class="card-title"><?php echo $title;?></h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <!-- <form id="form" method="post"> -->
                <div class="form-row" style="margin-bottom: 10px">
                    <div class="col-md-2">
                        <select name="apply" id="selectStatus" class="form-control">
                            <option value="">Bulk Action</option>
                            <option value="approved">Approve</option>
                            <option value="denied">Deny</option>
                        </select>
                    </div>
                    <div class="col-md-1">
                        <input type="button" value="Apply" id="apply" class="btn btn-info">
                    </div>
                </div>
                <div id="apprvTable">
                    <table id="itemsTable" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>
                            <div class="form-check" style="margin-top: -1.4em;">
                                <input type="checkbox" name="selector" value='5' class="form-check-input" id="checkall">
                            </div>
                        </th>
                        <th>Item Name</th>
                        <th>Re-issued To</th>
                        <th>Qty</th>
                        <th>Status</th>
                        <th>Entry Date</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($requestitems as $record): $count++; ?>
                    <tr>
                        <td>
                            <div class="form-check">
                                <input type="checkbox" name="selector[]" value="<?php echo $record->id?>" id="check<?php echo $count?>" class="form-check-input action">
                            </div>
                        </td>
                        <td><?php echo $record->vehicle_no?></td>
                        <td><?php echo $record->re_issued_to?></td>
                        <td><?php echo $record->qty?></td>
                        <td><?php echo $record->status?></td>
                        <td><?php echo $record->entry_date?></td>
                        <td id="actions">
                            <a href="#approveItem_<?php echo $record->id?>" class="btn btn-xs btn-primary" data-toggle="modal"  style="margin: 10px 0;" >Apply Status</a>
                            <a href="#re-issueModal_<?php echo $record->id?>" class="btn btn-xs btn-info" data-toggle="modal"  style="margin: 10px 0;" >Re-Issue Item</a>
                            <!-- <a href="<?php echo base_url()?>requestlistitem/delete/<?php echo $record->id?>?requestId=<?php //echo $request->id?>" class="btn btn-xs btn-danger">delete</a> -->
                        </td>
                        
                    </tr>
                        
                        <?php $viewParam['item']=$record; 
                            $viewParam['vehicles']=$vehicles;
                            $viewParam['approvalStatus']=$approvalStatus;
                            $this->load->view('requestapproval/approveItemModal',$viewParam)?> 
                        <?php $viewParam['item']=$record; 
                            $viewParam['vehicles']=$vehicles;
                            $viewParam['approvalStatus']=$approvalStatus;
                            $this->load->view('requestapproval/reIssueModal',$viewParam)?> 
                    <?php endforeach;?>
                    </tbody>
                    </table>
                </div>
                <!-- </form> -->
              </div>
              <!-- /.card-body -->
            </div>
            <?php endif;?>
            
          <?php // $this->load->view('requestlist/addRequestListItemModal', ['vehicles' => $vehicles])?>

<script>

$(document).ready(function(){
  $('#checkall:checkbox').click(() => {
    var checked = !$(this).data('checked');
    $('input:checkbox').prop('checked', checked);
    $(this).data('checked', checked);
  })

  
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