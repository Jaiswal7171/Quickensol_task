
<?php include "db.php"; ?>



<!-- Update Admin Code  -->

<?php

if (isset($_POST['update_admin'])) {

    $username = $_POST['username'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $id = intval($_POST['employee_id']);

    // update dta 
    $sql = "UPDATE admin SET username = '$username', email = '$email' , phone = '$phone' WHERE id = $id";


    if ($conn->query($sql) === TRUE) {

        echo "<script>";
        echo "alert('Details Updated Successfully!');";
        echo "window.location.href='./views/index.php';";
        echo "</script>";
    } else {
        echo "Error: " . $conn->error;
    }

}
?>



<!-- update password Code  -->


<?php

if (isset($_POST['update_password'])) {


    $email = $_POST['email'];
    $oldpassword = $_POST['password'];
    $newpassword = $_POST['newpassword'];


    $check_email = "SELECT id, password FROM admin WHERE email = '$email'";
    $result = mysqli_query($conn, $check_email);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        
        $id = $row['id'];
        $hashed_password = $row['password'];


        if (password_verify($oldpassword, $hashed_password)) {

            $new_hashed_password = password_hash($newpassword, PASSWORD_DEFAULT);
            $update_password = "UPDATE admin SET password = '$new_hashed_password' WHERE id = $id";

            if (mysqli_query($conn, $update_password)) {
                echo "<script>";
                echo "alert('Password Updated successfully!');";
                echo "window.location.href='./views/login.php';";
                echo "</script>";
            } else {
                echo "Error: " . mysqli_error($conn);
            }
        } else {
            echo "<script>";
            echo "alert('Old password  not match!');";
            echo "window.history.back();";
            echo "</script>";
        }
    } else {
        echo "<script>";
        echo "alert('Email not found!');";
        echo "window.history.back();";
        echo "</script>";
    }
}
?>
