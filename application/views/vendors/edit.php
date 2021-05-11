    <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <?php echo get_flashdata()?>
            <?php echo get_validation_errors()?>
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title"><?php echo $title ?></h3>
              </div>
              
              <!-- /.card-header -->
              <!-- form start -->
              <form action="<?php echo base_url()?>vendor/update/<?php echo $vendor->id?>" method="post">
                <div class="card-body">
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Vendor Name</label>
                                <input type="text" name="name" class="form-control" value="<?php echo $vendor->name?>" id="name" placeholder="Enter Vendor Name">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="phone">Phone Number</label>
                                <input type="text" name="phone" class="form-control" value="<?php echo $vendor->phone?>" id="phone" placeholder="Enter Phone Number">
                                <!-- <span id="exampleInputPassword1-error" class="error invalid-feedback"><?php //echo form_error('phone')?></span> -->
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">Email Address</label>
                                <input type="email" name="email" class="form-control" value="<?php echo $vendor->email?>" id="email" placeholder="Enter Email">
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