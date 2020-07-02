<nav class="navbar fixed-top navbar-expand-lg navbar-light white scrolling-navbar">

    <div class="container">

        <!-- Brand -->
        <a class="navbar-brand waves-effect" href="index.php">
            <strong class="blue-text weight-heavy">
                <?php
                require("db.php");
                echo $company; ?>
            </strong>
        </a>

        <!-- Collapse -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Links -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <!-- Left -->
            <?php
            require_once 'navbarElements.php';
            ?>

            <!-- Right -->
            <ul class="navbar-nav nav-flex-icons ">

                <li class="nav-item">
                    <a class="nav-link waves-effect" href="logout.php">
                        Logout
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>