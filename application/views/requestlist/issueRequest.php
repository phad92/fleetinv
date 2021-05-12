       <div class="row">
        <div class="col-md-12">
            <?php echo get_flashdata();?>
            <?php get_validation_errors();?>
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
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="request_name">Item Name</label>
                                     <select name="request_status" <?php echo set_readonly()?> class="form-control">
                                        <?php foreach($stockitems as $item): ?>
                                        <option value="<?php echo $item->id?>" <?php echo selected_option($item->id, $request->item_id)?>><?php echo $item->item_name?></option>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="total_qty">Quantity Received</label>
                                    <input type="text" class="form-control"  <?php echo set_readonly()?> value="<?php echo $request->total_qty?>" name="total_qty">
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
       </div>

        <button type="button" class="btn btn-primary" data-toggle="modal" style="margin: 10px 0;" data-target="#issueItem">
          Issue Item
        </button>
            
       <?php if(!empty($requestitems)):?>

        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title"><?php echo $title;?></h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div id="apprvTable">
                <a href="<?php echo base_url()?>requestlist/doneIssueItem/<?php echo $request->item_id . '/'. $request->id?>" class="btn btn-info float-right" style="margin-bottom: 10px;">Done</a>
                <table id="itemsTable" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Vehicle No.</th>
                    <th>Qty Issued</th>
                    <th>Re-issued To</th>
                    <th>Serial No.</th>
                    <th>Status</th>
                    <th>Entry Date</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($requestitems as $record): $count++; ?>
                
                <tr>
                    <td><?php echo $count?></td>
                    <td><?php echo $record->vehicle_no?></td>
                    <td><?php echo $record->qty?></td>
                    <td><?php echo $record->re_issued_to?></td>
                    <td>
                        <?php if(!empty($record->serial_no)):?>
                            <?php echo implode('</br>', unserialize($record->serial_no))?>
                        <?php else: ?>
                            <p>No Serial No.</p>
                        <?php endif?>
                    </td>
                    <td><?php echo $record->status?></td>
                    <td><?php echo $record->entry_date?></td>
                    <td id="actions">
                        <a href="#re-issueModal_<?php echo $record->id?>" class="btn btn-xs btn-info" data-toggle="modal"  style="margin: 10px 0;" >Edit Item</a>
                        <!-- <a href="<?php echo base_url()?>requestlistitem/delete/<?php echo $record->id?>" class="btn btn-xs btn-danger">Remove Item</a> -->
                        <!-- <a href="#approveItem_<?php echo $record->id?>" class="btn btn-xs btn-primary" data-toggle="modal"  style="margin: 10px 0;" >Apply Status</a> -->
                    </td>
                    
                </tr>
                    
                    <?php $viewParam['item']=$record; 
                        $viewParam['vehicles']=$vehicles;
                        $viewParam['approvalStatus']=$approvalStatus;
                        $this->load->view('requestlist/modals/reIssueModal',$viewParam)?> 
                <?php endforeach;?>
                </tbody>
                </table>
            </div>
            <!-- </form> -->
          </div>
          <!-- /.card-body -->
        </div>
    <?php endif;?>
            
       <?php  $this->load->view('requestlist/modals/issueItemModal', ['vehicles' => $vehicles])?>

    <?php //$viewParam['request']=$request; 
          //$this->load->view('requestapproval/modals/requestdetailmodal',$viewParam)?> 
    <!--/.col (left) -->
