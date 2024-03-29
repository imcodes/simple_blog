<?php 
use Model\Post;
 if($_SERVER["REQUEST_METHOD"] == 'POST') {
    $PostController = new Controller\Post();
    $_POST['FILES'] = $_FILES;
    $result = $PostController->updatePost($_POST);
    $isSuccess = $result['status'];
   $result_data = ($isSuccess) ?  $result['data'] : $result['error'];
 }

 if(isset($_GET['pid'])){
  $pid = $_GET['pid'];
  $post = new Post();
  $post_data = $post->findById($pid);
  if(!$post_data) {
    $error = 'Post data does not exist';
  }

 }else{
  header('location:dashboard/');
 }

?>

<div class="mt-5 w-100 px-4 mx-auto text-dark">
    <div class="d-flex justify-content-end gap-3 mb-4">
        <a href="<?= SITE_URL.'dashboard?page=manage-post'?>" class="btn btn-primary"> <i class="fa fa-eye"></i> Manage Post</a>
        <a href="<?= SITE_URL.'dashboard?page=create-post'?>" class="btn btn-primary"> <i class="fa fa-plus"></i> Create New Post</a>
    </div>
    <!-- Form -->
    <form action="<?= SITE_URL .'dashboard/?page=edit-post&pid='.$pid ?>" novalidate class="row g-3 needs-validation shadow  rounded-4 bg-light p-4" method="post" enctype="multipart/form-data">
        <?php if(isset($isSuccess)) {echo (!$isSuccess) ? display_message($result_data) : display_message('Post Updated Successfully!','success');} ?>
        <?php if(isset($error)) {echo display_message($error);} ?>
        <input type="hidden" name="id" value='<?= $pid ?>'>
          <div class="col-12 my-3">
            <label for="validationCustom01" class="form-label">Post Title</label>
            <input type="text" maxlength="80" class="form-control" value="<?= (isset($_POST['title']) && !$isSuccess) ? $_POST['title']: $post_data['title']?>" name="title" id="validationCustom01"  required>
            <div class="valid-feedback">
              Looks good!
            </div>
          </div>
          <div class="col-12 my-3">
            <label for="validationCustom02" class="form-label">Post Content</label>
            <textarea class="form-control tiny-editor" name="content" id="validationCustom02"><?= (isset($_POST['content']) && !$isSuccess) ? $_POST['content']: $post_data['content']?></textarea>
            
          </div>
          
          <div class="col-12 col-md-7 my-3">
            <label for="validationCustom03" class="form-label">Upload New Featured Image</label>
            <input type="file"
                class="form-control dropify"
                name="fimage" 
                 required
                data-allowed-file-extensions="jpg png jpeg gif"
                data-allowed-formats="landscape square"
                data-height="400"
                data-errors-position="outside"
                >
            
          </div>
          
          <div class="col-12 col-md-5 my-3">
            <label for="validationCustom03" class="form-label">Current Featured Image</label>
            <img src="<?= $post_data['image'] ?>" class='form-control'>
                   
          </div>
         
          <div class="col-12 my-3">
            <button class="btn btn-primary" type="submit">Update Post</button>
          </div>
    </form>
</div>
