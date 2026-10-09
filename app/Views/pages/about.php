<?= $this->include('partials/head', ['title' => $title]) ?>
<?= $this->include('partials/nav') ?>
<main class="page-shell page-narrow">
    <section class="page-heading">
        <div>
            <p class="eyebrow">ABOUT THIS PROJECT</p>
            <h1>POS Accounts</h1>
            <p class="muted">A minimal account manager built with CodeIgniter 4.</p>
        </div>
    </section>
    <section class="panel about-panel">
        <h2>Forms, validation, and uploads</h2>
        <p>This project demonstrates customer and user account forms, server-side validation, database updates, and display-ready user avatars.</p>
        <div class="about-meta"><span>Framework</span><strong>CodeIgniter 4</strong></div>
        <div class="about-meta"><span>Database</span><strong>MySQL</strong></div>
    </section>
</main>
<?= $this->include('partials/foot') ?>
