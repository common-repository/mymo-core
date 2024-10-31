<?php

require_once (__DIR__ . '/Core/MyMo.php');
require_once (__DIR__ . '/Core/Controller.php');
require_once (__DIR__ . '/Core/Model.php');

foreach (glob(__DIR__ . "/Traits/*.php") as $filename) {
	require_once ($filename);
}

foreach (glob(__DIR__ . "/Walkers/*.php") as $filename) {
	require_once ($filename);
}

foreach (glob(__DIR__ . "/Helpers/*.php") as $filename) {
	require_once ($filename);
}

foreach (glob(__DIR__ . "/Models/*.php") as $filename) {
	require_once ($filename);
}

foreach (glob(__DIR__ . "/Widgets/*.php") as $filename) {
	require_once ($filename);
}

foreach (glob(__DIR__ . "/Tables/*.php") as $filename) {
	require_once ($filename);
}

foreach (glob(__DIR__ . "/Controllers/Backend/*.php") as $filename) {
	require_once ($filename);
}

foreach (glob(__DIR__ . "/Controllers/Frontend/*.php") as $filename) {
	require_once ($filename);
}