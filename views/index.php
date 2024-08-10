<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

include "../db.php";
include "header.php";

$admin_data = $_SESSION['admin_data']; 
$id = intval($admin_data['id']);
$sql = "SELECT * FROM admin WHERE id = $id";
$result = $conn->query($sql);
$data = $result->fetch_assoc();
?>

<!-- main content start -->
<div class="main-content">
    <div class="dashboard-breadcrumb mb-25">
        <h2>Edit Admin</h2>
        <a href="forgot.php" type="submit" name="update_admin" class="btn btn-success btn-sm">Update Password</a>
    </div>       
    <div class="row">
        <div class="col-12">
            <div class="panel">
                <div class="panel-header">
                    <h5>Hello  
                        <?php echo htmlspecialchars($admin_data['username']) . "!"; ?>
                    </h5>
                </div>
                <div class="panel-body">
                    <form method="post" action="../edit.php">
                        <div class="row g-3">
                            <!-- First Row -->
                            <div class="col-xxl-4 col-lg-4 col-sm-6">
                                <label class="form-label">Employee ID</label>
                                <input type="text" name="employee_id" class="form-control form-control-sm" value="<?php echo htmlspecialchars($admin_data['id']); ?>" readonly>
                            </div>
                            <div class="col-xxl-4 col-lg-4 col-sm-6">
                                <label class="form-label">Username</label>
                                <input type="text" name="username" class="form-control form-control-sm" value="<?php echo htmlspecialchars($data['username']); ?>">
                            </div>
                            <div class="col-xxl-4 col-lg-4 col-sm-6">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control form-control-sm" value="<?php echo htmlspecialchars($data['email']); ?>">
                            </div>
                            <!-- Second Row -->
                            <div class="col-xxl-4 col-lg-4 col-sm-6">
                                <label class="form-label">Phone</label>
                                <input type="tel" name="phone" class="form-control form-control-sm"     pattern="[789][0-9]{9}" 
                                title="Phone number must start with 7, 8, 9, or 0 and be exactly 10 digits long."   value="<?php echo htmlspecialchars($data['phone']); ?>">
                            </div>
                        </div>
                        <div class="col-12 d-flex  mt-3">
                            <button type="submit" name="update_admin" class="btn btn-success btn-sm">Update</button>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- main content end -->

<?php include "footer.php"; ?>
