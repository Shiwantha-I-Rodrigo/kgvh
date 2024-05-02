<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/system/init.php';
if (!isset($_SESSION['user_id'])) {
    reDirect(SYSTEM_BASE_URL . "login.php");
}
$user_id = $_SESSION['user_id'];
unauthorize($user_id, '4');
$db = dbConn();
ob_start();
?>

<!-- Table Start -->
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-12">
            <div class="bg-secondary rounded h-100 p-4">
                <h6 class="mb-4">Customer Table</h6>
                <div class="table-responsive">
                <a href="customers_form.php"><button class="crit_btn"><i class="fas fa-plus"></i></button></a>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">NIC</th>
                                <th scope="col">Address</th>
                                <th scope="col">Contacts</th>
                                <th scope="col">Reg No.</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            $user_role = $_SESSION['user_role'];
                            $sql = "SELECT * FROM  customers";
                            $customers = $db->query($sql);
                            while ($row = $customers->fetch_assoc()) {
                            ?>

                                <tr>
                                    <th scope="row"><?= $row['CustomerId'] ?></th>
                                    <td><?= title($row['Title']); ?>&nbsp<?= $row['FirstName'] ?>&nbsp<?= $row['LastName'] ?></td>
                                    <td><?= $row['NationalIdCard'] ?></td>
                                    <td><?= $row['AddressLine1'] ?><br><?= $row['AddressLine2'] ?><br><?= $row['AddressLine3'] ?></td>
                                    <td><?= $row['Telephone'] ?><br><?= $row['Mobile'] ?></td>
                                    <td><?= $row['RegNo'] ?></td>
                                    <td>
                                        <a href="customers_form.php?id=<?= $row['UserId'] ?>"><button class="crit_btn"><i class="fas fa-edit"></i></button></a>
                                        <a href="<?=SYSTEM_BASE_URL?>delete.php?id=<?= $row['UserId'] ?>&asset=4"><button class="common_btn ms-2"><i class="fa fa-trash"></i></button></a>
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
$page_title = "Customers";
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