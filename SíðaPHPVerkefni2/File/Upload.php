<?php
 namespace File;
 class Upload {
 	 protected $destination;
	 protected $max = 51200;
	 protected $messages = [];
	 protected $permitted = [
	 'image/gif',
	 'image/jpeg',
	 'image/pjpeg',
	 'image/png'
	 ];
	 public function __construct($path) {
	 if (!is_dir($path) || !is_writable($path)) {
	 throw new \Exception("$path must be a valid,writable directory.");
	 }
	 $this->destination = $path;
	 }
 }
