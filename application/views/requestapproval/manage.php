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
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th>Request Name</th>
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
                    <td><?php echo $request->approval_remarks?></td>
                    <td><?php echo $request->approved_by?></td>
                    <td><?php echo date('Y-m-d', strtotime($request->date_approved))?></td>
                    <td><button class="btn btn-sm btn-<?php echo assign_color_to_status($statusColors, $request->request_status)?>"><?php echo $request->request_status?></button></td>
                    <td>
                        <a href="#requestApprovalModal_<?php echo $request->id?>" class="btn btn-xs btn-primary item-edit-btn" data-toggle="modal"  style="margin: 10px 0;">Update Status</a>
                        <a href="<?php echo base_url()?>requestlist/edit/<?php echo $request->id?>" class="btn btn-xs btn-info">Edit Request</a>
                        <a href="<?php echo base_url()?>requestlistitem/manage?requestId=<?php echo $request->id?>" class="btn btn-xs btn-default">View Items</a>
                    </td>
                    
                  </tr>
                  <?php $viewParam['request']=$request;  $this->load->view('requestapproval/requestApprovalModal', $viewParam)?>
                  <?php endforeach;?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <?php endif;?>
            

