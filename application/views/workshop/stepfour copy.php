<div class="row">
        <?php echo get_flashdata()?>
        <?php get_validation_errors()?>
        <!-- form start -->
            <div class="col-md-6">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title"><?php echo $title ?></h3>
                    </div>
                    <div class="card-body">
                        <div>
                            <div class="row" style="margin: 10px 0">
                                <div class="col-md-4">
                                    <strong>Truck Number </strong>
                                </div>
                                <div class="col-md-6">
                                    <?php echo $vehicle->vehicle_no?>
                                </div>
                            </div>
                            <div class="row" style="margin: 10px 0">
                                <div class="col-md-4">
                                    <strong> Driver </strong>
                                </div>
                                <div class="col-md-6">
                                    <?php echo $vehicle->driver_id?>
                                </div>
                            </div>
                            <div class="row" style="margin: 10px 0">
                                <div class="col-md-4">
                                    <strong>Model Year </strong>
                                </div>
                                <div class="col-md-6">
                                    <?php echo $vehicle->model_year?>
                                </div>
                            </div>
                            <div class="row" style="margin: 10px 0">
                                <div class="col-md-4">
                                    <strong>Vehicle Category </strong>
                                </div>
                                <div class="col-md-6">
                                    <?php echo $vehicle->vehicle_type?>
                                </div>
                            </div>
                            <div class="row" style="margin: 10px 0">
                                <div class="col-md-4">
                                    <strong>Mileage (Km) </strong>
                                </div>
                                <div class="col-md-6">
                                    <?php echo $mileage?>
                                </div>
                            </div>
                            <div class="row" style="margin: 10px 0">
                                <div class="col-md-4">
                                    <strong>Service Package(s) </strong>
                                </div>
                                <div class="col-md-6">
                                    <?php echo $packages?>
                                </div>
                            </div>
                        </div>
                        <hr>

                        <form action="" method="post">
                            <div class="form-row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="">Select Technician</label>
                                        <select name="technician" class="form-control select2" id="">
                                            <option value="">Select Technicial</option>
                                            <option value="technician1">Technician 1</option>
                                            <option value="technician2">Technician 2</option>
                                            <option value="technician3">Technician 3</option>
                                            <option value="technician4">Technician 4</option>
                                            <option value="technician5">Technician 5</option>

                                        </select>
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
                                <tr>
                                    <td>Truck No.:</td>
                                    <td class="text-right" id="truck_no"><?php echo $vehicle->vehicle_no?></td>
                                </tr>
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
                                    <td></td>
                                    <td class="text-right" id="truck_no"><?php echo $vehicle->vehicle_no?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
        </div>
</div>
<!-- /.row -->
        
        

         
          
<script>

</script>
