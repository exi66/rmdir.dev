<?php
  session_start();
  $_SESSION['__token'] = md5(uniqid(mt_rand(), true));
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="csrf-token" content="<?= $_SESSION['__token'] ?>">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="/favicon.ico">
    <link rel="stylesheet" href="./assets/main.css?<?= rand() ?>"/>
    <script defer type="module" src="./assets/main.js?<?= rand() ?>"></script>
    <title>About me</title>
  </head>
  <body id="app" style="margin: 0;">
    <noscript>
      <div style="background-color: #222222; height: 100vh; width: 100vw; text-align: center; font-family: Roboto, Arial, sans-serif; color: white; display: flex; justify-content: center; flex-direction: column;">
        <h1 style="margin: 0;">Sorry, this site requires <span style="color: #c34528">javascript</span></h1>
        <p style="margin: .5rem;">Your browser does not support it or you have disabled it</p>
      </div>
    </noscript>
  </body>
</html>
