<?php

class Inquiries_m{
//-----------------------------------------------------------
// for registration
    public function get_inquiries(){
        //databae connection
        require('config/db_config.php');
        $query = "SELECT * FROM inquiry ORDER BY c_date DESC";
        $result = mysqli_query($con, $query);

        if (!$result) {
            return array(); // Return an empty array if there's an error or no inquiries found
        }

        $inquiries = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $inquiries[] = $row;
        }

        mysqli_free_result($result);
        return $inquiries;
        $con->close();
    }
//-----------------------------------------------------------
}

?>