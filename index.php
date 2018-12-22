<?php

require $_SERVER['DOCUMENT_ROOT'] . '/includes/init.php';

if (isset($_GET['code'])) {
    $access_token_request = auth_get_access_token($GLOBALS['config']->client_id, $GLOBALS['config']->client_secret, $_GET['code'], $_GET['state']);

    if ($access_token_request['success']) {
        header("location: create/{$access_token_request['access_token']}");
    }
}

?>
<!DOCTYPE html>
<html>

<head>
    <!-- Config -->
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Share</title>

    <!-- SEO -->
    <link href="https://share.lucacastelnuovo.nl" rel="canonical">
    <meta content="A system to securely share secrets" name="description">

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <style>.input-field input:focus+label{color:#2962ff!important}.input-field input:focus{border-bottom:1px solid #2962ff!important;box-shadow:0 1px 0 0 #2962ff!important}</style>
</head>

<body>
    <div class="row">
        <div class="col s12 m8 offset-m2 l4 offset-l4">
            <div class="card">
                <div class="card-action blue accent-4 white-text">
                    <h3>View Message</h3>
                </div>
                <div id="container" class="card-content">
                    <div class="row">
                        <div class="input-field col s12">
                            <input id="inputToken" type="text" value="<?= $_GET['token'] ?>">
                            <label for="token">Token</label>
                        </div>
                    </div>
                    <div class="row">
                        <button id="submitBtn" class="col s12 btn-large waves-effect blue accent-4">
                            View Message
                        </button>
                    </div>
                    <?php if (!isset($_GET['hide'])) { ?>
                        <div class="row">
                            <a href="/create" class="col s12 btn-small waves-effect blue accent-4">Create Message</a>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="/js/view_message.js"></script>
</body>

</html>
