<div class="container">
    <h3>Members:</h3>
</div>
<form action="index.php?action=admin" method="post">
    <!-- Displaying all members -->
    <?php foreach ($members as $i => $member) { ?>
        <div class="card">
            <div class="card-body">
                <span><?php echo $member->html_login(); ?> </span>
            </div>
            <!-- Displaying admin actions-->
            <div class="card-footer">
                <?php if ($member->suspended() == 0) {
                    $state = "Suspend";
                } else $state = "Activate";
                ?>
                <?php if ($member->admin() == 0) {
                    $value = "Upgrade to admin";
                    $name = "upgrade";
                } else {$value = "Demote admin grade";
                    $name = "demote";}
                ?>
                <input class="btn btn-dark" type="submit"
                       name="<?php echo $state; ?>[<?php echo $member->memberId(); ?>]"
                       value="<?php echo $state; ?>">
                <input class="btn btn-dark" type="submit"
                       name="<?php echo $name; ?>[<?php echo $member->memberId(); ?>]"
                       value="<?php echo $value; ?>">
                <br>
            </div>
        </div>
    <?php } ?>
</form>
