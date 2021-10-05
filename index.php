<?php
session_start();
    ?>
    <style>
        body {
            background-color: lightblue;
        }
        p {
            font-size: 24px;
        }
        .container {
            display:flex;
            justify-content:center;
            align-items:center;
            height:100vh;
        }
    </style>

    <div class="container">
    <form action="questions.php" method="POST">
        <p>Enter your name: <input type="text"
                                   name="username"></p>
        <p>Group number: <input type="number"
                                    name="usergroup"></p>

        <p><input type="submit" name="submit"
                  value="Login"></p>
    </form>
    </div>
<!--
