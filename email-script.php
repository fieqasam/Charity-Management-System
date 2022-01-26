<?php 
include('db_connect.php');

if (isset($_POST['submitContact'])) {
    
      //list of variables
      $recipient = $_POST['recipient'];
      $name = $_POST['name'];
      $subject = $_POST['subject'];
      $email = $_POST['email'];
      $message_email = $_POST['message'];
      $date = date('y-m-d h:i:s');   

      $query = "INSERT INTO notifications(senderName, senderEmail, subject, message,  date) VALUES('$name', '$email', '$subject', '$message_email', '$date' )";
      $query_run = mysqli_query($con, $query);
      if ($query_run) {
        ?>
        <div class="alert alert-danger text-center">
        <?php  echo "<script>alert('Success! your message have been record in database.');</script>"; 
        header("Location: contact.php");
        ?>
        </div>
        <?php
      }
      else {
        ?>
        <div class="alert alert-danger text-center">
        <?php echo "<script>alert('Failed to record in database.');</script>"; 
            header("Location: contact.php");
        ?>
        </div>
        <?php 
        }
  }

  mysqli_close($con);
?>