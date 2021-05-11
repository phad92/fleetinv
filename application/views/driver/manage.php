
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
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Phone</th>
                    <th>Entry By</th>
                    <th>Entry Date</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php foreach($drivers as $record): $count++; ?>
                  <tr>
                    <td><?php echo $count;?></td>
                    <td><?php echo $record->firstname?></td>
                    <td><?php echo $record->lastname?></td>
                    <td><?php echo $record->phone?></td>
                    <td><?php echo $record->entry_by?></td>
                    <td><?php echo $record->entry_date?></td>
                    <td>
                        <a href="<?php echo base_url()?>driver/edit/<?php echo $record->driver_id?>" class="btn btn-sm btn-primary">edit</a>
                        <a href="<?php echo base_url()?>driver/delete/<?php echo $record->driver_id?>" class="btn btn-sm btn-danger">delete</a>
                    </td>
                    
                  </tr>
                  <?php endforeach;?>
                  </tbody>
                  <tfoot>
                  <tr>
                     <th>#</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Phone</th>
                    <th>Entry By</th>
                    <th>Entry Date</th>
                    <th>Action</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>