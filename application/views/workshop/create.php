    <div class="row">
            <?php echo get_flashdata()?>
            <?php get_validation_errors()?>
          <!-- left column -->
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title"><?php echo $title ?></h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="<?php echo base_url()?>workshop/steptwo" method="get">
                <div class="card-body">
                    <div class="form-row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="vehicle_no">Select Vehicle</label>
                                <select name="vehicle_id" class="form-control select2" id="vehicle_no">
                                    <option value="">Select Vehicle No.</option>
                                    <?php foreach($vehicles as $vehicle):?>
                                        <option value="<?php echo $vehicle->vehicle_id?>"><?php echo $vehicle->vehicle_no?></option>
                                    <?php endforeach?>
                                    <option value="other">Other</option>
                                </select>

                                <!-- <input type="text" name="request_name" class="form-control" value="" id="request_name" placeholder="Enter Vehicle Type"> -->
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary float-right">Next Step</button>
                            </div>
                        </div>
                        <div class="col-md-6">
                        </div>
                    </div>
                </div>

              </form>
            </div>
            <!-- /.card -->


          </div>

        <div class="col-md-6" id="right-panel" hidden="true">
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title" id="rightPanelTitle">Selected Truck</h3>
                </div>
                <div class="card-body">
                    <div id="summaryTable" hidden="true">
                        <table class="table table-striped">
                            <tbody>
                                <tr>
                                    <td>Truck No.:</td>
                                    <td class="text-right" id="truck_no"></td>
                                </tr>
                                <tr>
                                    <td>Truck Category:</td>
                                    <td class="text-right" id="vehicle_cat"></td>
                                </tr>
                                <tr>
                                    <td>Model Year:</td>
                                    <td class="text-right" id="model_year"></td>
                                </tr>
                                <tr>
                                    <td>Driver ID:</td>
                                    <td class="text-right" id="driver_id"></td>
                                </tr>
                                <tr>
                                    <td>Description.:</td>
                                    <td class="text-right" id="description"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <form hidden="true" action="<?php //echo base_url()?>vehicle/save" method="post" id="newVehicleForm">
                            <div class="text-danger" id="ajxMessages">
                            </div>
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="vehicle_no">Vehicle No.</label>
                                        <input required type="text" name="vehicle_no" class="form-control" id="vehicle_no2" placeholder="Vehicle Number">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="model_year">Model Yar</label>
                                        <input required type="text" name="model_year" class="form-control" id="model_year" placeholder="Model Year">
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6">
                                <div class="form-group">
                                    <label>Driver's ID</label>
                                        <select required name="driver_id" id="driver_id"  class="form-control select2" style="width: 100%;">
                                            <option selected="selected">Alabama</option>
                                            <option>Alaska</option>
                                            <option>California</option>
                                            <option>Delaware</option>
                                            <option>Tennessee</option>
                                            <option>Texas</option>
                                            <option>Washington</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                <div class="form-group">
                                    <label>Vehicle Type</label>
                                        <select required name="vehicle_type_id" id="vehicle_type_id"  class="form-control select2" style="width: 100%;">
                                        <option value="">Select Vehicle Type</option>
                                        <?php foreach($vehicle_types as $v_type):?>
                                                <option value="<?php echo $v_type->vehicle_type_id?>"><?php echo $v_type->vehicle_type;?></option>
                                        <?php endforeach;?>
                                        <option value="0">Other</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea required class="form-control" name="description" id="description" rows="3" placeholder="Enter Discription"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <button type="submit" id="newVehicleBtn" class="btn btn-primary float-right">Add Car</button>
                                    </div>
                                </div>
                            </div>
                        <!-- /.card-body -->
                    </div>
                    <form>
                </div>
            </div>
          </div>
          <!--/.col (left) -->
          
        </div>
        <!-- /.row -->
<script>
$(document).ready(function(){
    var base_url = `<?php echo base_url()?>`;
     $('#vehicle_no').change(function(){
        $('#right-panel').attr('hidden', false);
       var selected = $(this).find('option:selected').val();

       if(selected === 'other'){
           $('#summaryTable').attr('hidden', true); 
           $('#rightPanelTitle').text('Add New Vehicle')
           $('#newVehicleForm').attr('hidden', false) 
        } else{
            $('#rightPanelTitle').text('Selected Truck')
            $('#newVehicleForm').attr('hidden', true)
            // $('#summaryTable').attr('')
            $.ajax({
                url: `${base_url}vehicle/getVehicleajax`,
                type: 'GET',
                data: {selected},
                success: function(resultset){
                    var { message, data } = resultset;
                    
                    if(message === 'success'){
                        console.log('vehicle', data);
                        // $('#summaryTable').attr('hidden', false);
                        $('td#truck_no').text(data.vehicle_no);
                        $('td#model_year').text(data.model_year);
                        $('td#vehicle_cat').text(data.vehicle_type);
                        $('td#driver_id').text(data.driver_id);
                        $('td#description').text(data.description);
                    }
                    $('#summaryTable').is(':hidden') ? $('#summaryTable').attr('hidden', false) 
                    : $('summaryTable').attr('hidden', true);
               },
               error: function(){
                   console.log('failed');
                }
            })
        }
        
    });
    // var selected = document.getElementById('vehicle_no').value;
    
    $('#newVehicleBtn').click(function(e){
        var form = $('#newVehicleForm').serialize();
        e.preventDefault();
        $.ajax({
            url: `${base_url}vehicle/newvehicleajax`,
            type: 'POST',
            data: form,
            success: function(resultset){
                var { message, data } = resultset;
                
                $('#ajxMessages').find('p').remove();
                if(message === 'success'){
                    $('#vehicle_no').append(`<option value="${data.vehicle_id}">${data.vehicle_no}</option>`);
                    $('#vehicle_no').val(data.vehicle_id);
                    
                    $('td#truck_no').text(data.vehicle_no);
                    $('td#model_year').text(data.model_year);
                    $('td#vehicle_cat').text(data.vehicle_type);
                    $('td#driver_id').text(data.driver_id);
                    $('td#description').text(data.description);
                    $('#newVehicleForm').attr('hidden', true);
                    $('#summaryTable').attr('hidden', false)
                }else{
                    $('#ajxMessages').append(data);
                }
                console.log('success => ', data);
                // console.lo
            },
            error: function(e){
                console.log('failed');
            }
        })
    })

})

</script>
