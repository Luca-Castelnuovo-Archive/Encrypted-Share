<?php

require $_SERVER['DOCUMENT_ROOT'] . '/includes/init.php';

if (isset($_GET['request_access'])) {
    auth_get_authorization_code($GLOBALS['config']->client_id, 'basic:read');
}

?>
<!DOCTYPE html>
<html>

<head>
    <!-- Config -->
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link rel="manifest" href="/manifest.json"></link>
    <title>Create Message || Share</title>

    <!-- SEO -->
    <link href="https://share.lucacastelnuovo.nl" rel="canonical">
    <meta content="A system to securely share secrets" name="description">

    <!-- Icons -->
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdn.lucacastelnuovo.nl/general/css/materialize.css">
    <style>.input-field input:focus+label{color:#2962ff!important}.input-field input:focus{border-bottom:1px solid #2962ff!important;box-shadow:0 1px 0 0 #2962ff!important}</style>
    <style>textarea.materialize-textarea:focus+label{color:#2962ff!important} textarea.materialize-textarea:focus{border-bottom:1px solid #2962ff!important;box-shadow:0 1px 0 0 #2962ff!important}</style>
</head>

<body>
    <div class="row">
        <div class="col s12 m8 offset-m2 l4 offset-l4">
            <div class="card">
                <div class="card-action blue accent-4 white-text">
                    <h3>Create Message</h3>
                </div>
                <div id="container" class="card-content">
                    <div class="row">
                        <div class="input-field col s12">
                            <textarea id="inputMessage" class="materialize-textarea"></textarea>
                            <label for="message">Message</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input id="inputExpires" type="number" value="86400">
                            <label for="expires">Expires (in seconds from now)</label>
                        </div>
                    </div>
                    <div class="row">
                        <input id="access_token" type="hidden" value="<?= $_GET['access_token'] ?>">
                        <button id="submitBtn" class="col s12 btn-large waves-effect blue accent-4">
                            Create Message
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.lucacastelnuovo.nl/general/js/materialize.js"></script>
    <script src="https://cdn.lucacastelnuovo.nl/share.lucacastelnuovo.nl/js/create_message.js"></script>

    <?php if (!isset($_GET['access_token'])) { ?>
        <div class="modal">
            <div class="modal-content">
                <h4>Access denied</h4>
                <p>You have to login before you can use this page.</p>
            </div>
            <div class="modal-footer">
                <a onClick='window.location.replace("/create?request_access");' class="btn-small waves-effect blue accent-4">Login</a>
                <a onClick='window.location.replace("/");' class="btn-small waves-effect blue accent-4">Home</a>
            </div>
        </div>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Define modal
                var elems = document.querySelectorAll('.modal');
                var instances = M.Modal.init(elems, {dismissible: false});

                // Open modal
                var elem = document.querySelector('.modal');
                var instance = M.Modal.getInstance(elem);
                instance.open();
            });
        </script>
    <?php } ?>

</body>

</html>
