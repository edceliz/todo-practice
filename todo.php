<?php
    require_once('autoload.php');

    $controller = new Application\Controllers\TodoController();

    $result = false;
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['type'])) {
        switch ($_POST['type']) {
            case 'Save':
                if (isset($_POST['id'])) {
                    $result = $controller->update($_POST);
                } else {
                    $result = $controller->create($_POST);
                }
                break;
            case 'Complete':
                $result = $controller->complete($_POST);
                break;
            case 'Delete':
                $result = $controller->delete($_POST);
                break;
        }
    }

    if ($result) {
        header('location: index.php');
        die();
    }

    $edit = false;
    if (isset($_GET['edit'])) {
        $edit = $controller->get($_GET);
        $edit = isset($edit->id) ? $edit : false;
    }

    require_once('layout/header.html');
?>

<form class="todo_form" action="todo.php" method="POST">
    <input type="text" name="title" placeholder="Title" value="<?= $edit->title ?? null ?>" required>
    <input type="text" name="todo" placeholder="Description" value="<?= $edit->todo ?? null ?>" required>
    <?php if ($edit): ?>
    <input type="hidden" name="id" value="<?= $edit->id ?>">
    <?php endif; ?>
    <input type="submit" name="type" value="Save">
</form>

<?php
    require_once('layout/footer.html');
?>