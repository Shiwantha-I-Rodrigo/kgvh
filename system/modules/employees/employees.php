<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/system/init.php';
if (!isset($_SESSION['user_id'])) {
    reDirect(SYSTEM_BASE_URL . "login.php");
}
$user_id = $_SESSION['user_id'];
$db = dbConn();
$sql = "SELECT * FROM user_modules WHERE UserId='$user_id' AND ModuleId ='5'";
$result = $db->query($sql);
if ($result->num_rows < 1) {
    reDirect(SYSTEM_BASE_URL . "401.php");
};
ob_start();
?>

<!-- Table Start -->
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-12">
            <div class="bg-secondary rounded h-100 p-4">
                <h6 class="mb-4">Employee Table</h6>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">NIC</th>
                                <th scope="col">Address</th>
                                <th scope="col">Contacts</th>
                                <th scope="col">Reg No.</th>
                                <th scope="col">Role</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            $user_role = $_SESSION['user_role'];
                            $sql = "SELECT * FROM  employees e WHERE e.EmployeeRole >= '$user_role'";
                            $employees = $db->query($sql);
                            while ($row = $employees->fetch_assoc()) {
                            ?>

                                <tr>
                                    <th scope="row"><?= $row['EmployeeId'] ?></th>
                                    <td><?= title($row['Title']); ?>&nbsp<?= $row['FirstName'] ?>&nbsp<?= $row['LastName'] ?></td>
                                    <td><?= $row['NationalIdCard'] ?></td>
                                    <td><?= $row['AddressLine1'] ?><br><?= $row['AddressLine2'] ?><br><?= $row['AddressLine3'] ?></td>
                                    <td><?= $row['Telephone'] ?><br><?= $row['Mobile'] ?></td>
                                    <td><?= $row['RegNo'] ?></td>
                                    <td><?= role($row['EmployeeRole']); ?></td>
                                    <td>
                                        <button class="crit_btn"><i class="fas fa-edit"></i></button>
                                        <button class="common_btn ms-2"><i class="fa fa-trash"></i></button>
                                    </td>
                                </tr>

                            <?php } ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Table End -->

<?php
$page_content = ob_get_clean();
$page_title = "Employees";
$user_image = $_SESSION['profile_pic'];
$first_name = $_SESSION['first_name'];
$_SESSION['employee_role'] == 1 ? $user_role = "Admin" : ($_SESSION['employee_role'] == 2 ? $user_role = "Manager" : ($_SESSION['employee_role'] ? $user_role = "Receptionist" : $user_role = "Travel Solution"));
$role_image = "images/" . $_SESSION['employee_role'] . ".jpg";

$sql = "SELECT * FROM modules m INNER JOIN user_modules um ON m.ModuleId = um.ModuleId WHERE um.UserId = " . $user_id;
$modules = $db->query($sql);
$sql = "SELECT * FROM  messages WHERE messages.UserIdTo = '$user_id'";
$messages = $db->query($sql);
$sql = "SELECT * FROM  notes WHERE notes.UserIdTo = " . $user_id;
$notes = $db->query($sql);

require_once $_SERVER['DOCUMENT_ROOT'] . '/system/layout.php';
?>