<?php
$Post = new Model\Post();
$PostLists = $Post->find(['user_id'=>$_SESSION['user']['id']]);
?>
<div class=" my-3 table-responsive">
    <?php
    if(count($PostLists) > 0) {
        $table = <<<TABLE
            <table class='table table-striped' id='datatable'>
                <thead>
                <tr>
                <th>SN</th>
                <th>Title</th>
                <th>Image</th>
                <th>Excerpt</th>
                <th>Posted On</th>
                <th>Last Modified</th>
                <th></th>
                </tr>
                </thead>
                <tbody>
        TABLE;
        $count = 0;
        foreach($PostLists as $post){
            $count++;
            $id = $post['id'];
            $title = $post['title'];
            $content = html_entity_decode($post['content']);
            $excerpt = substr(strip_tags($content),0,20)."...";
            $image = $post['image'];
            $created_at =  date('D M Y @ H:i:s', strtotime($post['created_at']));
            $updated_at = date('D M Y @ H:i:s',strtotime($post['updated_at']));
            $edit_link = SITE_URL."dashboard?page=edit-post&pid=$id";
            $delete_link = SITE_URL."dashboard?page=delete-post&pid=$id";
            $table .= <<<TABLE
                <tr>
                <td>$count</td>
                <td>$title</td>
                <td><img src = '$image' class='rounded-2' style='width:60px;'></td>
                <td>$excerpt</td>
                <td>$created_at</td>
                <td>$updated_at</td>
                <td>
                <a href='$edit_link' class='btn btn-sm btn-primary'><i class='fa fa-edit'></i></a>
                <a href='#' data-bs-toggle="modal" data-bs-target="#modal" class='btn btn-sm btn-danger'><i class='fa fa-trash'></i></a>
                </td>
                </tr>
            TABLE;
        } 
        $table .= "</tbody></table>";
        echo $table;
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
<div class="modal modal-fade" id='modal' tabindex='-1' aria-labelledby='examplemodallabel' aria-hidden="true">
    <div class="modal-dialog">
        <div class='modal-content'>
            <div class="modal-header">
            </div>
            <div class='modal-body'>
                <div class="text-danger"> Are you sure you want to delete this post</div>
            </div>
            <div  class="modal-footer">
                <div  type="button" class="btn-danger btn"
                data-bs-dismiss="modal"
                >
                    no
                </div>
                <div class=" btn btn-primary"
                type="button"
                >
                <a href="<?= SITE_URL."dashboard?page=delete-post&pid=$id"?>"class="text-white">yes</a>
                    
                </div>
            </div>
        </div>
    </div>

</div>

<script>
    window.onload = () => {
        $('#datatable').DataTable({
            responsive:true,
        });
    }
</script>