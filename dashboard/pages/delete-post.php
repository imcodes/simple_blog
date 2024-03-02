<?php 
use Model\Post;
if(isset($_GET['pid'])){
  $pid = $_GET['pid'];
  $post = new Post();
  $post_data = $post->delete($pid);

  header("location:".SITE_URL."dashboard/");
}