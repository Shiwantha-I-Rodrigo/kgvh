<!-- Submit Modal -->
<div class="modal fade back" id="success_modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modals">
            <div class="modal-header">
                <img src="<?= SYSTEM_BASE_URL ?>images/logo_tiny.png" alt="logo" class="img-fluid" />
                <h3 class="modal-title" style="color: #fff;">Confirmation</h3>
                <button type="button" class="close crit_btn" data-bs-dismiss="modal">
                    <i class="fa fa-times" aria-hidden="true"></i>
                </button>
            </div>
            <div class="modal-body">
                <p style="color: #fff;">By submitting the registration, you are agreeing to the terms and conditions of registration !</p>
                <p style="color: #fff;">Are you sure you want to submit the registration ?</p>
                <a href="<?= SYSTEM_BASE_URL ?>index.php" class="small text-muted">Terms of use.</a>
                <a href="<?= SYSTEM_BASE_URL ?>index.php" class="small text-muted">Privacy policy</a>
            </div>
            <div class="modal-footer row justify-content-around">
                <button class="crit_btn col-5" data-bs-dismiss="modal">Cancel</button>
                <button class="common_btn col-5" type="submit" form="reg_form" formmethod="post">Confirm</button>
            </div>
        </div>
    </div>
</div>

<!-- Reset Modal -->
<div class="modal fade back" id="reset_modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modals">
            <div class="modal-header">
                <img src="<?= SYSTEM_BASE_URL ?>images/logo_tiny.png" alt="logo" class="img-fluid" />
                <h3 class="modal-title" style="color: #fff;">Confirmation</h3>
                <button type="button" class="close crit_btn" data-bs-dismiss="modal">
                    <i class="fa fa-times" aria-hidden="true"></i>
                </button>
            </div>
            <div class="modal-body">
                <p style="color: #fff;">Are you sure you want to reset the entered data ?</p>
            </div>
            <div class="modal-footer row justify-content-around">
                <button class="crit_btn col-5" data-bs-dismiss="modal">Cancel</button>
                <a class="common_btn col-5" href="javascript: location.reload();">Confirm</a>
            </div>
        </div>
    </div>
</div>