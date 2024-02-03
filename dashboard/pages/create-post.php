<?php 
 if($_SERVER["REQUEST_METHOD"] == 'POST') {
    $PostController = new Controller\Post();
    $_POST['FILES'] = $_FILES;
    $result = $PostController->createPost($_POST);
    $isSuccess = $result['status'];
   $result_data = ($isSuccess) ?  $result['data'] : $result['error'];
 }

?>

<div class="mt-5 w-100 px-4 mx-auto text-dark">
    <div class="d-flex justify-content-end gap-3 mb-4">
        <a href="<?= SITE_URL.'dashboard?page=manage-post'?>" class="btn btn-primary"> <i class="fa fa-eye"></i> Manage Post</a>
    </div>
    <!-- Form -->
    <form action="<?= SITE_URL ?>dashboard/?page=create-post" novalidate class="row g-3 needs-validation shadow  rounded-4 bg-light p-4" method="post" enctype="multipart/form-data">
        <?php if(isset($isSuccess)) (!$isSuccess) ? display_message($result_data) : display_message('Post Created Successfully!','success'); ?>
          <div class="col-12 my-3">
            <label for="validationCustom01" class="form-label">Post Title</label>
            <input type="text" maxlength="80" class="form-control" value="<?= (isset($_POST['title']) && !$isSuccess) ? $_POST['title']: ''?>" name="title" id="validationCustom01"  required>
            <div class="valid-feedback">
              Looks good!
            </div>
          </div>
          <div class="col-12 my-3">
            <label for="validationCustom02" class="form-label">Post Content</label>
            <textarea class="form-control tiny-editor" name="content" id="validationCustom02"><?= (isset($_POST['content']) && !$isSuccess) ? $_POST['content']: ''?></textarea>
            
          </div>
          
          <div class="col-12 my-3">
            <label for="validationCustom03" class="form-label">Featured Image</label>
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
         
          <div class="col-12 my-3">
            <button class="btn btn-primary" type="submit">Create Post</button>
          </div>
    </form>
</div>
