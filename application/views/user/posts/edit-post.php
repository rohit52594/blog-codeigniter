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

foreach ($POST_DETAILS as $post) {

    $thisId = $post->id;
    $title = $post->title;
    $description = $post->description;
    $category = $post->category;

}

foreach ($COVER_DETAILS as $cover) {

    $imagePath = $cover->file_name;

}
?>

<form action="<?php echo site_url('user/updatePost'); ?>" method="post" enctype = "multipart/form-data">
  <div class="form-group">
    <label for="inputName">Blog title</label>
    <input type="text" id="title" name = "title" class="form-control" required value = "<?php echo $title; ?>">
    <span style = "color: red;" class = "text-error"><?php echo form_error('description'); ?></span>
  </div>
  <div class="form-group">
    <label for="inputDescription">Blog Description</label>
    <textarea class="textarea" name = "description" placeholder="Write your blog description here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" required><?php echo $description; ?></textarea>
    <span style = "color: red;" class = "text-error"><?php echo form_error('description'); ?></span>
  </div>
  <div class="form-group">
    <label for="inputStatus">Category</label>
    <select class="form-control custom-select" name = "category" required>
      <option disabled>Select category</option>
      <?php foreach ($CATEGORIES as $categoryAll) { ?>
          <option value="<?php echo $categoryAll->category; ?>" <?php echo ($category == $categoryAll->category) ? 'selected' : ''; ?>><?php echo $categoryAll->category; ?></option>
      <?php } ?>
    </select>
    <span style = "color: red;" class = "text-error"><?php echo form_error('category'); ?></span>
  </div>
  <div class="form-group">
    <label for="inputClientCompany">Image</label>
    <input type="file" name="coverImage" accept = "images/*" class = "form-control" id="coverImage">
    <span style = "color: red;" class = "text-error"><?php echo isset($error['error']) ? $error['error'] : ''; ?></span>
    <br /><img src="<?php echo base_url() . 'upload/' . $imagePath; ?>" id = "showImage" alt="Cover image" height = "100" width = "150">
  </div>
</div>

<div class="row">
  <div class="col-4">
  </div>
  <div class="col-2">
    <input type="submit" value="Save changes" class="btn btn-success float-right">
  </div>
  <div class="col-2">
    <a href = "<?php echo site_url('user/posts/published-posts'); ?>" class="btn btn-secondary">Cancel</a>
  </div>
  <input type="hidden" name="thisId" value = "<?php echo $thisId; ?>">
</form>
</div>
<script type = "text/javascript">

  var imgObj = document.getElementById('coverImage');

  imgObj.onchange = showImage;

  function showImage() {

      var tmppath = URL.createObjectURL(event.target.files[0]);

      $("#showImage").fadeIn("fast").attr('src',URL.createObjectURL(event.target.files[0]));

  }

</script>