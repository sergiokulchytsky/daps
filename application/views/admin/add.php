<?php
/**
 * Created by PhpStorm.
 * User: serhi
 * Date: 20-Mar-16
 * Time: 15:15
 */
?>
<?php if ($params['result']): ?>
    <div class="form">
        <div class="tab-content">
            <h1 class="message">Success!</h1>
        </div>
    </div>
<?php else: ?>
    <div class="dashboard">
        <h1 class="title">Add user</h1>
        <form class="add-item" action="" method="post">
            <div class="large-field">
                <div class="small-field">
                    <div class="field-item">
                        <div class="field-wrap">
                            <input <?php echo isset($params['errors']['name']) ? "class=\"error input\"" : "" ?>
                                type="text" name="name" placeholder="User Name *" required autocomplete="off"
                                class="input" value="<?php echo $params['name'] ?>"/>
                            <?php if (isset($params['errors']['name'])) { ?>
                                <p class="error"><?php echo $params['errors']['name'] ?></p><?php
                            } ?>
                        </div>
                    </div>
                </div>
                <div class="small-field">
                    <div class="field-item">
                        <div class="field-wrap">
                            <input <?php echo isset($params['errors']['email']) ? "class=\"error input\"" : "" ?>
                                type="email" name="email" placeholder="Email Address *" required autocomplete="off"
                                class="input" value="<?php echo $params['email'] ?>"/>
                            <?php if (isset($params['errors']['email'])) { ?>
                                <p class="error"><?php echo $params['errors']['email'] ?></p><?php
                            } ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="small-field">
                <div class="large-field-item">
                    <div class="small-field-item">
                        <div class="field-item">
                            <span>Password verification: </span>
                        </div>
                    </div>
                </div>
                <div class="large-field-item">
                    <div class="small-field-item">
                        <div class="field-item">
                            <input type="checkbox" name="verify" class="check"/>
                        </div>
                    </div>
                </div>
            </div>
            <br><br>
            <div class="add-field">
                <div class="button-field">
                    <div class="button-item">
                        <input type="submit" name="submit" value="Add" class="small-button button-block"/>
                    </div>
                </div>
            </div>
        </form>
    </div>
<?php endif; ?>