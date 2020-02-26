<?php

$users_role = new Users_role();
add_shortcode('wp7_users', [$users_role, 'fomPage']);

class Users_role
{


    function role_users($staff)
    {
        $user_staff = new WP_User_Query(
            array(
                'role' => $staff,
                'number' => 5
            )
        );
        return $user_staff->get_results();
    }

    function show_role($staff)
    {
?>
        <table border="1" cellpadding="0" cellspacing="0">
            <tr>

                <th>Name</th>
                <th>Email</th>
                <th>Role</th>

            </tr>
            <?php

            $display_role_users = $this->role_users($staff);
            // echo "<p>" . var_dump($display_role_users) . "</p>";
            foreach ($display_role_users as $data) {
            ?>
                <tr>
                    <td><?php echo $data->display_name; ?></td>
                    <td><?php echo $data->user_email; ?></td>
                    <td><?php echo $data->roles[0]; ?></td>
                </tr>
            <?php
            }
            ?>
        </table>
<?php
    }

    function fomPage($atts, $content = null)
    {
        ob_start();
        $value = shortcode_atts([
            'role' => '',

        ], $atts);
        $this->show_role($value['role']);

        return ob_get_clean();
    }
}
