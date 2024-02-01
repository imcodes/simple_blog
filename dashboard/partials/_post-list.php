<?php
$Post = new Model\Post();
$PostLists = $Post->getAll();
?>
<div class="table-responsive">
    <?php
    if(count($PostLists) > 0) {
        //show table 
    }else{
        //No Post found
        ?>
        <div class="alert alert-warning border-warning w-50 mx-auto mt-4">
            <h3>You have not Created any Post yet</h3>
            <a href="<?= SITE_URL.'dashboard?page=create-post'?>" class="btn btn-primary"><i class="fa fa-plus"></i> Create a Post</a>
        </div>
        <?php
    }
     ?>
</div>