
        <div class="row">
          <!-- left column -->
          <div class="col-md-12 col-sm-6">
            <?php echo get_flashdata();?>
            <?php echo get_validation_errors();?>
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title"><?php echo $title?></h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form id="itemForms" action="<?php echo base_url()?>requestlist/updateRequestList/<?php echo $request->id?>" method="post">
                <div class="card-body">
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="request_type_id">Request Type</label>
                                 <select name="request_type_id" required id="request_type_id"  class="form-control" style="width: 100%;">
                                    <option value=''>Select Request Type</option>
                                    <?php foreach($requesttypes as $req):?>
                                        <option value="<?php echo $req->id?>" <?php echo selected_option($req->id, $request->request_type_id)?>><?php echo $req->request_name?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="vendor_id">Vendor</label>
                                 <select name="vendor_id" id="" required class="form-control" style="width: 100%;">
                                    <option value="">Select Vendor</option>
                                    <?php foreach($vendors as $vendor):?>
                                        <option value="<?php echo $vendor->id?>" <?php echo selected_option($vendor->id, $request->vendor_id)?>><?php echo $vendor->name?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="item_id">Item Name</label>
                                 <select required name="item_id" required id="item_id"  <?php echo set_readonly('requestlistitem')?> class="form-control select2" style="width: 100%;">
                                    <option  value="">Select Item</option>
                                    <?php foreach($stockitems as $item):?>
                                        <option value="<?php echo $item->id?>" <?php echo selected_option($item->id, $request->item_id)?>><?php echo $item->item_name?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="date_needed">Date Needed</label>
                                <input type="date" required name="date_needed" value="<?php echo $request->date_needed?>" min="<?php echo date('Y-m-d')?>" class="form-control" id="date_needed">
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="unit_price">Unit Price</label>
                                <input type="text" required name="unit_price" value="<?php echo $request->unit_price?>" class="form-control" id="unit_price" placeholder="Unit Price">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="justification">Justification</label>
                                <textarea required name="justification" class="form-control" id="justification"><?php echo $request->justification?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-row" style="border-top: 1px solid #ddd; padding-top: 10px;">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="item_id">Item Name</label>
                                <select name="vehicle_no" id="vehicle_no"  class="form-control select2" style="width: 100%;">
                                    <option value=''>Select Item</option>
                                    <?php foreach($vehicles as $vehicle):?>
                                        <option value="<?php echo $vehicle->vehicle_id?>"><?php echo $vehicle->vehicle_no?></option>
                                    <?php endforeach;?>
                                </select>
                                <span class="text-danger" id="vehicle_error"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for"">&nbsp;</label>
                                <!-- <input type="button" class="btn btn-primary form-control" value="Add Item"> -->
                                <button type="button" class="btn btn-primary align-middle" style="margin-bottom: 10px;display: inherit; " id="addItemBtn">Add Item</button>
                            </div>
                        </div>
                    </div>
                        <div class="form-row">
                            <div class="col-md-12" id="itemTable" hidden>
                                <table id="itemsTable" class="table">
                                    <thead>
                                    <tr>
                                        <th>Vehicle No.</th>
                                        <th>Qty Issued</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                <tbody>
                                    
                                </tbody>
                                </table>
                                <input type="hidden" id="row_count" value="1">
                                <input type="hidden" value="<?php echo $request->id?>" id="request_id">
                                <span id="loading" style="display: none; font-size: 14px; font-weight: 300; font-family: 'Futura,Trebuchet MS',Arial,sans-serif;">
									<img src="<?php echo base_url()?>public/dist/img/loading.gif">
									&nbsp;Loading.....
								</span>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary" id="saveItems">Save</button>
                            </div>
                        </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <!-- <button type="submit" class="btn btn-primary">Submit</button> -->
                </div>
            </div>
        </form>
            <!-- /.card -->


          </div>
          <!--/.col (left) -->
          
        </div>
        <!-- /.row -->

