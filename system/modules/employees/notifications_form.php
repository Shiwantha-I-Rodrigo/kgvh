<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/system/init.php';
if (!isset($_SESSION['user_id'])) {
    reDirect(SYSTEM_BASE_URL . "login.php");
}
$user_id = $_SESSION['user_id'];
unauthorize($user_id, '6');
$db = dbConn();
$form_title = "";

//load notification
if (isset($_GET['id'])) {
    $view = true;
    $note_id = htmlspecialchars($_GET["id"]);
    $sql = "SELECT * FROM notes WHERE NoteId=$note_id";
    $result = $db->query($sql);
    $row = mysqli_fetch_array($result);
    $atitle = $row["NotePath"];
    $anote = $row["NoteShort"];
    $adate = $row["Date"];
    $auser_from_id = $row["UserIdFrom"];
    $auser_to_id = $row["UserIdTo"];
    $astatus = $row["Status"];

    $auser_from = $row["UserIdFrom"];
    $auser_to = $row["UserIdTo"];
}

// form actions
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    extract($_POST);

    $current_date = date('Y-m-d');
    $sql = "INSERT INTO `notes`(`NotePath`, `NoteShort`,`Date`,`UserIdFrom`,`UserIdTo`,`Status`) VALUES ('$note_path','$note_short','$current_date','$user_from_id','$user_to_id','$status')";
    $db->query($sql);
    $user_id = $db->insert_id;

    $_SESSION['operation'] = 'notified';
    reDirect(SYSTEM_BASE_URL . "crud_success.php");
}


ob_start();
?>

<!-- Form Start -->
<div class="container-fluid p-4 m-2">
    <div class="bg-secondary rounded p-4">

        <form class="main_form p-4" id="reg_form" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" role="form" novalidate>

            <h2 class="row justify-content-center"> <?= $form_title ?> </h2>

            <div class="row">
                <div class="col-6">
                    <label class="row">Notification Title</label>
                    <input type="text" class="form-control inputs row" name="note_path" id="note_path" placeholder="Notification Title *" value="<?= $atitle ?>" required <?= $view ? "disabled" : "" ?> />
                </div>
            </div>

            <div class="row">
                <div class="col-6">
                    <label class="row">Notification</label>
                    <textarea class="form-control textareas row" name="note_short" id="note_short" placeholder="Message" <?= $view ? "disabled" : "" ?>><?= $anote ?></textarea>
                </div>
            </div>

            <div class="row <?= $view ? "d-none" : "" ?>">
                <div class="col-6">
                    <label class="row">Recipient</label>
                    <input type="text" class="form-control inputs row" name="user_to" id="user_to" placeholder="Recipient *" value="<?= $auser_to ?>" required />
                </div>
            </div>

            <div class="row <?= $view ? "" : "d-none" ?>">
                <div class="col-6">
                    <label class="row">From</label>
                    <input type="text" class="form-control inputs row" name="user_from" id="user_from" placeholder="From" value="<?= $auser_from ?>" disabled />
                </div>
            </div>

            <div class="row mb-1 <?= $view ? "d-none" : "" ?>">
                <div class="col-6">
                    <label>Select a suggestion</label>
                </div>
            </div>

            <div class="row mb-4 <?= $view ? "d-none" : "" ?>">
                <div class="col-6">
                    <button class="list_btn form-control row" name="res1" id="res1">welcome</button>
                    <button class="list_btn form-control row" name="res2" id="res2">welcome</button>
                    <button class="list_btn form-control row" name="res3" id="res3">welcome</button>
                </div>
            </div>

            <div class="row">
                <div class="col-6">
                    <label class="row">Status</label>
                    <select name="status" id="status" class="form-control inputs row" <?= $view ? "disabled" : "" ?>>
                        <option value="0" <?= $astatus == 0 ? "selected" : ""; ?>>Normal</option>
                        <option value="1" <?= $astatus == 1 ? "selected" : ""; ?>>Important</option>
                    </select>
                </div>
            </div>

            <input type="text" name="note_id" id="note_id" class="d-none" value="<?= $note_id ?>" />
            <input type="text" name="user_to_id" id="user_to_id" class="d-none" value="<?= $auser_to_id ?>" />
            <input type="text" name="user_from_id" id="user_from_id" class="d-none" value="<?= $auser_from_id ?>" />

        </form>
        <div class="row justify-content-center">
            <div class="col-2">
                <button class="common_btn w-100" name="sub_btn" id="sub_btn" data-bs-toggle="modal" data-bs-target="#success_modal" <?= $update ? "" : "disabled" ?>>Send</button>
            </div>
            <div class="col-2">
                <button class="crit_btn w-100" name="res_btn" id="res_btn" data-bs-toggle="modal" data-bs-target="#reset_modal">Reset</button>
            </div>
        </div>
    </div>
</div>
<!-- Form End -->

<script>
    user_to.addEventListener("input", () => {
        var part = $('#user_to').val();
        $.ajax({
            url: "search_users.php?part=" + part,
            type: "GET",
            success: function(data) {
                const users = data.split(",");
                users.pop();
                var res1 = document.getElementById("res1");
                var res2 = document.getElementById("res2");
                var res3 = document.getElementById("res3");
                res1.innerHTML=users[0];
            }
        });
        if (part.trim() == "") {
            res1.classList.add("d-none");
            res2.classList.add("d-none");
            res3.classList.add("d-none");
        }
    });

    user_to.addEventListener("input", () => {
        var part = $('#user_to').val();
        $.ajax({
            url: "search_users.php?part=" + part,
            type: "GET",
            success: function(data) {
                const users = data.split(",");
                users.pop();
                var user_list = document.getElementById("user_list");
                user_list.value = users.join("\n");
            }
        });
        if (part.trim() == "") {
            user_list.value = "";
        }
    });
</script>

<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/system/modals.php';
$page_content = ob_get_clean();
$page_title = "Notifications";
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