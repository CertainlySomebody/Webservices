<?php

    include 'SOAP/client.php';

    if(!empty($_POST) && isset($_POST) && $_POST) {

        $soapClient = new client;
        $soapClient->login($_POST['email'], $_POST['pswd']);
        $getReq = trim(htmlspecialchars(strip_tags($soapClient->instance->__last_response)));
        if($getReq == 'truetrue') {
            header('location: main.php');
        }
    }

    include 'parts/header.php';
    //phpinfo();
?>

<body>

<div class="formLogin">
    <div class="container">
        <form method="POST">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="type your email" required />
            </div>
            <div class="form-group">
                <label for="pswd">Password</label>
                <input type="password" class="form-control" id="pswd" name="pswd" placeholder="type your password" required />
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>

    </div>
</div>