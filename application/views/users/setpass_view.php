<?php
/**
 * Created by PhpStorm.
 * User: serhi
 * Date: 21-Mar-16
 * Time: 23:56
 */
?>
<div class="form">

    <?php if (isset($_COOKIE['fails']) && $_COOKIE['fails'] == 3): ?>
        <div class="tab-content">
            <h1 class="message">System blocked!</h1>
        </div>
    <?php else: ?>

        <ul class="tab-group">
            <li class="tab"><a href="">Sign Up</a></li>
            <li class="tab active"><a>Log In</a></li>
        </ul>

        <div class="tab-content">
            <h1>Set Password!</h1>
            <form action="" method="post">

                <div class="field-wrap">
                    <input <?php echo isset($params['errors']['new_pass']) ? "class=\"error\"" : "" ?>
                        type="password" name="new_pass" placeholder="New Password *" required autocomplete="off"/>
                    <?php if (isset($params['errors']['new_pass'])) { ?>
                        <p class="error"><b><?php echo $params['errors']['new_pass'] ?></b></p><?php
                    } ?>
                </div>

                <div class="field-wrap">
                    <input <?php echo isset($params['errors']['ver_pass']) ? "class=\"error\"" : "" ?>
                        type="password" name="ver_pass" placeholder="Verify Password *" required autocomplete="off"/>
                    <?php if (isset($params['errors']['ver_pass'])) { ?>
                        <p class="error"><b><?php echo $params['errors']['ver_pass'] ?></b></p><?php
                    } ?>
                </div>

                <?php if (isset($params['errors']['match'])) { ?>
                    <p class="general-error"><b><?php echo $params['errors']['match'] ?></b></p>
                <?php } ?>
                <input type="submit" name="submit" value="Log In" class="button button-block"/>
            </form>
        </div><!-- tab-content -->
    <?php endif; ?>
</div> <!-- /form -->
