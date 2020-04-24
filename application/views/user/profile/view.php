<?php

  $userDetails = $this->Profile_model->getUserDetails();

  $profileCompletedStats = 100;

  foreach ($userDetails as $key) {

        $education = $key->education;

        $location = $key->location;

        $skills = $key->location;

        $about = $key->location;

        $profilePicture = $key->profile_image;

        if ($education == '') {

          $education = 'Not updated';

          $profileCompletedStats -= 20;

        }

        if ($location == '') {

          $location = 'Not updated';

          $profileCompletedStats -= 20;

        }

        if ($skills == '') {

          $skills = 'Not updated';

          $profileCompletedStats -= 20;

        }

        if ($about == '') {

          $about = 'Not updated';

          $profileCompletedStats -= 20;

        }

        if ($profilePicture == '') {

          $profileCompletedStats -= 20;

        }

  }

?>
<section class="content">
<?php
    if ($this->session->flashdata('success')) {
      echo '<div class = "alert alert-success">' . $this->session->flashdata('success') .'</div>';
    }
?>
<?php
  if ($this->session->flashdata('danger')) {
    echo '<div class = "alert alert-danger">' . $this->session->flashdata('danger') .'</div>';
  }
?>
      <div class="container-fluid">
        <div class="progress mb-3">
            <div class="progress-bar bg-success" role="progressbar" aria-valuenow="<?php echo $profileCompletedStats; ?>" aria-valuemin="0"
                aria-valuemax="100" style="width: 40%">
                <span class=""><?php echo $profileCompletedStats; ?>% Profile updated</span>
            </div>
        </div>
        <br />
        <div class="row">
          <div class="col-md-6">

            <!-- Profile Image -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Stats of <?php echo $this->session->userdata('name'); ?></h3>
              </div>
              <div class="card-body box-profile">
                <div class="text-center">
                  <img style = "cursor: pointer;" class="profile-user-img img-fluid img-circle" title = "Click to update profile picture"
                       src="<?php echo ($profilePicture == '') ? base_url() . 'assets/dummy/dummy-dp.png' : base_url() . 'assets/user-image/' . $profilePicture; ?>" data-toggle = "modal" data-target = "#changeProfile"
                       alt="User profile picture">
                </div>

                <h3 class="profile-username text-center"><?php echo $this->session->userdata('name'); ?></h3>

                <p class="text-muted text-center"><?php echo $this->session->userdata('email'); ?></p>

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Posts</b> <a class="float-right">1,322</a>
                  </li>
                  <li class="list-group-item">
                    <b>Likes</b> <a class="float-right">543</a>
                  </li>
                  <li class="list-group-item">
                    <b>Comments</b> <a class="float-right">13,287</a>
                  </li>
                </ul>

                <a style = "cursor: pointer;" data-toggle = "modal" data-target = "#updateProfile" class="btn btn-primary btn-block"><b>Update profile</b></a>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>


          <div class="col-md-6">
            <!-- About Me Box -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">About <?php echo $this->session->userdata('name'); ?></h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <strong><i class="fas fa-book mr-1"></i> Education</strong>

                <p class="text-muted">
                  <?php echo $education; ?>
                </p>

                <hr>

                <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>

                <p class="text-muted"><?php echo $location; ?></p>

                <hr>

                <strong><i class="fas fa-pencil-alt mr-1"></i> Skills</strong>

                <p class="text-muted">
                  <?php echo $skills; ?>
                </p>

                <hr>

                <strong><i class="far fa-file-alt mr-1"></i> About</strong>

                <p class="text-muted"><?php echo $about; ?></p>
              </div>
              <!-- /.card-body -->
            </div>
        </div>
            <!-- /.card -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>



  <div class="modal fade" id="changeProfile">
    <div class="modal-dialog modal-xs">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Change profile picture</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method = "post" action = "<?php echo site_url('profile/updateDp'); ?>" enctype = "multipart/form-data">
        <div class="modal-body">
          <input type="file" name="profileImage" id="profileImage" class = "form-control"><br />
          <img src = "" id = "showImage">
        </div>
        <div class="modal-footer justify-content-between">
          <button type="submit" id = "" class="btn btn-info" name = "changeButton">Update</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </form>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="updateProfile">
    <div class="modal-dialog modal-xs">
      <div class="modal-content">
        <div class="modal-header">
          <form method = "post" action = "<?php echo site_url('profile/updateProfile'); ?>">
          <h4 class="modal-title">Update profile</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <input type="file" name="profile" id="" class = "form-control">
        </div>
        <div class="modal-footer justify-content-between">
          <button type="submit" class="btn btn-info" name = "changeButton">Update</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </form>
        </div>
      </div>
    </div>
  </div>

<script type = "text/javascript">

  var imgObj = document.getElementById('profileImage');

  imgObj.onchange = showImage;

  function showImage() {

      var tmppath = URL.createObjectURL(event.target.files[0]);

      $("#showImage").fadeIn("fast").attr('src',URL.createObjectURL(event.target.files[0]));

      $('#showImage').attr('height', 70);

      $('#showImage').attr('width', 70);

  }

</script>