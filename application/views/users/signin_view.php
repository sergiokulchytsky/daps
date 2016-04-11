<?php
/**
 * Created by PhpStorm.
 * User: serhi
 * Date: 05-Mar-16
 * Time: 15:22
 */
?>
<div class="form">
    <?php if (isset($_COOKIE['fails']) && $_COOKIE['fails'] == 3): ?>
        <div class="tab-content">
            <h1 class="message">System blocked!</h1>
        </div>
    <?php else: ?>
        
        <ul class="tab-group">
            <li class="tab"><a href="/user/register">Sign Up</a></li>
            <li class="tab active"><a>Log In</a></li>
        </ul>
        
        <div class="tab-content">
            <h1>Welcome Back!</h1>
            <form action="" method="post">
                
                <div class="field-wrap">
                    <input <?php echo isset($params['errors']['email']) ? "class=\"error\"" : "" ?>
                        type="email" name="email" placeholder="Email Address *" required autocomplete="off"
                        value="<?php echo $params['email'] ?>"/>
                    <?php if (isset($params['errors']['email'])) { ?>
                        <p class="error"><b><?php echo $params['errors']['email'] ?></b></p><?php
                    } ?>
                </div>
                
                <div class="field-wrap">
                    <input <?php echo isset($params['errors']['password']) ? "class=\"error\"" : "" ?>
                        type="password" name="password" placeholder="Password *" required autocomplete="off"/>
                    <?php if (isset($params['errors']['password'])) { ?>
                        <p class="error"><?php echo $params['errors']['password'] ?></p><?php
                    } ?>
                </div>

                <?php if (isset($params['errors']['login'])) { ?>
                    <p class="general-error"><?php echo $params['errors']['login'] ?></p>
                <?php } ?>
                <!--<p class="forgot"><a href="#">Forgot Password?</a></p>-->
                <input type="submit" name="submit" value="Log In" class="button button-block"/>
            </form>
        </div><!-- tab-content -->
    <?php endif; ?>
</div> <!-- /form -->

