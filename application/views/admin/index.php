<?php
/**
 * Created by PhpStorm.
 * User: serhi
 * Date: 17-Mar-16
 * Time: 02:25
 */
$count = 0;
foreach ($params['usersList'] as $user) {
    $count++;
}
?>
<div class="dashboard">
    <div class="head">
        <div class="title-field">
            <h1 class="title">Users list (<?php echo $count ?>)</h1>
        </div>
        <div class="title-button">
            <div class="title-button-item">
                <a class="small-button button-block" href="/user/add">Add</a>
            </div>
        </div>
    </div>
    <div class="list">
        <?php foreach ($params['usersList'] as $user): ?>
            <div class="list-item">
                <div class="large-field">
                    <div class="small-field">
                        <div class="field-item">
                            <span>Name: <b><?php echo $user['name'] . (empty($user['pass']) ? ' (new)' : ''); ?></b></span>
                        </div>
                    </div>
                    <div class="small-field">
                        <div class="field-item">
                            <span>Email: <b><?php echo $user['email']; ?></b></span>
                        </div>
                    </div>
                </div>
                <div class="large-field">
                    <div class="small-field">
                        <div class="field-item">
                            <span>Password verification: <b><?php echo $user['verify'] ? 'yes' : 'no'; ?></b></span>
                        </div>
                    </div>
                    <div class="small-field">
                        <div class="field-item">
                            <span>Blocked: <b><?php echo $user['blocked'] ? 'yes' : 'no'; ?></b></span>
                        </div>
                    </div>
                </div>
                <div class="field">
                    <div class="button-field">
                        <div class="button-item">
                            <?php if (!$user['admin']): ?>
                                <a class="small-button button-block" href="/user/<?php echo $user['_id']->{'$id'}; ?>/">Edit</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>