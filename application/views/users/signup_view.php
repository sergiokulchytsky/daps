<?php
/**
 * Created by PhpStorm.
 * User: serhi
 * Date: 05-Mar-16
 * Time: 15:22
 */
?>
<div class="form">

    <ul class="tab-group">
        <li class="tab active"><a>Sign Up</a></li>
        <li class="tab"><a href="/user/email">Log In</a></li>
    </ul>

    <div class="tab-content">
        <h1>Sign Up for Free</h1>
        <form action="" method="post">
            <div class="field-wrap">
                <input <?php echo isset($params['errors']['name']) ? "class=\"error\"" : "" ?> type="text" name="name"
                                                                                     placeholder="Your Name *" required
                                                                                     autocomplete="off"
                                                                                     value="<?php echo $params['name'] ?>"/>
                <?php if (isset($params['errors']['name'])) { ?>
                    <p class="error"><?php echo $params['errors']['name'] ?></p><?php
                } ?>
            </div>

            <div class="field-wrap">
                <input <?php echo isset($params['errors']['email']) ? "class=\"error\"" : "" ?> type="email" name="email"
                                                                                      placeholder="Email Address *"
                                                                                      required autocomplete="off"
                                                                                      value="<?php echo $params['email'] ?>"/>
                <?php if (isset($params['errors']['email'])) { ?>
                    <p class="error"><?php echo $params['errors']['email'] ?></p><?php
                } ?>
            </div>

            <div class="field-wrap">
                <input <?php echo isset($params['errors']['password']) ? "class=\"error\"" : "" ?> type="password" name="password"
                                                                                         placeholder="Set A Password *"
                                                                                         required autocomplete="off"/>
                <?php if (isset($params['errors']['password'])) { ?>
                    <p class="error"><?php echo $params['errors']['password'] ?></p><?php
                } ?>
            </div>
            <input type="submit" name="submit" value="Register" class="button button-block"/>
        </form>
    </div><!-- tab-content -->
</div> <!-- /form -->
