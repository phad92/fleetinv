
              <a href="<?php echo base_url()?>vendor/create" style="margin-bottom: 10px" class="btn btn-primary">Add New Vendor</a>
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
                    <th>Name</th>
                    <th>Phone Number</th>
                    <th>Email Address</th>
                    <th>Entry By</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php foreach($vendors as $record): $count++; ?>
                  <tr>
                    <td><?php echo $count;?></td>
                    <td><?php echo $record->name?></td>
                    <td><?php echo $record->phone?></td>
                    <td><?php echo $record->email?></td>
                    <td><?php echo $record->entry_by?></td>
                    <td>
                        <a href="<?php echo base_url()?>vendor/edit/<?php echo $record->id?>" class="btn btn-sm btn-primary">edit</a>
                        <a href="<?php echo base_url()?>vendor/delete/<?php echo $record->id?>" class="btn btn-sm btn-danger">delete</a>
                    </td>
                    
                  </tr>
                  <?php endforeach;?>
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Phone Number</th>
                    <th>Email Address</th>
                    <th>Entry By</th>
                    <th>Action</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>