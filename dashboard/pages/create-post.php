<?php 
 if($_SERVER["REQUEST_METHOD"] == 'POST') {
    $PostController = new Controller\Post();
    $_POST['FILE'] = $_FILE;
    var_dump($_POST);
    // $PostController->createPost($_POST);
 }

?>

<div class="mt-5 w-75 mx-auto shadow text-dark">
    <div class="d-flex justify-content-end gap-3 mb-4">
        <a href="" class="btn btn-primary"> <i class="fa fa-eye"></i> View Post Lists</a>
    </div>
    <!-- Form -->
    <form action="<?= SITE_URL ?>dashboard/?page=create-post" class=" rounded-4 bg-light p-4" method="post" enctype="multipart/form-data">
        <form class="row g-3 needs-validation" novalidate>
          <div class="col my-3">
            <label for="validationCustom01" class="form-label">Post Title</label>
            <input type="text" maxlength="80" class="form-control" name="title" id="validationCustom01"  required>
            <div class="valid-feedback">
              Looks good!
            </div>
          </div>
          <div class="col my-3">
            <label for="validationCustom02" class="form-label">Post Content</label>
            <textarea class="tiny-editor" name="content" id="validationCustom02" required></textarea>
            
          </div>
          
          <div class="col my-3">
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
    </form>
</div>
