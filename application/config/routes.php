<?php
/**
 * Created by PhpStorm.
 * User: serhi
 * Date: 11-Mar-16
 * Time: 23:14
 */
    return array(
        'user/login' => 'user/login',
        'user/register' => 'user/register',
        'user/logout' => 'user/logout',

        'user/add' => 'admin/add',
        'users/list' => 'admin/index',
        'user/(\w+)' => 'admin/edit/$1',


        'profile' => 'profile/index',
        'edit' => 'profile/edit',

        'about' => 'site/about',

        '' => 'site/index',
    );