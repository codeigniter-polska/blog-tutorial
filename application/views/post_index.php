<div class="row">
    <div class="span12">
        <!-- Sprawdzamy, czy są jakiekolwiek wpisy w bazie danych -->
        <?php if ($posts): ?>
            <div class="page-header">
                <h1>Dostępne wpisy</h1>
            </div>
            <!-- Dla każdego wpisu wykonujemy pętlę -->
            <?php foreach ($posts as $p): ?>
                <h2><?php echo htmlspecialchars($p['title']); ?></h2>
                <p><?php echo nl2br(htmlspecialchars($p['body'])); ?></p>
                <!-- Sprawdzamy, czy użytkownik jest zalogowany -->
                <?php if ($this->session->userdata('user_id')): ?>
                    <div>
                        <a href="<?php echo site_url('posts/edit/'.$p['id']); ?>" class="btn"><i class="icon-edit"></i> <strong>Edytuj</strong></a>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
            <hr>
            <!-- Wyświetlamy kod html odpowiedzialny za paginację s-->
            <?php echo $pagination; ?>
        <?php else: ?>
            <div class="well">
                Brak wpisów w bazie danych.
            </div>
        <?php endif; ?>
    </div>
</div>