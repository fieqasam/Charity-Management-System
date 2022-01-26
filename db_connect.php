<?php

try{
    //connect variable
    $con = new mysqli("localhost:3308","root","","charity");

    //encode language
    mysqli_set_charset($con, 'utf8');

}catch(Exception $ex){

    print "An Exception occured. Message: ".$ex->getMessage();
} catch(Error $e){
    print "The system is busy please try later";
}
?>