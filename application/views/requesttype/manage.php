
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
                    <th>Remarks</th>
                    <th>Entry By</th>
                    <th>Entry Date</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php foreach($requesttypes as $record): $count++; ?>
                  <tr>
                    <td><?php echo $count;?></td>
                    <td><?php echo ucwords($record->request_name)?></td>
                    <td><?php echo $record->remarks?></td>
                    <td><?php echo $record->entry_by?></td>
                    <td><?php echo $record->entry_date?></td>
                    <td>
                        <a href="<?php echo base_url()?>requesttype/edit/<?php echo $record->id?>" class="btn btn-sm btn-primary">edit</a>
                        <a href="<?php echo base_url()?>requesttype/delete/<?php echo $record->id?>" class="btn btn-sm btn-danger">delete</a>
                    </td>
                    
                  </tr>
                  <?php endforeach;?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>