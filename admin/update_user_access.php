  <link rel="stylesheet" href="plugins/sweetalert2/sweetalert2.css">
  <script src="plugins/sweetalert2/sweetalert2.js"></script>

<?php
include '../config.php';




if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = isset($_POST['user_id']) ? intval($_POST['user_id']) : 0;
    $selected_menus = isset($_POST['menus']) ? $_POST['menus'] : [];

    if ($user_id > 0) {
        // Delete old access
        $con->query("DELETE FROM user_menu_access WHERE user_id = $user_id");

        // Insert new access
        foreach ($selected_menus as $menu_id) {
            $menu_id = intval($menu_id);
            $con->query("INSERT INTO user_menu_access (user_id, menu_id) VALUES ($user_id, $menu_id)");
        }

header("Location: view_users");
exit();
    } else {
        echo "Invalid user ID.";
    }
}
?>

