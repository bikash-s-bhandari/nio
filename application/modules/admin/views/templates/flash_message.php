<?php if ($this->session->flashdata('success')): ?>

    <div id="success"><?= $this->session->flashdata('success'); ?></div>
<?php endif; ?>
<?php if ($this->session->flashdata('error')): ?>

    <div id="alert"><?= $this->session->flashdata('error'); ?></div>
<?php endif; ?>