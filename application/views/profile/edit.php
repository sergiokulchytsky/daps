<?php
/**
 * Created by PhpStorm.
 * User: serhi
 * Date: 17-Mar-16
 * Time: 02:23
 */
?>

<div class="form">
    <div class="tab-content">
        <?php if ($result): ?>
            <h1 class="message">Success!</h1>
        <?php else: ?>
            <h1>Change Password!</h1>
            <form action="" method="post">

                <div class="field-wrap">
                    <input <?php echo isset($params['errors']['old_pass']) ? "class=\"error\"" : "" ?>
                        type="password" name="old_pass" placeholder="Old Password *" required autocomplete="off"/>
                    <?php if (isset($params['errors']['old_pass'])) { ?>
                        <p class="error"><?php echo $params['errors']['old_pass'] ?></p><?php
                    } ?>
                </div>

                <div class="field-wrap">
                    <input <?php echo isset($params['errors']['new_pass']) ? "class=\"error\"" : "" ?>
                        type="password" name="new_pass" placeholder="New Password *" required autocomplete="off"/>
                    <?php if (isset($params['errors']['new_pass'])) { ?>
                        <p class="error"><?php echo $params['errors']['new_pass'] ?></p><?php
                    } ?>
                </div>

                <div class="field-wrap">
                    <input <?php echo isset($params['errors']['ver_pass']) ? "class=\"error\"" : "" ?>
                        type="password" name="ver_pass" placeholder="Verify Password *" required autocomplete="off"/>
                    <?php if (isset($params['errors']['ver_pass'])) { ?>
                        <p class="error"><?php echo $params['errors']['ver_pass'] ?></p><?php
                    } ?>
                </div>

                <?php if (isset($params['errors']['match'])) { ?>
                    <p class="general-error"><?php echo $params['errors']['match'] ?></p>
                <?php } ?>
                <input type="submit" name="submit" value="Change" class="button button-block"/>
            </form>
        <?php endif; ?>
    </div><!-- tab-content -->
</div> <!-- /form -->
