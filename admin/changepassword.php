<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Change Password</h2>
        <div class="block">
            <form>
                <table class="form">
                    <tr>
                        <td>
                            <label>Old Password :</label>
                        </td>
                        <td>
                            <input type="password" placeholder="Enter Old Password..." name="old-pass" class="medium" />
                            <span class="show-btn"><i class="fas fa-eye"></i></span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>New Password :</label>
                        </td>
                        <td>
                            <input type="password" placeholder="Enter New Password..." name="new-pass" class="medium" />
                            
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Re-enter Password :</label>
                        </td>
                        <td>
                            <input type="password" placeholder="Re-enter your password..." name="re-pass" class="medium" />
                            
                        </td>
                    </tr>
                    <tr>
                        <td>
                        </td>
                        <td>
                            <input type="submit" name="submit" Value="Update" />
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
    const passField = document.querySelector("input");
    const showBtn = document.querySelector("span i");
    showBtn.onclick = (() => {
        if (passField.type === "password") {
            passField.type = "text";
            showBtn.classList.add("hide-btn");
        } else {
            passField.type = "password";
            showBtn.classList.remove("hide-btn");
        }
    });
</script>
<?php include 'inc/footer.php'; ?>