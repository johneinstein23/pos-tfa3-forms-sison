<?= $this->include('partials/head', ['title' => $title]) ?>
<?= $this->include('partials/nav') ?>
<?php
    $errors = session()->getFlashdata('errors') ?? [];
    $customer = $customer ?? [];
?>
<main class="page-shell page-narrow">
    <a class="back-link" href="<?= site_url('customers') ?>">← Back to customers</a>
    <section class="page-heading compact-heading">
        <div>
            <p class="eyebrow"><?= $editing ? 'UPDATE RECORD' : 'NEW RECORD' ?></p>
            <h1><?= $editing ? 'Edit customer' : 'Add customer' ?></h1>
            <p class="muted">Enter the customer’s contact information.</p>
        </div>
    </section>
    <section class="panel form-panel">
        <?php if (isset($errors['form'])): ?><div class="notice notice-error"><?= esc($errors['form']) ?></div><?php endif; ?>
        <form action="<?= esc($action) ?>" method="post" class="form-stack">
            <?= csrf_field() ?>
            <div class="field">
                <label for="full_name">Full name <span class="required">*</span></label>
                <input id="full_name" name="full_name" type="text" maxlength="100" required value="<?= esc(old('full_name', $customer['full_name'] ?? '')) ?>" autocomplete="name">
                <?php if (isset($errors['full_name'])): ?><p class="field-error"><?= esc($errors['full_name']) ?></p><?php endif; ?>
            </div>
            <div class="field">
                <label for="email">Email <span class="required">*</span></label>
                <input id="email" name="email" type="email" maxlength="100" required value="<?= esc(old('email', $customer['email'] ?? '')) ?>" autocomplete="email">
                <?php if (isset($errors['email'])): ?><p class="field-error"><?= esc($errors['email']) ?></p><?php endif; ?>
            </div>
            <div class="field">
                <label for="phone">Phone <span class="optional">Optional</span></label>
                <input id="phone" name="phone" type="tel" maxlength="20" value="<?= esc(old('phone', $customer['phone'] ?? '')) ?>" autocomplete="tel">
                <?php if (isset($errors['phone'])): ?><p class="field-error"><?= esc($errors['phone']) ?></p><?php endif; ?>
            </div>
            <div class="form-actions">
                <a class="button button-quiet" href="<?= site_url('customers') ?>">Cancel</a>
                <button class="button button-primary" type="submit"><?= $editing ? 'Save changes' : 'Create customer' ?></button>
            </div>
        </form>
    </section>
</main>
<?= $this->include('partials/foot') ?>
