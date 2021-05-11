           <?php echo get_flashdata();?>
            <?php get_validation_errors()?>
           <button type="button" class="btn btn-primary" data-toggle="modal" style="margin: 10px 0;" data-target="#addRequestListItem">
              Add Item to List
            </button>
           <?php if(isset($requestlists)):?>
            <div class="card card-default">
              <div class="card-header">
                <h3 class="card-title"><?php echo $title;?></h3>
              </div>
              <!-- /.card-header -->

              <div class="card-body">
              <form action="post">
              <div class="form-row" style="margin-bottom: 10px">
                <div class="col-md-2">
                    <select name="apply" id="appy" class="form-control">
                        <option value="">Action</option>
                        <option value="approve">Approve</option>
                        <option value="deny">Deny</option>
                    </select>
                </div>
                <div class="col-md-1">
                    <input type="button" value="Apply" id="apply" class="btn btn-info">
                </div>
              </div>
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th>Request Name</th>
                    <th>Item Name</th>
                    <th>Total Quantity</th>
                    <th>Remarks</th>
                    <th>Approved By</th>
                    <th>Date Approved</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php foreach($requestlists as $request): $count++; ?>
                  <tr>
                    <td><?php echo $count;?></td>
                    <td><?php echo $request->request_name?></td>
                    <td><?php echo $request->item_name?></td>
                    <td><?php echo $request->total_qty?></td>
                    <td><?php echo $request->approval_remarks?></td>
                    <td><?php echo $request->approved_by?></td>
                    <td><?php echo date('Y-m-d', strtotime($request->date_approved))?></td>
                    <td><button class="btn btn-sm btn-<?php echo assign_color_to_status($statusColors, $request->request_status)?>"><?php echo $request->request_status?></button></td>
                    <td>
                        <?php switch($status): 
                          case 'pending_approval':?>
                              <a href="<?php echo base_url()?>requestlist/detail/<?php echo $request->id?>" class="btn btn-xs btn-info">Detail</a>
                              <a href="<?php echo base_url()?>requestlist/requestaction?action=approved&request_id=<?php echo $request->id?>" class="btn btn-xs btn-primary">Approve</a>
                              <a href="<?php echo base_url()?>requestlist/requestaction?action=denied&request_id=<?php echo $request->id?>" class="btn btn-xs btn-danger">Deny</a>
        
                          <?php break;
                          case 'awaiting_receive':?>

                          <?php break;
                          case'received':?>

                          <?php break;
                          case'pending_issue':?>

                          <?php break;?>
                          <?php endswitch;?>
                        <!-- <a href="<?php echo base_url()?>requestlist/showitems/<?php echo $request->id?>" class="btn btn-xs btn-primary">View List Items</a> -->
                        <!-- <a href="<?php echo base_url()?>requestlistitem/manage?requestId=<?php echo $request->id?>" class="btn btn-xs btn-default">View Items</a> -->
                    </td>
                    
                  </tr>
                  <?php $viewParam['request']=$request;  $this->load->view('requestapproval/requestApprovalModal', $viewParam)?>
                  <?php endforeach;?>
                  </tbody>
                </table>
                </form>
              </div>
              <!-- /.card-body -->
            </div>
            <?php endif;?>
            

