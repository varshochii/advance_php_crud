

<div class="modal fade" id="usermodal" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Adding or updating users</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span>&times;</span>
        </button>
      </div>
       <form id="addform" method="POST" enctype="multipart/form-data">

            <div class="modal-body">

                <div class="form-group">
                    <label>Name:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-dark"><i class="fas fa-user-alt text-light"></i></span>
                        </div>
                        <input type="text" class="form-control" placeholder="Enter your username" autocomplete="off" required id="username" name="username">
                    </div>
                </div>

                <div class="form-group">
                    <label>Email:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-dark"><i class="fas fa-envelope-open text-light"></i></span>
                        </div>
                        <input type="email" class="form-control" placeholder="Enter your email" autocomplete="off" required id="email" name="email">
                    </div>
                </div>

                <div class="form-group">
                    <label>Mobile:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-dark"><i class="fas fa-phone text-light"></i></span>
                        </div>
                        <input type="text" class="form-control" placeholder="Enter your mobile" autocomplete="off" required id="mobile" name="mobile" maxlength="10" minlength="10">
                    </div>
                </div>

                <div class="form-group">
                    <label>Photo:</label>
                    <div class="input-group">
                        <label class="custom-file-label" for="userphoto">Upload photo</label>
                        <input type="file" class="custom-file-input" name="photo" id="userphoto">
                    </div>
                </div>


            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-dark">Submit</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>

                <input type="hidden" name="action" value="adduser">
                <input type="hidden" name="userId" id="userId" value="">
 
            </div>

        </form>
    </div>
  </div>
</div>