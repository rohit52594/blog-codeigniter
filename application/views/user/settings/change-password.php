
  <!-- /.login-logo -->
  <div class="card">
  <div class="card-body">
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
    <div class="card-body login-card-body">

        <div class="row">
            <div class="col-3">
            </div>
            <div class="col-6">
            <form action="<?php echo site_url('settings/changePassword'); ?>" method="post">
                <div class="input-group mb-3">
                <input type="password" name = "password" class="form-control" value = "<?php echo set_value('password'); ?>" placeholder="Current Password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                    <span style = "color: red;"><?php echo form_error('password'); ?></span><br />
                <div class="input-group mb-3">
                    <input type="password" name = "new_password" class="form-control" value = "<?php echo set_value('new_password'); ?>" placeholder="New Password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                        <span class="fas fa-unlock"></span>
                        </div>
                    </div>
                </div>
                    <span style = "color: red;"><?php echo form_error('new_password'); ?></span><br />
                    <button type="submit" name = "change" class="btn btn-primary btn-block">Change password</button>
                <!-- /.col -->
                </div>
            </div>
        </div>
        </form>
    </div>
<!-- /.login-box -->