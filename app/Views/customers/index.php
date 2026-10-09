<?= $this->include('partials/head', ['title' => $title]) ?>
<?= $this->include('partials/nav') ?>
<main class="page-shell">
    <?= $this->include('partials/flash') ?>
    <section class="page-heading">
        <div>
            <p class="eyebrow">ACCOUNTS</p>
            <h1>Customers</h1>
            <p class="muted">Manage customer contact details.</p>
        </div>
        <a class="button button-primary" href="<?= site_url('customers/new') ?>">Add customer <span aria-hidden="true">＋</span></a>
    </section>

    <section class="panel">
        <?php if ($customers === []): ?>
            <div class="empty-state">
                <h2>No customers yet</h2>
                <p>Add the first customer to get started.</p>
            </div>
        <?php else: ?>
            <div class="table-wrap">
                <table>
                    <thead>
                    <tr><th>Name</th><th>Email</th><th>Phone</th><th>Created</th><th><span class="sr-only">Actions</span></th></tr>
                    </thead>
                    <tbody>
                    <?php foreach ($customers as $customer): ?>
                        <tr>
                            <td class="primary-cell"><?= esc($customer['full_name']) ?></td>
                            <td><?= esc($customer['email']) ?></td>
                            <td><?= esc($customer['phone'] ?: '—') ?></td>
                            <td><?= esc(date('M j, Y', strtotime($customer['created_at']))) ?></td>
                            <td class="action-cell"><a class="text-link" href="<?= site_url('customers/' . $customer['id'] . '/edit') ?>">Edit</a></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </section>
    <p class="page-note">Showing <?= count($customers) ?> customer<?= count($customers) === 1 ? '' : 's' ?>.</p>
</main>
<?= $this->include('partials/foot') ?>
