<div class="row">
        <?php echo get_flashdata()?>
        <?php get_validation_errors()?>
        <!-- form start -->
            <div class="col-md-6">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title"><?php echo $title ?> (Final)</h3>
                    </div>
                    <div class="card-body">
                        <form action="<?php echo base_url()?>/submitservice" method="post">
                            <div class="form-row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="">Select Technician</label>
                                        <select required name="technician" class="form-control select2" id="technicianselect">
                                            <option value="">Select Technician</option>
                                            <option value="technician1">Technician 1</option>
                                            <option value="technician2">Technician 2</option>
                                            <option value="technician3">Technician 3</option>
                                            <option value="technician4">Technician 4</option>
                                            <option value="technician5">Technician 5</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <button class="btn btn-primary pull-right">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        
                    </div>
                </div>
              <!-- /.card-header -->
            <!-- /.card -->
            </div>
        <!--/.col (left) -->


        <div class="col-md-6" id="right-panel" >
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title" id="rightPanelTitle">Service Summary</h3>
                </div>
                <div class="card-body">
                    <div id="summaryTable">
                        <table class="table table-striped">
                            <tbody>
                                <tr>
                                    <td>Truck No.:</td>
                                    <td class="text-right" id="truck_no"><?php echo $vehicle->vehicle_no?></td>
                                </tr>
                                <tr>
                                    <td>Driver :</td>
                                    <td class="text-right" id="vehicle_cat">2</td>
                                </tr>
                                <tr>
                                    <td>Model Year:</td>
                                    <td class="text-right" id="model_year"><?php echo $vehicle->model_year?></td>
                                </tr>
                                <tr>
                                    <td>Vehicle Category:</td>
                                    <td class="text-right" id="driver_id"><?php echo $vehicle->vehicle_type?></td>
                                </tr>
                                <tr>
                                    <td>Mileage:</td>
                                    <td class="text-right" id="description"><?php echo $mileage?></td>
                                </tr>
                                <tr>
                                    <td>Technician:</td>
                                    <td class="text-right" id="technician"><?php ?></td>
                                </tr>
                            </tbody>
                        </table>
                        <br>
                        <table class="table">
                            <h3 class="card-title" style="margin-bottom: 10px; font-weight: 700; color: #444444;">Service Package</h3>
                            <thead>
                                <tr>
                                    <th>Package Name</th>
                                    <th class='text-right'>Package Price (GHC)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($packages as $p):?>
                                    <tr>
                                        <td><?php echo $p['name']?></td>
                                        <td class="text-right" id="truck_no"><?php echo $p['price']?></td>
                                    </tr>
                                <?php endforeach?>
                            </tbody>
                        </table>
                        <br>
                        <table class="table">
                            <h3 class="card-title" style="margin-bottom: 10px; font-weight: 700; color: #444444;">Report Defects</h3>
                            <thead>
                                <tr>
                                    <th>Report Defect Name</th>
                                    <th class='text-right'>Package Price (GHC)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Tyres</td>
                                    <td class="text-right" id="truck_no"><?php echo $defects['tyres']?></td>
                                </tr>
                                <tr>
                                    <td>Steering</td>
                                    <td class="text-right" id="truck_no"><?php echo $defects['steering']?></td>
                                </tr>
                                <tr>
                                    <td>Engine</td>
                                    <td class="text-right" id="truck_no"><?php echo $defects['engine']?></td>
                                </tr>
                                <tr>
                                    <td>Battery</td>
                                    <td class="text-right" id="truck_no"><?php echo $defects['battery']?></td>
                                </tr>
                                <tr>
                                    <td>Suspension</td>
                                    <td class="text-right" id="truck_no"><?php echo $defects['suspension']?></td>
                                </tr>
                                <tr>
                                    <td>Others</td>
                                    <td class="text-right" id="truck_no"><?php echo $defects['others']?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
        </div>
</div>
<!-- /.row -->
        
        

         
          
<script>
$(document).ready(function(){
    $('#technicianselect').change(function(){
        if($(this).find('option:selected').val()){
            $('#technician').text($(this).find('option:selected').text());
        }else{
            $('#technician').text('');
        }
    })
})
</script>
