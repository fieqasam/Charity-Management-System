<?php 
include('db_connect.php');

$recipient = "";

if (isset($_POST['submitContact'])) {

    //list of variables
    $recipient = $_POST['recipient'];
    $name = $_POST['name'];
    $subject = $_POST['subject'];
    $email = $_POST['email'];
    $message = $_POST['message'];
    $date = date('y-m-d h:i:s');         
    //Message
    $sender = $email;
    $htmlContent = '<h2>'.$subject.'</h2>
                    <p><b>Name:'.$message.'</p>
                    <p><b>Email:'.$email.'</p>
                    <p><b>Message:</b> RM '.$message.'</p>';
    //check if there any empty fields
    if (empty($name) || empty($subject) || empty($email)||empty($message) || empty($recipient)) {
        
        ?>
        <div class="alert alert-danger text-center">
        <?php  echo "<script>alert('Fill all the inputs!');</script>"; ?>
        </div>
        <?php
    }
    else {
        if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) 
    {
        echo "<script>alert('Please enter your valid email.');</script>";
    }else {
        $uploadStatus = 1;

        if ( $uploadStatus == 1) {
             // Recipient
             $toEmail = $recipient;

             // Sender
             $from = $email;
             $fromName = 'Charity Management System';
             
             // Subject
             $emailSubject = $subject;
             
             // Message 
            
             $htmlContent = '<h2>Charity Management System Inquiry</h2>
             <p>Name: '.$name.'</p>
             <p>Email: '.$email.'</p>
             <p>Message: '.$message.'</p>';

            // Header for sender info
             $headers = "From: $fromName"." <".$from.">";

                 // Boundary 
                 $semi_rand = md5(time()); 
                 $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x"; 

                   // Boundary 
                   $semi_rand = md5(time()); 
                   $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x"; 
                   
                   // Headers for attachment 
                   $headers .= "\nMIME-Version: 1.0\n" . "Content-Type: multipart/mixed;\n" . " boundary=\"{$mime_boundary}\""; 
                   
                   // Multipart boundary 
                   $messages = "--{$mime_boundary}\n" . "Content-Type: text/html; charset=\"UTF-8\"\n" .
                   "Content-Transfer-Encoding: 7bit\n\n" . $htmlContent . "\n\n"; 
  
  
               $messages .= "--{$mime_boundary}--";
               $returnpath = "-f" . $recipient;
               
                 
               // Send email
              $mail = mail($toEmail, $emailSubject, $messages, $headers, $returnpath);
        }else {
              // Set content-type header for sending HTML email
              $headers .= "\r\n". "MIME-Version: 1.0";
              $headers .= "\r\n". "Content-type:text/html;charset=UTF-8";
              
              // Send email
              $mail = mail($toEmail, $emailSubject, $htmlContent, $headers); 
        }

        //If mail sent
        if ($mail) {
            ?>
            <!-- display a success message if once mail sent sucessfully -->
            <div class="alert alert-success text-center">
            <?php 
             echo "<script type='text/javascript'>alert('Your email have successfully sent!');</script>";
             echo '<style>body{display:none;}</style>';
             echo '<script>window.location.href = "contact.php";</script>';
             ?>
            </div>
            <?php
              $query = "INSERT INTO notifications(senderName, senderEmail, subject, message,  date) VALUES('$name', '$email', '$subject', '$message', '$date' )";
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
        else {
            ?>
            <!-- display an alert message if somehow mail can't be sent -->
            <div class="alert alert-danger text-center">
            <?php  echo "<script>alert('Failed while sending your mail!');</script>"; ?>
            </div>
            <?php
        }
    }
    }

}
mysqli_close($con);
?>