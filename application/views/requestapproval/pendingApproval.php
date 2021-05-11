
<!-- <a href="<?php echo base_url()?>requestlist/create" class="btn btn-primary" style="margin: 10px 0;">
  New Request List
</a> -->
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
        <th>Status</th>
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
        <td><?php echo $record->total_qty * $record->unit_price?></td>
        <td><button class="btn btn-sm btn-<?php echo assign_color_to_status($statusColors, $record->request_status)?>"><?php echo $record->request_status?></button></td>
        <td>
           <!-- detail will be a modal -->
            <a href="<?php echo base_url()?>requestlist/detail/<?php echo $record->id?>" class="btn btn-xs btn-info">Detail</a>
            <a href="<?php echo base_url()?>requestlist/requestaction?action=approved&request_id=<?php echo $record->id?>" class="btn btn-xs btn-primary">Approve</a>
            <a href="<?php echo base_url()?>requestlist/requestaction?action=denied&request_id=<?php echo $record->id?>" class="btn btn-xs btn-danger">Deny</a>
        </td>
        
      </tr>
      <?php endforeach;?>
      </tbody>
    </table>
  </div>
  <!-- /.card-body -->
</div>

