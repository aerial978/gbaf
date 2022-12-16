<?php
if (isset($errorMsg)) { ?>
    <div class="error-msg">
        <?php echo $errorMsg; ?>
    </div>
<?php }

if (isset($successMsg)) { ?>
    <div class="success-msg">
        <?php echo $successMsg; ?>
    </div>
<?php }

if (isset($_SESSION['successMsg'])) { ?>
    <div class="success-msg">
        <?php echo $_SESSION['successMsg']; ?>
    </div>
<?php } ?>
