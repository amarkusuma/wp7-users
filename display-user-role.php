<?php

$users_role = new Users_role();
add_shortcode('wp7_users', [$users_role, 'fomPage']);

class Users_role
{
    function read_users_staff()
    {

        $user_staff = new WP_User_Query(
            array(
                'role' => 'Staff',
                'number' => 5
            )
        );
        return $user_staff->get_results();
    }
    function read_users_manager()
    {
        $user_manager = new WP_User_Query(
            array(
                'role' => 'Manager',
                'number' => 5
            )
        );
        return $user_manager->get_results();
    }

    function read_users_staff_and_manager()
    {
        $user_staff = $this->read_users_staff();
        $user_manager = $this->read_users_manager();
        $user_merge = array_merge($user_staff, $user_manager);
        return $user_merge;
    }

    function show_role($staff, $manager)
    {
?>
        <table border="1" cellpadding="0" cellspacing="0">
            <tr>

                <th>Name</th>
                <th>Email</th>
                <th>Role</th>

            </tr>
            <?php
            if (!empty($staff)) {
                $display_users_staff = $this->read_users_staff();
                foreach ($display_users_staff as $data) {
            ?>
                    <tr>
                        <td><?php echo $data->display_name; ?></td>
                        <td><?php echo $data->user_email; ?></td>
                        <td><?php echo $data->roles[0]; ?></td>
                    </tr>
                <?php
                }
            } elseif (!empty($manager)) {
                $display_users_manager = $this->read_users_manager();
                foreach ($display_users_manager as $data) {
                ?>
                    <tr>
                        <td><?php echo $data->display_name; ?></td>
                        <td><?php echo $data->user_email; ?></td>
                        <td><?php echo $data->roles[0]; ?></td>
                    </tr>
                <?php
                }
            } else {
                $display_users_staff_and_manager = $this->read_users_staff_and_manager();
                foreach ($display_users_staff_and_manager as $data) {
                ?>
                    <tr>
                        <td><?php echo $data->display_name; ?></td>
                        <td><?php echo $data->user_email; ?></td>
                        <td><?php echo $data->roles[0]; ?></td>
                    </tr>
            <?php
                }
            }
            ?>
        </table>
<?php
    }

    function fomPage($atts, $content = null)
    {
        ob_start();
        $this->read_users_manager();
        $this->read_users_staff();
        $this->read_users_staff_and_manager();

        $value = shortcode_atts([
            'staff' => '',
            'manager' => ''
        ], $atts);
        $this->show_role($value['staff'], $value['manager']);
        return ob_get_clean();
    }
}
