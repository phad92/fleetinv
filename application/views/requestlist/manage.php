
              <a href="<?php echo base_url()?>requestlist/create" class="btn btn-primary" style="margin: 10px 0;">
              New Request List
            </a>
            <div class="card card-primary">
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
                    <th>Request Item</th>
                    <th>Vendor Name</th>
                    <th>Total Quantity</th>
                    <th>Total Amount</th>
                    <th>Unit Price</th>
                    <th>Current Status</th>
                    <th>Date Needed</th>
                    <th>Entry By</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php foreach($requestlists as $record): $count++; ?>
                  <tr>
                    <td><?php echo $count;?></td>
                    <td><?php echo $record->request_name?></td>
                    <td><?php echo $record->item_name?></td>
                    <td><?php echo $record->vendor_name?></td>
                    <td><?php echo $record->total_qty?></td>
                    <td><?php echo $record->unit_price?></td>
                    <td><?php echo (float) $record->total_qty * $record->unit_price?></td>
                    <td class="text-<?php echo assign_color_to_status($statusColors, $record->request_status)?>"><button class="btn btn-xs btn-<?php echo assign_color_to_status($statusColors, $record->request_status)?>"><?php echo $record->request_status?></button></td>
                    <td><?php echo $record->date_needed?></td>
                    <td><?php echo date('Y-m-d', strtotime($record->entry_date))?></td>
                    <td>
                        <a href="<?php echo base_url()?>requestlist/detail/<?php echo $record->id?>" class="btn btn-xs btn-info">Detail</a>
                        <a href="<?php echo base_url()?>requestlist/edit/<?php echo $record->id?>" class="btn btn-xs btn-primary">Edit</a>
                        <a href="<?php echo base_url()?>requestlist/delete/<?php echo $record->id?>" class="btn btn-xs btn-danger">Delete</a>
                    </td>
                    
                  </tr>
                  <?php endforeach;?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>