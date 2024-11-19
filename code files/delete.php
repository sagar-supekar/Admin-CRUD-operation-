<?php

include("connection.php");

if(isset($_GET["id"]))
{
    $id = $_GET["id"];
   
    $query="delete from VoterRegistrationTable where id='$id'";

    $result = mysqli_query($link,$query);

    if(!$result)
    {
          die("connection failed");
    }
    else
    {
        header("Location: admin_home.php?delete_message=" . urlencode('One row deleted successfully'));
    }
}
?>