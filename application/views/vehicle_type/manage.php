
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
                    <th>Vehicle Type</th>
                    <th>Entry By</th>
                    <th>Entry Date</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php foreach($vehicle_types as $record): $count++; ?>
                  <tr>
                    <td><?php echo $count;?></td>
                    <td><?php echo $record->vehicle_type?></td>
                    <td><?php echo $record->entry_by?></td>
                    <td><?php echo $record->entry_date?></td>
                    <td>
                        <a href="<?php echo base_url()?>/vehicletype/edit/<?php echo $record->vehicle_type_id?>" class="btn btn-sm btn-primary">edit</a>
                        <a href="<?php echo base_url()?>/vehicletype/delete/<?php echo $record->vehicle_type_id?>" class="btn btn-sm btn-danger">delete</a>
                    </td>
                    
                  </tr>
                  <?php endforeach;?>
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>#</th>
                    <th>Vehicle Type</th>
                    <th>Entry By</th>
                    <th>Entry Date</th>
                    <th>Action</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>