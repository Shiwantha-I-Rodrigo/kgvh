<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/system/init.php';
if (!isset($_SESSION['user_id'])) {
    reDirect(SYSTEM_BASE_URL . "login.php");
}
$user_id = $_SESSION['user_id'];
unauthorize($user_id, '6');
$db = dbConn();
ob_start();
?>

<!-- Table Start -->
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-12">
            <div class="bg-secondary rounded h-100 p-4">
                <h6 class="mb-4">Notifications</h6>
                <div class="table-responsive">
                    <a href="notifications_form.php"><button class="crit_btn">Send Notification</button></a>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Date</th>
                                <th scope="col">From</th>
                                <th scope="col">Note</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            $user_role = $_SESSION['user_role'];
                            $sql = "SELECT * FROM  notes";
                            $notes = $db->query($sql);
                            while ($row = $notes->fetch_assoc()) {
                            ?>

                                <tr>
                                    <th scope="row"><?= $row['NoteId'] ?></th>
                                    <td><?= $row['Date'] ?></td>
                                    <?php
                                    $from_id = $row['UserIdFrom'];
                                    $sql = "SELECT UserName FROM users WHERE UserId = $from_id LIMIT 1";
                                    $user = $db->query($sql);
                                    $record = $user->fetch_assoc();
                                    $user_name = $record['UserName'];
                                    ?>
                                    <td>[ <?= $from_id ?> ] <?= $user_name ?></td>
                                    <td><ins><?= $row['NotePath'] ?></ins><br><?= $row['NoteShort'] ?></td>
                                    <td>
                                        <a href="<?= SYSTEM_BASE_URL ?>notifications_form.php?id=<?= $row['NoteId'] ?>&action=1"><button class="common_btn ms-2"><i class="fa fa-eye-slash"></i></button></a>
                                        <a href="<?= SYSTEM_BASE_URL ?>notifications_form.php?id=<?= $row['NoteId'] ?>&action=2"><button class="crit_btn ms-2"><i class="fa fa-thumbtack"></i></button></a>
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