<?php
include 'inc/header.php';

Session::CheckSession();
$sId = Session::get('roleid');
if ($sId === '1') {

    $database = new Database();
    $conn = $database->pdo;

    // Function to get the next auto-increment value
    function getNextUserId($conn) {
        $nextUserIdSql = "SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA = 'your_database_name' AND TABLE_NAME = 'tbl_users'";
        $stmt = $conn->prepare($nextUserIdSql);
        $stmt->execute();
        $nextUserIdResult = $stmt->fetch(PDO::FETCH_ASSOC);
        return $nextUserIdResult ? $nextUserIdResult['AUTO_INCREMENT'] : '24001';
    }

    // Get the next user ID
    $nextUserId = getNextUserId($conn);

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['addUser'])) {
        // Retrieve form values
        $username = $_POST['username'];
        $surname = $_POST['surname'];
        $first_name = $_POST['first_name'];
        $middle_name = $_POST['middle_name'];
        $job_title = $_POST['job_title'];
        $mobile = $_POST['mobile'];
        $email = $_POST['email'];
        $regional_office = $_POST['regional_office'];
        $market = $_POST['market'];
        $role = $_POST['role'];
        $isActive = isset($_POST['account_active']) ? 0 : 1; // Invert the logic here
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $created_at = date("Y-m-d H:i:s");
        $updated_at = $created_at;

        // Map roles to roleid (adjust mapping as needed)
        $roleMapping = [
            'Admin' => 1,
            'Editor' => 2,
            'User only' => 3
        ];
        $roleid = isset($roleMapping[$role]) ? $roleMapping[$role] : 3;

        // Insert user into database
        $sql = "INSERT INTO tbl_users (name, username, email, password, mobile, roleid, isActive, created_at, updated_at, job_title_id, regional_office_id, market_id) 
                VALUES (:name, :username, :email, :password, :mobile, :roleid, :isActive, :created_at, :updated_at, :job_title_id, :regional_office_id, :market_id)";
        $stmt = $conn->prepare($sql);
        
        $full_name = $first_name . ' ' . $middle_name . ' ' . $surname;
        $stmt->bindParam(':name', $full_name);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':mobile', $mobile);
        $stmt->bindParam(':roleid', $roleid);
        $stmt->bindParam(':isActive', $isActive);
        $stmt->bindParam(':created_at', $created_at);
        $stmt->bindParam(':updated_at', $updated_at);
        $stmt->bindParam(':job_title_id', $job_title);
        $stmt->bindParam(':regional_office_id', $regional_office);
        $stmt->bindParam(':market_id', $market);

        if ($stmt->execute()) {
            echo "<div class='alert alert-success'>User added successfully!</div>";
            // Update the next user ID after successful insertion
            $nextUserId = getNextUserId($conn);
        } else {
            echo "<div class='alert alert-danger'>Failed to add user.</div>";
        }
    }

    // Fetch job titles
    $jobTitlesSql = "SELECT id, title FROM job_titles";
    $stmt = $conn->prepare($jobTitlesSql);
    $stmt->execute();
    $jobTitlesResult = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Fetch regional offices
    $regionalOfficeSql = "SELECT id, name FROM regional_office";
    $stmt = $conn->prepare($regionalOfficeSql);
    $stmt->execute();
    $regionalOfficesResult = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Fetch markets
    $marketSql = "SELECT id, name FROM market";
    $stmt = $conn->prepare($marketSql);
    $stmt->execute();
    $marketsResult = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="card">
    <div class="card-header">
        <h3 class='text-center'>Add New User</h3>
    </div>
    <div class="card-body">
        <div style="width:600px; margin:0px auto">
            <form action="" method="post">
                <div class="form-group pt-3">
                    <label for="username">Username</label>
                    <input type="text" name="username" class="form-control" maxlength="30" required>
                </div>
                <div class="form-group">
                    <label for="surname">Surname</label>
                    <input type="text" name="surname" class="form-control" maxlength="16" required>
                </div>
                <div class="form-group">
                    <label for="first_name">First Name</label>
                    <input type="text" name="first_name" class="form-control" maxlength="50" required>
                </div>
                <div class="form-group">
                    <label for="middle_name">Middle Name</label>
                    <input type="text" name="middle_name" class="form-control" maxlength="50">
                </div>
                <div class="form-group">
                    <label for="job_title">Job Title</label>
                    <select class="form-control" name="job_title" id="job_title" required>
                        <?php
                        if (count($jobTitlesResult) > 0) {
                            foreach ($jobTitlesResult as $row) {
                                echo "<option value='" . $row['id'] . "'>" . $row['title'] . "</option>";
                            }
                        } else {
                            echo "<option value=''>No Job Titles Available</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="mobile">Mobile Number</label>
                    <input type="text" name="mobile" class="form-control" maxlength="16" required>
                </div>
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" name="email" class="form-control" maxlength="50" required>
                </div>
                <div class="form-group">
                    <label for="userid">User ID</label>
                    <input type="text" name="userid" class="form-control" value="<?php echo $nextUserId; ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="regional_office">Regional Office</label>
                    <select class="form-control" name="regional_office" id="regional_office" required>
                        <?php
                        if (count($regionalOfficesResult) > 0) {
                            foreach ($regionalOfficesResult as $row) {
                                echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
                            }
                        } else {
                            echo "<option value=''>No Regional Offices Available</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="market">Market</label>
                    <select class="form-control" name="market" id="market" required>
                        <?php
                        if (count($marketsResult) > 0) {
                            foreach ($marketsResult as $row) {
                                echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
                            }
                        } else {
                            echo "<option value=''>No Markets Available</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="role">Role</label>
                    <select class="form-control" name="role" id="role" required>
                        <option value="Admin">Admin</option>
                        <option value="Editor">Editor</option>
                        <option value="User only">User only</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="account_active">Account Active</label>
                    <input type="checkbox" name="account_active" id="account_active" value="1">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" class="form-control" minlength="8" maxlength="12" required>
                </div>
                <div class="form-group">
                    <label for="confirm_password">Confirm Password</label>
                    <input type="password" name="confirm_password" class="form-control" minlength="8" maxlength="12" required>
                </div>
                <div class="form-group">
                    <button type="submit" name="addUser" class="btn btn-success">Register</button>
                    <button type="reset" class="btn btn-warning">Reset</button>
                    <button type="button" onclick="window.location.href='index.php'" class="btn btn-danger">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
} else {
    header('Location:index.php');
}

include 'inc/footer.php';
?>
