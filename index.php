<?php
    require_once('autoload.php');

    $controller = new Application\Controllers\HomeController();

    $todos = $controller->getTodos();

    require_once('layout/header.html');
    foreach ($todos as $todo):
?>

<article class="todo">
    <h3><?= '#' . $todo->id . ' ' . $todo->title ?></h3>
    <p class="meta"><?= $todo->created_at ?></p>
    <p class="content"><?= $todo->todo ?></p>
    <?php if (!$todo->is_completed): ?>
    <div class="action_bar">
        <div class="finish">
            <form action="todo.php" method="POST">
                <input type="hidden" name="post_id" value="<?= $todo->id ?>">
                <input name="type" type="submit" value="Complete">
            </form>
        </div>
        <div class="update">
            <a href="todo.php?edit=<?= $todo->id ?>">Edit</a>
            <form action="todo.php" method="POST">
                <input type="hidden" name="post_id" value="<?= $todo->id ?>">
                <input name="type" type="submit" value="Delete">
            </form>
        </div>
    </div>
    <?php else: ?>
    <div class="complete">
        <p>Task Completed</p>
    </div>
    <?php endif; ?>
</article>
<hr />
<br />

<?php
    endforeach;
    require_once('layout/footer.html');
?>