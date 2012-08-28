<?php
session_start();
session_destroy();
header("Location:../../?nosesion=3");
?>