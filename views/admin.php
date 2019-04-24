<div class="container">
    <h3>Members:</h3>
</div>

<!-- Displaying all members -->
<?php foreach ($members as $i => $member) { ?>
    <?php if ($_SESSION['login'] != $member->login()) { ?>
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <span><?php echo $member->html_login(); ?> </span>
                </div>
                <!-- Displaying admin actions-->
                <div class="card-footer question-btn">
                    <form action="index.php?action=admin" method="post">
                        <?php if ($member->suspended() == 0) { ?>
                            <input class="btn btn-dark" type="submit"
                                   name="suspend"
                                   value="Suspend">
                        <?php } else { ?>
                            <input class="btn btn-dark" type="submit"
                                   name="activate"
                                   value="Activate">
                        <?php } ?>
                        <?php if ($member->admin() == 0) { ?>
                            <input class="btn btn-dark" type="submit"
                                   name="upgrade"
                                   value="Upgrade to admin">
                        <?php } else { ?>
                            <input class="btn btn-dark" type="submit"
                                   name=""
                                   value="Demote admin grade">
                        <?php } ?>

                        <input type="hidden" name="member_id" value="<?php echo $member->memberId(); ?>">
                    </form>
                </div>
            </div>
        </div>
    <?php } ?>
<?php } ?>

