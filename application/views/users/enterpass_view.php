<?php
/**
 * Created by PhpStorm.
 * User: serhi
 * Date: 21-Mar-16
 * Time: 23:56
 */
?>
<div class="form">
    <?php if (isset($params['errors']['time'])): ?>
        <div class="tab-content">
            <h1 class="message">System blocked!</h1>
            <h1 class="message"><?php echo $params['errors']['time'] ?></h1>
        </div>
    <?php else: ?>

        <ul class="tab-group">
            <li class="tab"><a href="">Sign Up</a></li>
            <li class="tab active"><a>Log In</a></li>
        </ul>

        <div class="tab-content">
            <h1>Enter Password!</h1>
            <form action="" method="post">

                <div class="field-wrap">
                    <input <?php echo isset($params['errors']['password']) ? "class=\"error\"" : "" ?>
                        type="password" name="password" placeholder="Password *" required autocomplete="off"/>
                    <?php if (isset($params['errors']['password'])) { ?>
                        <p class="error"><b><?php echo $params['errors']['password'] ?></b></p><?php
                    } ?>
                </div>
                
                <?php if (isset($params['errors']['login'])) { ?>
                    <p class="general-error"><b><?php echo $params['errors']['login'] ?></b></p>
                <?php } ?>
                <input type="submit" name="submit" value="Log In" class="button button-block"/>
            </form>
        </div><!-- tab-content -->
    <?php endif; ?>
</div> <!-- /form -->