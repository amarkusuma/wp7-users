<?php

/*
Plugin Name: Add Role Users
Description: Add Role Users
Author: Ammar
*/

require_once('display-user-role.php');

function add_user_role()
{
    add_role(
        'staff',
        'Staff',
        [
            'read'  => true,
        ]
    );
    add_role(
        'manager',
        'Manager',
        [
            'read' => true,
            'list_users' => true,
        ]
    );
}

add_action('init', 'add_user_role');
