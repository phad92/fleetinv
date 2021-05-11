           <?php echo get_flashdata();?>
            <?php get_validation_errors()?>
           <?php if(isset($requestlists)):?>
            <div class="card card-default">
              <div class="card-header">
                <h3 class="card-title"><?php echo $title;?></h3>
              </div>
              <!-- /.card-header -->

              <div class="card-body">
              <form action="post">
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
                  <?php foreach($requestlists as $request): ?>
                  <?php if($request->request_status === $status): $count++;?>
                    <tr>
                      <td><?php echo $count;?></td>
                      <td><?php echo $request->request_name?></td>
                      <td><?php echo $request->item_name?></td>
                      <td><?php echo $request->qty?></td>
                      <td><?php echo $request->remarks?></td>
                      <td><?php echo $request->by?></td>
                      <td><?php echo date('Y-m-d', strtotime($request->entry_date))?></td>
                      <td><button class="btn btn-sm btn-<?php echo assign_color_to_status($statusColors, $request->request_status)?>"><?php echo $request->request_status?></button></td>
                      <td>
                          <a href="<?php echo base_url()?>requestlist/approverequest/<?php echo $request->id?>" class="btn btn-xs btn-info">Request Detail</a>
                      </td>
                      
                    </tr>
                    <?php endif;?>
                  <!-- <?php //$viewParam['request']=$request;  $this->load->view('requestapproval/requestApprovalModal', $viewParam)?> -->
                  <?php endforeach;?>
                  </tbody>
                </table>
                </form>
              </div>
              <!-- /.card-body -->
            </div>
            <?php endif;?>
            

