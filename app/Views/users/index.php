<?= $this->include('partials/head', ['title' => $title]) ?>
<?= $this->include('partials/nav') ?>
<main class="page-shell">
    <?= $this->include('partials/flash') ?>
    <section class="page-heading">
        <div>
            <p class="eyebrow">TEAM ACCESS</p>
            <h1>Users</h1>
            <p class="muted">Manage POS user accounts and profile photos.</p>
        </div>
        <a class="button button-primary" href="<?= site_url('users/new') ?>">Add user <span aria-hidden="true">＋</span></a>
    </section>

    <section class="panel">
        <?php if ($users === []): ?>
            <div class="empty-state">
                <h2>No users yet</h2>
                <p>Add a user account to get started.</p>
            </div>
        <?php else: ?>
            <div class="table-wrap">
                <table>
                    <thead>
                    <tr><th>User</th><th>Username</th><th>Created</th><th><span class="sr-only">Actions</span></th></tr>
                    </thead>
                    <tbody>
                    <?php foreach ($users as $user): ?>
                        <?php $avatarUrl = ! empty($user['avatar']) ? base_url('uploads/avatars/' . rawurlencode($user['avatar'])) : base_url('assets/img/avatar-placeholder.svg'); ?>
                        <tr>
                            <td>
                                <div class="user-cell">
                                    <img class="avatar" src="<?= esc($avatarUrl) ?>" alt="" width="44" height="44">
                                    <span class="primary-cell"><?= esc($user['full_name']) ?></span>
                                </div>
                            </td>
                            <td><span class="username">@<?= esc($user['username']) ?></span></td>
                            <td><?= esc(date('M j, Y', strtotime($user['created_at']))) ?></td>
                            <td class="action-cell"><a class="text-link" href="<?= site_url('users/' . $user['id'] . '/edit') ?>">Edit</a></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </section>
    <p class="page-note">Showing <?= count($users) ?> user<?= count($users) === 1 ? '' : 's' ?>.</p>
</main>
<?= $this->include('partials/foot') ?>
