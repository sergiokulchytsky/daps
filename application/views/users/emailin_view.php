<?php
/**
 * Created by PhpStorm.
 * User: serhi
 * Date: 21-Mar-16
 * Time: 23:36
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
            <h1>Enter Email!</h1>
            <form action="" method="post">

                <div class="field-wrap">
                    <input <?php echo isset($params['errors']['email']) ? "class=\"error\"" : "" ?>
                        type="email" name="email" placeholder="Email Address *" required autocomplete="off"
                        value="<?php echo $params['email'] ?>"/>
                    <?php if (isset($params['errors']['email'])) { ?>
                        <p class="error"><b><?php echo $params['errors']['email'] ?></b></p><?php
                    } ?>
                </div>
                
                <?php if (isset($params['errors']['login'])) { ?>
                    <p class="general-error"><b><?php echo $params['errors']['login'] ?></b></p>
                <?php } ?>
                <!--<p class="forgot"><a href="#">Forgot Password?</a></p>-->
                <input type="submit" name="submit" value="Continue" class="button button-block"/>
            </form>
        </div><!-- tab-content -->
    <?php endif; ?>
</div> <!-- /form -->
