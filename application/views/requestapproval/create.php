            <button type="button" class="btn btn-primary" data-toggle="modal" style="margin: 10px 0;" data-target="#addRequestListItem">
              Add Item to List
            </button>
           <?php if(!empty($requestitems)):?>
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
                    <th>Item Name</th>
                    <th>Qty</th>
                    <th>Status</th>
                    <th>Entry Date</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php foreach($requestitems as $record): $count++; ?>
                  <tr>
                    <td><?php echo $count;?></td>
                    <td><?php echo $record->vehicle_no?></td>
                    <td><?php echo $record->qty?></td>
                    <td><?php echo $record->status?></td>
                    <td><?php echo $record->entry_date?></td>
                    <td id="actions">
                        <a href="#editRequestListItem_<?php echo $record->id?>" class="btn btn-xs btn-primary item-edit-btn" data-toggle="modal"  style="margin: 10px 0;" >edit</a>
                        <a href="<?php echo base_url()?>requestlistitem/delete/<?php echo $record->id?>?requestId=<?php echo $request->id?>" class="btn btn-xs btn-danger">delete</a>
                    </td>
                    
                  </tr>
                    
                    <?php $viewParam['item']=$record; 
                          $viewParam['vehicles']=$vehicles;
                          $this->load->view('requestlist/editRequestListItemModal',$viewParam)?> 
                  <?php endforeach;?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <?php endif;?>
            
          <?php  $this->load->view('requestlist/addRequestListItemModal', ['vehicles' => $vehicles])?>

<script>

$(document).ready(function(){
  $('tr #actions').on('click', function(){
        var requestId = <?php echo $request->id?>;
            var itemid = $('#itemId').val();
            
                console.log('requestid: ', requestId);
                console.log('listid: ', itemid);
    
  })
})
</script>