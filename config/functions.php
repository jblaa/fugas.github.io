<?php

#check if user is logged in
    function check_login($con){
        if(isset($_SESSION['user_id'])){
            $id = $_SESSION['user_id']; //set ID to the session variable
            $query = "select * from users where user_id = '$id' limit 1"; //look for ID in the database
            $result = mysqli_query($con, $query); //set result to the value if found
            if($result && mysqli_num($result) > 0){ //if result has value
                $user_data = mysqli_fetch_assoc($result); //set user data array to result array
                return $user_data; //and send it back
            };
        };
    //header("Location: login.php"); //redirect to login if logged in
    //die; // and kill the code
    }



?>