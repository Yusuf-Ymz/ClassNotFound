<div class="container">
    <h3>Members:</h3>
</div>
<?php if($nbMembers == 1) echo '<p id="notification" class="container"><i class="fas fa-exclamation-triangle"></i> No other user found.</p>'?>
<!-- Displaying all members -->
<?php for ($i = 0; $i < $nbMembers; $i++) { ?>
    <?php if (unserialize($_SESSION['login'])->login() != $members[$i]->login()) { ?>
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <span><?php echo $members[$i]->html_login(); ?> </span>
                </div>
                <!-- Displaying admin actions-->
                <div class="card-footer question-btn">
                    <form action="index.php?action=admin" method="post">
                        <?php if ($members[$i]->suspended() == 0) { ?>
                            <input class="btn btn-dark" type="submit"
                                   name="suspend"
                                   value="Suspend">
                        <?php } else { ?>
                            <input class="btn btn-dark" type="submit"
                                   name="activate"
                                   value="Activate">
                        <?php } ?>
                        <?php if ($members[$i]->admin() == 0) { ?>
                            <input class="btn btn-dark" type="submit"
                                   name="upgrade"
                                   value="Upgrade to admin">
                        <?php } else { ?>
                            <input class="btn btn-dark" type="submit"
                                   name="demote"
                                   value="Demote admin grade">
                        <?php } ?>

                        <input type="hidden" name="member_id" value="<?php echo $members[$i]->memberId(); ?>">
                    </form>
                </div>
            </div>
        </div>
    <?php } ?>
<?php } ?>

