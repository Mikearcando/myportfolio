<?php
// === Basisconfiguratie ===
// Pas deze waarden aan voor jouw server.
$DB_HOST = getenv('DB_HOST') ?: 'localhost';
$DB_NAME = getenv('DB_NAME') ?: 'portfolio_db';
$DB_USER = getenv('DB_USER') ?: 'portfolio_user';
$DB_PASS = getenv('DB_PASS') ?: 'portfolio_pass';

$BASE_URL = rtrim(getenv('BASE_URL') ?: '/', '/'); // bv. '' of 'https://mikeaarnoutse.nl'
$UPLOAD_DIR = __DIR__ . '/../uploads'; // server pad
$UPLOAD_URL = $BASE_URL . '/uploads';   // publieke url

// Session
session_name('portfolio_admin');
session_start();
