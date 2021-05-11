
             <a href="<?php echo base_url()?>vehicle/create" style="margin-bottom: 10px" class="btn btn-primary">Add New Vendor</a>

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
                    <th>Vehicle Number</th>
                    <th>Driver</th>
                    <th>Model Year</th>
                    <th>Vehicle Type</th>
                    <th>Description</th>
                    <th>Entry By</th>
                    <th>Entry Date</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php foreach($vehicles as $record): $count++; ?>
                  <tr>
                    <td><?php echo $count;?></td>
                    <td><?php echo $record->vehicle_no?></td>
                    <td><?php echo $record->driver_name?></td>
                    <td><?php echo $record->model_year?></td>
                    <td><?php echo $record->vehicle_type?></td>
                    <td><?php echo $record->description?></td>
                    <td><?php echo $record->entry_by?></td>
                    <td><?php echo $record->entry_date; ?></td>
                    <td>
                        <a href="<?php echo base_url()?>vehicle/edit/<?php echo $record->vehicle_id?>" class="btn btn-sm btn-primary">edit</a>
                        <a href="<?php echo base_url()?>vehicle/delete/<?php echo $record->vehicle_id?>" class="btn btn-sm btn-danger">delete</a>
                    </td>
                    
                  </tr>
                  <?php endforeach;?>
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>#</th>
                    <th>Vehicle Number</th>
                    <th>Driver</th>
                    <th>Model Year</th>
                    <th>Vehicle Type</th>
                    <th>Description</th>
                    <th>Entry By</th>
                    <th>Entry Date</th>
                    <th>Action</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>