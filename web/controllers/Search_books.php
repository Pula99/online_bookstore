<?php

class Search_books{
//-----------------------------------------------------------
// book deals page
    public function index() {
        require('web/config/db_config.php');
        $categories = array();
        $query = "SELECT * FROM categories";
        $result = mysqli_query($con, $query);

        if($result){
            while ($row = mysqli_fetch_assoc($result)) {
                $categories[] = $row;
            }
            mysqli_free_result($result);
        }
        $con->close();
        include('web/views/search_books.php');
    }
//-----------------------------------------------------------
}

?>
