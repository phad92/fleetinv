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
                        <!-- <hr> -->
                        
                    </div>
                </div>
              <!-- /.card-header -->
            <!-- /.card -->
            </div>
             <!--/.col (left) -->
            <!-- <div class="row"> -->
    <div class="col-md-6">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Reported Defects</h3>
                </div>
                <div class="card-body">
                    <form action="<?php echo base_url()?>workshop/stepfour" method="post">
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Tyres<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="tyres">   
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Steering<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="steering">   
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Engine<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="engine">   
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Suspension<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="suspension">   
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Battery<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="battery">   
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Others<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="others">   
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <input type="hidden" name="vehicle_id" value="<?php echo $vehicle->vehicle_id?>">
                            <button type="submit" class="btn btn-primary float-right">Next Step</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
                        <!-- </div> -->
            <!-- right column -->
          <!-- <div class="col-md-6" id="right-panel">
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title" id="rightPanelTitle">Select a Package</h3>
                </div>
                <div class="card-body">
                <table class="table">
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Choose</th>
                      <th>Package Name</th>
                      <th style="width: 40px">Price</th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
                <div id="summaryTable">
                    <button class="btn btn-primary float-right"> Next Step</button>
                </div>
                </div>
            </div>
          </div> -->
          <!--/.col (right) -->
        <!-- </form> -->
</div>
<!-- /.row -->
        
        

         
          
<script>
$(document).ready(function(){

})

</script>
