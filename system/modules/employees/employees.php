<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/system/init.php';
if (!isset($_SESSION['user_id'])) {
    reDirect(SYSTEM_BASE_URL . "login.php");
};
ob_start();
?>

<!-- Table Start -->
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-12">
            <div class="bg-secondary rounded h-100 p-4">
                <h6 class="mb-4">Responsive Table</h6>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">First Name</th>
                                <th scope="col">Last Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Country</th>
                                <th scope="col">ZIP</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>John</td>
                                <td>Doe</td>
                                <td>jhon@email.com</td>
                                <td>USA</td>
                                <td>123</td>
                                <td>Member</td>
                            </tr>
                            <tr>
                                <th scope="row">2</th>
                                <td>Mark</td>
                                <td>Otto</td>
                                <td>mark@email.com</td>
                                <td>UK</td>
                                <td>456</td>
                                <td>Member</td>
                            </tr>
                            <tr>
                                <th scope="row">3</th>
                                <td>Jacob</td>
                                <td>Thornton</td>
                                <td>jacob@email.com</td>
                                <td>AU</td>
                                <td>789</td>
                                <td>Member</td>
                            </tr>
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
$page_title = "Dashboard";

$db = dbConn();

$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM employees WHERE UserId='$user_id'";
$employee = $db->query($sql);
if ($employee->num_rows == 1) {
    $row = $employee->fetch_assoc();
    $user_image = $row['ProfilePic'];
    $user_name = $row['FirstName'];
    $row['EmployeeRole'] == 1 ? $user_role = "Admin" : ($row['EmployeeRole'] == 2 ? $user_role = "Manager" : ($row['EmployeeRole'] == 3 ? $user_role = "Receptionist" : $user_role = "Travel Solution"));
    $role_image = "images/" . $row['EmployeeRole'] . ".jpg";
}
$sql = "SELECT * FROM modules INNER JOIN user_modules ON modules.ModuleId = user_modules.ModuleId WHERE user_modules.UserId = " . $user_id;
$modules = $db->query($sql);
$sql = "SELECT * FROM  messages WHERE messages.UserIdTo = '$user_id'";
$messages = $db->query($sql);
$sql = "SELECT * FROM  notes WHERE notes.UserIdTo = " . $user_id;
$notes = $db->query($sql);
require_once $_SERVER['DOCUMENT_ROOT'] . '/system/layout.php';
?>