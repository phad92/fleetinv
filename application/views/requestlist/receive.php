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
                    </div>
                    <div class="card-footer " id="apprvFrmFooter">
                        <!-- <input type="submit" value="Save Changes" name="submit" class="btn btn-primary" /> -->
                        <a href="#requestdetail_<?php echo $request->id?>" data-toggle="modal" class="btn btn-info">View Details</a>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card card-default">
                <form id="apprvFrm" action="<?php echo base_url()?>requestlist/saveReceiveRequest/<?php echo $request->id?>" method="post">
                    <div class="card-body">
                        <div class="form-row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="request_name">Quantity Recieved</label>
                                    <input type="number" class="form-control"  value="<?php echo $request->total_qty?>" name="qty">
                                </div>
                            </div>
                            
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="supplier">Received From</label>
                                     <select name="supplier_id" class="form-control">
                                        <?php foreach($vendors as $vendor): ?>
                                        <option value="<?php echo $vendor->id?>" <?php echo selected_option($vendor->id, $request->vendor_id)?>><?php echo $vendor->name?></option>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="remarks">Remarks</label>
                                    <textarea name="remarks" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer " id="apprvFrmFooter">
                        <input type="hidden" name="request_status" value="received">
                        <input type="submit" value="Receive Items" name="submit" class="btn btn-primary" />
                        <!-- <a href="#requestdetail_<?php echo $request->id?>" data-toggle="modal" class="btn btn-info">View Details</a> -->
                    </div>
                </form>
            </div>
        </div>
       </div>

           <?php //if(!empty($requestitems)):?>
            <!-- <div class="card card-default">
              <div class="card-header">
                <h3 class="card-title"><?php //echo $title;?></h3>
              </div> -->
              <!-- /.card-header -->
              <!-- <div class="card-body">
                <div id="apprvTable"> -->
                    <!-- <table id="itemsTable" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Item Name</th>
                        <th>Qty</th>
                        <th>Status</th>
                        <th>Entry Date</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody> -->
                    <?php //foreach($requestitems as $record): $count++; ?>
                    <!-- <tr>
                        <td><?php //echo $count?></td>
                        <td><?php //echo $record->vehicle_no?></td>
                        <td><?php //echo $record->qty?></td>
                        <td><?php //echo $record->status?></td>
                        <td><?php //echo $record->entry_date?></td>
                        <td id="actions">
                            <a href="#approveItem_<?php //echo $record->id?>" class="btn btn-xs btn-primary" data-toggle="modal"  style="margin: 10px 0;" >Issue Item</a>
                            <!-- <a href="#approveItem_<?php //echo $record->id?>" class="btn btn-xs btn-primary" data-toggle="modal"  style="margin: 10px 0;" >Apply Status</a> -->
                            <!-- <a href="#re-issueModal_<?php //echo $record->id?>" class="btn btn-xs btn-info" data-toggle="modal"  style="margin: 10px 0;" >Re-Issue Item</a> -->
                        <!-- </td> -->
                        
                    <!-- </tr> -->
                        <?php //$viewParam['item']=$record; 
                            //$viewParam['vehicles']=$vehicles;
                            //$viewParam['approvalStatus']=$approvalStatus;
                            //$this->load->view('requestapproval/approveItemModal',$viewParam)?> 
                        <?php //$viewParam['item']=$record; 
                            //$viewParam['vehicles']=$vehicles;
                            //$viewParam['approvalStatus']=$approvalStatus;
                            //$this->load->view('requestapproval/reIssueModal',$viewParam)?> 
                    <?php //endforeach;?>
                    </tbody>
                    </table>
                <!-- </div> -->
                <!-- </form> -->
              <!-- </div> -->
              <!-- /.card-body -->
            <!-- </div> -->
            <?php //endif;?>
            


          <?php //$viewParam['request']=$request; 
                          // $viewParam['issued_qty'] = $issued_qty;
                          //$this->load->view('requestapproval/modals/requestdetailmodal',$viewParam)?> 
          <!--/.col (left) -->

        <script>

// $(document).ready(function(){
//   $('#checkall:checkbox').click(() => {
//     var checked = !$(this).data('checked');
//     $('input:checkbox').prop('checked', checked);
//     $(this).data('checked', checked);
//   })

  
//   $('#apply').click((e)=>{
    
//     const val = [];
//     const requestId = <?php echo $request->id?>;
//     const selectedStatus = $('#selectStatus').val();

//     $('.action:checkbox:checked').each((i) => {
//         var count = i + 1;
//         val[i] = $('#check'+count+':checkbox:checked').val();
//         console.log(val);
//     })
    
//     const selectedItems = val.length > 1 ? val : val[0];
//     console.log(selectedItems);

//     var current_url = <?php //echo current_url()?>
//     $.ajax({
//         url:'<?php echo base_url()?>/requestlist/jqUpdateItemStatus',
//         type: 'POST',
//         data: {requestId, selectedStatus, selectedItems: selectedItems},
//         success: function(data){
//             // $("#apprvFrm").load(window.location.href + " #apprvFrmFooter");
//             // $("#apprvTable").load(window.location.href + " #itemsTable");
//             // console.log('success => ', $('#itemsTable').html());
//             location.reload();
//         },
//         error: function(){
//             console.log("Fail")
//         }
//     });
//     e.preventDefault();

//   })

// })

</script>