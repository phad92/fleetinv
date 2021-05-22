<form action="<?php echo base_url()?>workshop/stepthree" method="post">
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
                            <strong>Current Mileage </strong>
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="mileage" id='mileage' class="form-control">
                        </div>
                    </div>
                    </div>
                </div>
              <!-- /.card-header -->
            <!-- /.card -->
            </div>
             <!--/.col (left) -->
             
            <!-- right column -->
          <div class="col-md-6" id="right-panel">
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
                    <?php foreach([0,1,2,3,4] as $x):?>
                        <tr>
                        <td><?php echo $x+1?></td>
                        <!-- use package_id in value, using this because am storing in sessions for testing -->
                        <td><input type="checkbox" name='package[]' value="<?php echo 'package'.$x.'_5'.$x?>"></td>
                        <td>
                            Package <?php echo $x?>
                        </td>
                        <td>55</td>
                        </tr>
                    <?php endforeach;?>
                  </tbody>
                </table>
                <div id="summaryTable">
                    <input type="hidden" name="vehicle_id" value="<?php echo $vehicle->vehicle_id?>">
                    <button class="btn btn-primary float-right"> Next Step</button>
                </div>
                </div>
            </div>
          </div>
          <!--/.col (right) -->
        <!-- </form> -->
</div>
        </form>
<!-- /.row -->
        
        

         
          
<script>
$(document).ready(function(){

})

</script>
