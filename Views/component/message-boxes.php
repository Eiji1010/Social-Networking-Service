<?php
$success = \Response\FlashData::getFlashData('success');
$error = \Response\FlashData::getFlashData('error');
?>


<div class="">
    <?php if ($success): ?>
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative text-center" role="alert">
            <?php echo htmlspecialchars($success); ?>
        </div>
    <?php endif; ?>

    <?php if ($error): ?>
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative text-center" role="alert">
            <?php echo htmlspecialchars($error); ?>
        </div>
    <?php endif; ?>
</div>