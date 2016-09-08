<?php
  if (isset($_GET['title'] || $_GET['artist'])) {
    $title = $_GET['title'];
    $artist = $_GET['artist'];
  } else {
    die("");
  }

  dbSearch($title, $artist);
?>
