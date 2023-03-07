<h1>
    <?php esc_html_e( 'Speed Up Translation', 'speed_up_translation' ); ?>
</h1>

<form method="POST" action="<?php echo admin_url( 'admin.php' ); ?>">
    <?php if($_REQUEST['success'] == '1') { ?>
        <div class="notice notice-success">Successfully cleared the cache!</div>
    <?php } ?>
    <p>
        <input type="hidden" name="action" value="speed_up_translation_delete_transients" />
        <input type="submit" value="Clear Cache" />
    </p>
</form>