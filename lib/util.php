<?php

	function console_log($data) {
		echo "<script>console.log($data);</script>";
	}
	
	function alert($msg) {
		echo '<script>alert("' . $msg . '");</script>';
	}

	function redirect($url) {
		echo '<script>location.href="' . $url . '";</script>';
	}