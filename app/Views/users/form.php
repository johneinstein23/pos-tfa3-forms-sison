<?= $this->include('partials/head', ['title' => $title]) ?>
<?= $this->include('partials/nav') ?>
<?php
    $errors = session()->getFlashdata('errors') ?? [];
    $user = $user ?? [];
?>
<main class="page-shell page-narrow">
    <a class="back-link" href="<?= site_url('users') ?>">← Back to users</a>
    <section class="page-heading compact-heading">
        <div>
            <p class="eyebrow"><?= $editing ? 'UPDATE RECORD' : 'NEW RECORD' ?></p>
            <h1><?= $editing ? 'Edit user' : 'Add user' ?></h1>
            <p class="muted"><?= $editing ? 'Update account details or profile photo.' : 'Create a POS user account.' ?></p>
        </div>
    </section>
    <section class="panel form-panel">
        <?php if (isset($errors['form'])): ?><div class="notice notice-error"><?= esc($errors['form']) ?></div><?php endif; ?>
        <form action="<?= esc($action) ?>" method="post" enctype="multipart/form-data" class="form-stack">
            <?= csrf_field() ?>
            <div class="field">
                <label for="username">Username <span class="required">*</span></label>
                <input id="username" name="username" type="text" maxlength="50" required value="<?= esc(old('username', $user['username'] ?? '')) ?>" autocomplete="username">
                <?php if (isset($errors['username'])): ?><p class="field-error"><?= esc($errors['username']) ?></p><?php endif; ?>
            </div>
            <div class="field">
                <label for="full_name">Full name <span class="required">*</span></label>
                <input id="full_name" name="full_name" type="text" maxlength="100" required value="<?= esc(old('full_name', $user['full_name'] ?? '')) ?>" autocomplete="name">
                <?php if (isset($errors['full_name'])): ?><p class="field-error"><?= esc($errors['full_name']) ?></p><?php endif; ?>
            </div>

            <?php if ($editing): ?>
                <div class="field">
                    <label for="avatar">Profile photo <span class="optional">Optional</span></label>
                    <div class="upload-row">
                        <?php $currentAvatar = ! empty($user['avatar']) ? base_url('uploads/avatars/' . rawurlencode($user['avatar'])) : base_url('assets/img/avatar-placeholder.svg'); ?>
                        <img class="avatar avatar-large" src="<?= esc($currentAvatar) ?>" alt="" width="64" height="64">
                        <div class="upload-control">
                            <input id="avatar" name="avatar" type="file" accept=".jpg,.jpeg,.png,image/jpeg,image/png">
                            <p class="field-help">JPG or PNG, maximum 2 MB. The app saves a 256 × 256 display-ready image.</p>
                        </div>
                    </div>
                    <?php if (isset($errors['avatar'])): ?><p class="field-error"><?= esc($errors['avatar']) ?></p><?php endif; ?>
                </div>
            <?php endif; ?>

            <div class="form-actions">
                <a class="button button-quiet" href="<?= site_url('users') ?>">Cancel</a>
                <button class="button button-primary" type="submit"><?= $editing ? 'Save changes' : 'Create user' ?></button>
            </div>
        </form>
    </section>
</main>
<?= $this->include('partials/foot') ?>
