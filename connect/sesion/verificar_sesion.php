<?php
session_start();

if ($usuario_user==""){
	header("Location:".$web."?nosesion=1");
}
?>