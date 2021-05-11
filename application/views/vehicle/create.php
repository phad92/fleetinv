<div class="row">
          <!-- left column -->
          <div class="col-md-12 col-sm-6">
            <?php echo get_flashdata();?>
            <?php get_validation_errors();?>
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title"><?php echo $title?></h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="<?php echo base_url()?>vehicle/save" method="post">
                <div class="card-body">
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="vehicle_no">Vehicle No.</label>
                                <input type="text" name="vehicle_no" class="form-control" id="vehicle_no" placeholder="Vehicle Number">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="model_year">Model Year</label>
                                <input type="text" name="model_year" class="form-control" id="model_year" placeholder="Model Year">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6">
                         <div class="form-group">
                            <label>Driver's ID</label>
                                <select name="driver_id" id="driver_id"  class="form-control select2" style="width: 100%;">
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
                                <select name="vehicle_type_id" id="vehicle_type_id"  class="form-control select2" style="width: 100%;">
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
                                <textarea class="form-control" name="description" id="description" rows="3" placeholder="Enter Discription"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
            <!-- /.card -->


          </div>
          <!--/.col (left) -->
          
        </div>
        <!-- /.row -->