<script>

$(document).ready(function(){
    var base_url = `<?php echo base_url()?>`;
    // var itemsUri = `<?php echo base_url()?>vehicle/getVehicleJson`;
    var i = 0;
    
    var request_id = $('#request_id').val();
    var row_count = document.getElementById('row_count').value;
    document.getElementById('loading').style.display = 'block';
    $.ajax({
        url: `${base_url}requestlistItem/fetchrequestsbyid`,
        data: {request_id},
        type: 'GET',
        success: function(recordset){
            var message = recordset.message;
            var data = recordset.data;
            console.log(data);
            if(message === 'error'){
                alert(data);
            }else{
                $('#itemTable').attr('hidden', false);
                data.forEach((item) => {
                    
                    var tr = `<tr id="row_${row_count}">
                    <td>${item.vehicle_no}</td>
                    <td>
                    <input id="qty${row_count}" type="number" min='0' class="form-control" value="${item.qty}" name="qty[]"/>
                    <input id="vehicle_id${row_count}" type="hidden" class="form-control" value="${item.vehicle_id}" name="vehicle_id[]"/>
                    <input id="vehicle_no${row_count}" type="hidden" class="form-control" value="${item.vehicle_no}" name="vehicle_no[]"/>
                    </td>
                    <td><i class="fa fa-trash text-danger" style="cursor: pointer" onclick=(deleteRow(${row_count})) aria-hidden="true"></i></td>
                    </tr>`;
                    // console.log(item);
                    $('#itemsTable > tbody').append(tr);
                    row_count++;
                })
                
                document.getElementById('vehicle_no').value = '';
                document.getElementById('row_count').value = row_count;
                document.getElementById('loading').style.display = 'none';
                
            }
        },
        error: function(){
            console.log('failed');
        }
    })

    $('#addItemBtn').click(function(){
        var vehicle_no = $('#vehicle_no :selected').text();
        var vehicle_id = $('#vehicle_no :selected').val();
        
        // var row_count = document.getElementById('row_count').value;
        var itemids = $(`input[name='vehicle_id[]']`).map(function () {
                   return this.value; // $(this).val()
               }).get();
            //    console.log($.isNumeric($vehicle_id));
        if(!$.isNumeric(vehicle_id) ||  $.inArray(vehicle_id, itemids) !== -1){
            $('#vehicle_error').text('Please select or change Truck No.').css('font-weight','bold');
        }else{

            $.ajax({
                url: `${base_url}vehicle/getVehicleJson`,
                data: {vehicle_id},
                type: 'GET',
                success: function(recordset){
                    var message = recordset.message;
                    var data = recordset.data;
                    if(message === 'error'){
                        alert('vehicle No. does not exist')
                    }else{
                        var tr = `<tr id="row_${row_count}">
                        <td>${vehicle_no}</td>
                            <td>
                                <input id="qty${row_count}" type="number" min='0' class="form-control" value="1" name="qty[]"/>
                                <input id="vehicle_id${row_count}" type="hidden" class="form-control" value="${vehicle_id}" name="vehicle_id[]"/>
                                <input id="vehicle_no${row_count}" type="hidden" class="form-control" value="${data.vehicle_no}" name="vehicle_no[]"/>
                            </td>
                        <td><i class="fa fa-trash text-danger" style="cursor: pointer" onclick=(deleteRow(${row_count})) aria-hidden="true"></i></td>
                        </tr>`;
                        
                        $('#itemsTable > tbody').append(tr);
                        row_count++;
                        document.getElementById('vehicle_no').value = '';
                        document.getElementById('row_count').value = row_count;
                        
                        document.getElementById('loading').style.display = 'none';
                        document.getElementById('saveItems').style.display = 'block';
                    }
                },
                error: function(){
                    console.log('failed');
                }
            })

        }

        
        i+=1;
    })
    
    
})
function deleteRow(row_no){
    $(`#row_${row_no}`).remove();
}
</script>