<?php session_start();?>
<?php include "db.php"; ?>

<!---------------------------------------------------------------------------------------Admin Register Code  ------------------------------------------------------------------------------------------- -->

<?php

if (isset($_POST['register_admin'])) {

    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);

    // Check email
    $check_email = "SELECT id FROM admin WHERE email = '$email'";
    $result_email = mysqli_query($conn, $check_email);

    // Check username
    $check_username = "SELECT id FROM admin WHERE username = '$username'";
    $result_username = mysqli_query($conn, $check_username);

    // Check  phone 
    $check_phone = "SELECT id FROM admin WHERE phone = '$phone'";
    $result_phone = mysqli_query($conn, $check_phone);

    if (mysqli_num_rows($result_email) > 0) {
        echo "<script>";
        echo "alert('Email already exists !! Please use a different email.');";
        echo "window.history.back();";
        echo "</script>";

    } elseif (mysqli_num_rows($result_username) > 0) {
        echo "<script>";
        echo "alert('Username already exists! Please use a different username.');";
        echo "window.history.back();";
        echo "</script>";

    } elseif (mysqli_num_rows($result_phone) > 0) {
        echo "<script>";
        echo "alert('Phone number already exists! Please use a different phone number.');";
        echo "window.history.back();";
        echo "</script>";

    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Insert new admin
        $insert_query = "INSERT INTO admin (username, email, password, phone) VALUES ('$username', '$email', '$hashed_password', '$phone')";
        if (mysqli_query($conn, $insert_query)) {
            echo "<script>";
            echo "alert('Admin Registered Successfully!');";
            echo "window.location.href='./views/login.php';";
            echo "</script>";
        } else {
            echo "Error executing query.";
        }
    }
}

?>



<!---------------------------------------------------------------------------Admin Login Code -----------------------------------------------------------------------------------------------  -->
<?php

if (isset($_POST['login_admin'])) {

    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);


    $query = "SELECT * FROM admin WHERE email = '$email'";
    $result = mysqli_query($conn, $query);

    if ($result) {

        if (mysqli_num_rows($result) == 1) {
            $admin = mysqli_fetch_assoc($result);
            $hashed_password = $admin['password'];

            if (password_verify($password, $hashed_password)) {
                $_SESSION['admin_id'] = $admin['id'];
                $_SESSION['admin_data'] = $admin;

                echo "<script>";
                echo "alert('Login Successful!');";
                echo "window.location.href='./views/index.php';"; 
                echo "</script>";
            } else {
                echo "<script>";
                echo "alert('wrong Password. Please try again.');";
                echo "window.history.back();";
                echo "</script>";
            }
        } else {
   
            echo "<script>";
            echo "alert('Email Not Avialble in our database / Email is wrong . Please try again.');";
            echo "window.history.back();";
            echo "</script>";
        }
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

?>
