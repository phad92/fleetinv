<div class="modal fade" id="stockDetail_<?php echo $stockItem->id?>">
   <div class="modal-dialog">
     <div class="modal-content" style="padding: 15px;">
       <div class="modal-header">
         <h4 class="modal-title"><?php echo $modalTitle;?></h4>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button>
       </div>
        <ul class="list-group list-group-unbordered mb-3">
          <li class="list-group-item">
            <b>Total Quantity</b> <a class="float-right"><?php echo $stockItem->stock;?></a>
          </li>
          <li class="list-group-item">
            <b>Stock Issued</b> <a class="float-right"><?php echo $stockItem->stock_issued?></a>
          </li>
          <li class="list-group-item">
            <b>Stock Available</b> <a class="float-right"><?php echo $stockItem->inventory?></a>
          </li>
        </ul>
        <ul class="list-group list-group-unbordered mb-3"  id="issueditems<?php echo $stockItem->id?>">
          <li class="list-group-item d-flex" id="tbl_heading<?php echo $stockItem->id?>" style="border-top: 0;">
            <b class="col-md-2">#</b> 
            <b class="col-md-5">Truck No.</b>  
            <b class="col-md-5">Serial Number</b>
          </li>
        </ul>
     <div class="modal-footer">
        <!-- <input type="hidden" value="<?php //echo $item->request_id?>" name="request_id"/> -->
        <button type="button" class="btn btn-default float-right" data-dismiss="modal">Close</button>
        <!-- <button type="submit" class="btn btn-primary">Save changes</button> -->
    </div>
     </div>
     <!-- /.modal-content -->
   </div>
   <!-- /.modal-dialog -->
 </div>


<script>
  $(document).ready(function(){
    const item_id = `<?php echo $stockItem->id;?>`;
    const uri = `<?php echo base_url()."stockitem/getstocksummary/"?>${item_id}`;
    $(`#stockDetail_${item_id}`).on('shown.bs.modal', function () {
      $.ajax({
        url: uri,
        type: 'GET',
        // data: $('#issueForm').serialize(),
        
        success: function(recordset){
            // $("#apprvFrm").load(window.location.href + " #apprvFrmFooter");
            // $("#apprvTable").load(window.location.href + " #itemsTable");
            // location.reload();
            $(`#tbl_heading${item_id}`).siblings().remove();
            recordset.data.forEach((data, i) => {
              var i = i + 1;
              $(`#issueditems${item_id}`).append(`<li class="list-group-item d-flex">
                  <b class="col-md-2">${i}</b>
                  <span class="col-md-5">${data.vehicle_no}</span> 
                  <span class="col-md-5">${data.serial_no}</span>
                  </li>`)
                });
          },
          error: function(){
            alert("Fail")
          }
        });
        
      $(`#stockDetail_${item_id}`).on('hidden.bs.modal', function () {
          
          
    })
    
  });

})
</script>