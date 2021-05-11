
              <a href="<?php echo base_url()?>stockitem/create" style="margin-bottom: 10px" class="btn btn-primary">Add Stock Item</a>
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
                    <th>Item Name</th>
                    <th>Total Stock</th>
                    <th>Stock Issued</th>
                    <th>Inventory</th>
                    <th>Entry By</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php foreach($stockitems as $record): $count++; ?>
                  <tr>
                    <td><?php echo $count;?></td>
                    <td><?php echo $record->item_name?></td>
                    <td><?php echo $record->stock?></td>
                    <td><?php echo $record->stock_issued?></td>
                    <td><?php echo $record->stock - $record->stock_issued?></td>
                    <td><?php echo $record->entry_by?></td>
                    <td>
                        <a href="#stockDetail_<?php echo $record->id?>" data-toggle="modal" class="btn btn-sm btn-info">Detail</a>
                        <a href="<?php echo base_url()?>stockitem/delete/<?php echo $record->id?>" class="btn btn-sm btn-danger">Delete</a> 
                    </td>
                    
                  </tr>
                    <?php $viewParam['request']=$request; 
                          $viewParam['stockItem'] = $record;
                          // $viewParam['stockIssued'] = 
                          $this->load->view('items/modals/detailModal',$viewParam);?> 
                    <?php endforeach;?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>