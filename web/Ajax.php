<?php

if(!isset($_SERVER['HTTP_X_AJAX_REQUEST'])){
    // If the request is not an AJAX request, return an error or do whatever is necessary
    echo "<script>window.location.href = '/online_bookstore/forbidden.html'</script>";
    exit();
}


?>