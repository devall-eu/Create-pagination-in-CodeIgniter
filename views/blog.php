<?php if (count($posts) > 0): ?>
    <?php foreach ($posts as $post): ?>
        <div>
            <h1><?php echo $post->title; ?></a></h1>
            <p><?php echo $post->content; ?></p>
        </div>
    <?php endforeach; ?>
    <nav>
        <?php foreach ($links as $link) {
            echo $link;
        } ?>
    </nav>
    <br>
    <div><?php echo $pagermessage; ?></div>
<?php else: ?>
    <p>Sorry, we couldn't find any hits.</p>
<?php endif; ?>