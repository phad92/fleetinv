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
              <form action="<?php echo base_url()?>stockitem/save" method="post">
                <div class="card-body">
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="item_name">Item Name</label>
                                <input type="text" name="item_name" class="form-control" value="" id="item_name" placeholder="Enter Item Name">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="brand">Brand</label>
                                <input type="text" name="brand" class="form-control" value="" id="brand" placeholder="Enter Item Name">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea name="description" id="description" class="form-control"></textarea>
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