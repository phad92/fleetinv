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
              <form action="<?php echo base_url()?>requesttype/save" method="post">
                <div class="card-body">
                   <div class="col-md-6">
                            <div class="form-group">
                                <label for="request_name">Request Name</label>
                                <input type="text" name="request_name" class="form-control" value="<?php echo $requesttype->request_name?>" id="request_name" placeholder="Enter Vehicle Type">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="remarks">Remarks</label>
                                <textarea name="remarks" class="form-control"><?php echo $requesttype->remarks?></textarea>
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