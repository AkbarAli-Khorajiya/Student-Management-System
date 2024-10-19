<?php
        include "includes\header.php";

        ?>

<div class="content-container pt-30">
    <div class="row mt-30 pt-30">
        <div class="main">
            <div class="chg-pass-container">
                <h2 class="mb-30 mt-10">Change Password</h2>
                <div class="alert alert-danger">
                    <!-- ---- -->
                </div>
                <!-- old password -->
                <form id="confirm-pass-form" class="confirm-pass" method="post">
                    <h3 class=" mb-10">Enter Old Password</h3>
                    <div class="input-grp">
                        <input type="password" placeholder="Old Password" name="password" id="confirm-password">
                        <i class="fa-solid fa-eye password" id="eye"></i>
                        <input type="hidden" name="email" id="confirm-email"
                            value="<?php echo $_SESSION['user_email'];?>">
                    </div>
                    <div class="mt-30">
                        <button class="btn btn-primary btn-block">Verify</button>
                    </div>
                </form>
                <!-- new password -->
                <form id="change-pass-form" class="change-pass" method="post">
                    <h3 class=" mb-10">Enter New Password</h3>
                    <div class="input-grp mb-20">
                        <input type="password" placeholder="New Password" name="password" id="new-password">
                        <i class="fa-solid fa-eye password" id="eye2"></i>
                    </div>
                    <h3 class=" mb-10">Confirm Password</h3>
                    <div class="input-grp">
                        <input type="password" placeholder="Confirm Password" name="cpassword" id="con-password">
                        <i class="fa-solid fa-eye password" id="eye3"></i>
                        <input type="hidden" name="email" id="change-email"
                            value="<?php echo $_SESSION['user_email'];?>">
                    </div>
                    <div class="mt-30">
                        <button class="btn btn-primary btn-block">Change</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo $site_url;?>assets\js\custom.js"></script>

</body>

</html>