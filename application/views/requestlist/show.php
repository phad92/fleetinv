<div class="card card-primary">
  <!-- /.card-header -->
  <div class="card-body">
      <div class="row">
        <div class="col-md-4">
          <label for="">Request Name</label> </br>
          <?php echo $request->request_name?> </br>
          <label for="">Item Name</label> </br>
          <?php echo $request->item_name?></br>
          <label for="">Vendor</label> </br>
          <?php echo !empty($request->supplier_name) ? $request->supplier_name : $request->vendor_name;?></br>

        </div>
        <div class="col-md-4">
          <label for="">Unit Price</label> </br>
          <?php echo $request->unit_price?> </br>
          <label for="">Total Quantity</label></br>
          <?php echo $request->total_qty?>
        </div>
        <div class="col-md-4">
          <label for="">Current Status</label> </br>
          <?php echo $request->request_status?>

        </div>
      </div>

  </div>
  <!-- /.card-body -->
</div>
<div class="row">
  <div class="col-md-12">
    <div class="card card-primary">
      <div class="card-body">
        <table class="table">
          <thead>
            <tr>
              <th style="width: 10px">#</th>
              <th>Request Status</th>
              <th>Quantity</th>
              <th>Entry By</th>
              <th>Entry Date</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($activities as $activity): $count++?>
            <tr>
              <td><?php echo $count;?></td>
              <td><?php echo $activity->request_status?> <?php echo ($request->request_status === $activity->request_status) ?  "<span class='badge badge-secondary'>current</span>" : ''?></td>
              <td><?php echo $activity->qty?></td>
              <td><?php echo $activity->entry_by?></td>
              <td><?php echo $activity->entry_date?></td>
            </tr>
            <?php endforeach;?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>