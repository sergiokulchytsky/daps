<?php
/**
 * Created by PhpStorm.
 * User: serhi
 * Date: 20-Mar-16
 * Time: 03:37
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
        <h1 class="title">Edit</h1>
        <form class="item" action="" method="post">
            <div class="large-field">
                <div class="small-field">
                    <div class="field-item">
                        <span>Name: <b><?php echo $params['user']['name']; ?></b></span>
                    </div>
                </div>
                <div class="small-field">
                    <div class="field-item">
                        <span>Email: <b><?php echo $params['user']['email']; ?></b></span>
                    </div>
                </div>
            </div>
            <div class="large-field">
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
                                <input type="checkbox" name="verify"
                                       class="check" <?php echo $params['user']['verify'] ? 'checked' : '' ?>/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="small-field">
                    <div class="large-field-item">
                        <div class="small-field-item">
                            <div class="field-item">
                                <span>Blocked: </span>
                            </div>
                        </div>
                    </div>
                    <div class="large-field-item">
                        <div class="small-field-item">
                            <div class="field-item">
                                <input type="checkbox" name="blocked"
                                       class="check" <?php echo $params['user']['blocked'] ? 'checked' : '' ?>/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="field">
                <div class="button-field">
                    <div class="button-item">
                        <input type="submit" name="submit" value="Save" class="small-button button-block"/>
                    </div>
                </div>
            </div>
        </form>
    </div>
<?php endif; ?>