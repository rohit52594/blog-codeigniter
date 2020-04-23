<div class="card-body">
<?php
    if ($this->session->flashdata('success')) {
      echo '<div class = "alert alert-success">' . $this->session->flashdata('success') .'</div>';
    }
?>
<?php
  if ($this->session->flashdata('error')) {
    echo '<div class = "alert alert-danger">' . $this->session->flashdata('error') .'</div>';
  }
?>
    <table id="example1" class="table table-bordered table-striped">
      <thead>
      <tr>
        <th>#</th>
        <th>Category</th>
        <th>Title</th>
        <th>Description</th>
        <th>Image</th>
        <th>Likes</th>
        <th>Date published</th>
        <th>Action</th>
      </tr>
      </thead>
      <tbody>
      <?php

      $i = 0;

      foreach ($PUBLISHED_POSTS as $posts) {

        $description = htmlspecialchars($posts->description);

      ?>
        <?php $thisImage = $this->Posts->getCoverDetails($posts->id); 

          foreach ($thisImage as $image) {

            $imagePath = base_url() . 'upload/' . $image->file_name;

          }
        ?>
          <tr>
            <td><?php echo ++$i; ?></td>
            <td><?php echo $posts->category; ?></td>
            <td><?php echo $posts->title; ?></td>
            <td>
                <button type="button" class="btn btn-info description" data-description = "<?php echo $description; ?>" data-toggle="modal" data-target="#view-description">
                  View
                </button>
            </td>
            <td><button type="button" class="btn btn-default imageShow" data-image = "<?php echo $imagePath; ?>" data-toggle="modal" data-target="#view-image"><img src = "<?php echo $imagePath; ?>" alt = "Cover image" height = "50" width = "50"></button></td>
            <td><?php echo $posts->likes; ?></td>
            <td><?php echo $posts->added_date . ' / ' . $posts->added_time; ?></td>
            <td class="project-actions text-right">
              <a class="btn btn-primary btn-sm" target = "_BLANK" href="#">
                  <i class="fas fa-folder">
                  </i>
                  View
              </a>
              <a class="btn btn-info btn-sm" href="<?php echo site_url('user/posts/edit-post/'.$posts->id); ?>">
                  <i class="fas fa-pencil-alt">
                  </i>
                  Edit
              </a>
              <a class="btn btn-danger btn-sm" href="<?php echo site_url('user/unpublish/'.$posts->id); ?>">
                  <i class="fas fa-trash">
                  </i>
                  Unpublish
              </a>
          </td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>

  <div class="modal fade" id="view-description">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Description</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div id = "description-here"></div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="view-image">
    <div class="modal-dialog modal-xs">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Image</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <a href="" id = "modalImageLink" target = "_BLANK"><img src="" id = "modalImage" alt="Cover Image" height = "90%" width = "90%"></a>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <script type = "text/javascript">

      $('.description').on('click', function(e) {

        var description = $(this).data('description');

        $('#description-here').html(description);

      });

      $('.imageShow').on('click', function(e) {

        var image = $(this).data('image');

        $('#modalImage').attr('src', image);

        $('#modalImageLink').attr('href', image);

      });

  </script>