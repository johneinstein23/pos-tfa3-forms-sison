<?php if ($message = session()->getFlashdata('message')): ?>
    <div class="notice notice-success" role="status"><?= esc($message) ?></div>
<?php endif; ?>
