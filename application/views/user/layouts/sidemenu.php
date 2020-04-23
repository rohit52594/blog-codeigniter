  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <span class="brand-text font-weight-light">Welcome to Blog</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?php echo base_url().'assets/backend/'; ?>dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a style = "cursor: pointer;" class="d-block">Welcome, <?php echo $this->session->userdata('name'); ?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            
          <li class="nav-header">NAVIGATION</li>
            <li class="nav-item has-treeview">
                <a href="<?php echo site_url('user/dashboard'); ?>" class="nav-link active">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                    Dashboard
                    <!-- <i class="right fas fa-angle-left"></i> -->
                </p>
                </a>
            </li>


          <li class="nav-item has-treeview">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-file"></i>
              <p>
                Posts
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>

            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo site_url('user/posts/new-post'); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>New post</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo site_url('user/posts/published-posts'); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Published posts</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo site_url('user/posts/unpublished-posts'); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Unpublished posts</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-file"></i>
              <p>
                Profile
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>

            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo site_url('profile/view'); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Profile</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo site_url('profile/update'); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Update profile</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-file"></i>
              <p>
                Settings
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>

            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo site_url('settings/password'); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Change password</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo site_url('settings/history'); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Login history</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item has-treeview">
                <a href="<?php echo site_url('user/logout'); ?>" class="nav-link active">
                <i class="nav-icon fas fa-power-off"></i>
                <p>
                    Logout
                    <!-- <i class="right fas fa-angle-left"></i> -->
                </p>
                </a>
            </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <?php $selfPage = ($this->uri->segment(3) != '') ? $this->uri->segment(3) : $this->uri->segment(2); ?>
            <?php $selfPage = str_replace('-', ' ', $selfPage); ?>
            <h1 class="m-0 text-dark"><?php echo strtoupper($selfPage); ?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo site_url('user/dashboard'); ?>">Home</a></li>
              <?php if ($this->uri->segment(3)) { ?>
                <li class="breadcrumb-item"><?php echo str_replace('-', ' ', ucwords($this->uri->segment(2))); ?></li>
              <?php } ?>
              <li class="breadcrumb-item active"><?php echo ucwords($selfPage); ?></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->