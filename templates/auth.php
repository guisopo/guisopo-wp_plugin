<form id="guisopo-auth-form" action="#" method="post" data-url="<?php echo admin_url('admin-ajax.php'); ?>">
    <div class="auth-btn">
        <input class="submit_button" type="button" value="Login" id="guisopo-show-auth-form">
    </div>
    <div id="guisopo-auth-container" class="auth-container">
        <a id="guisopo-auth-close" class="close" href="#">&times;</a>
        <h2>Site Login</h2>
        <label for="username">Username</label>
        <input id="username" type="text" name="username">
        <label for="password">Password</label>
        <input id="password" type="password" name="password">
        <input class="submit_button" type="submit" value="Login" name="submit">
        <p class="status" data-message="status"></p>

        <p class="actions">
            <a href="<?php echo wp_lostpassword_url(); ?>">Forgot Password?</a> - <a href="<?php echo wp_registration_url(); ?>">Register</a>
        </p>
        
        <input type="hidden" name="action" value="guisopo_login">
        <?php wp_nonce_field( 'ajax-login-nonce', 'guisopo_auth' ); ?>
    </div>
</form>