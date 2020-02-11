<?php
$title = "OAUTHCOOP";
include("./top_down/header.html");
echo '<p> SIWES 2019/20 PROJECT </p>';
?>
<div class="container pt-5 mt-5">

    <div class="row">
        <div class="col-4 offset-4">

            <form class="form-group shadow-sm bg-light " action="login.php" method="post">
                <div class="text-center">
                    LOGIN
                </div>

                <div class="form-row pt-3 ">
                    <div class="col-1">
                        <label for="username" class=""><i class="fas fa-user fa-sm"></i></label>
                    </div>
                    <div class="col-11">
                        <input type="username" class="form-control align-self-center" placeholder="username">
                    </div>
                </div>
                <div class="form-row py-1 ">
                    <div class="col-1">
                        <label for="password" class=""><i class="fas fa-key fa-sm"></i></label></div>
                    <div class="col-11">
                        <input type="password" class="form-control align-self-center" placeholder="password">
                    </div>
                </div>
                <div class="text-center py-1">
                    <button class="btn bg-primary" type="submit">Login</button>
                </div>
            </form>
        </div>

    </div>
</div>
<?php
include("./top_down/footer.html");
?>