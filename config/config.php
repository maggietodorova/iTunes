<?php
session_start();

const DATABASE_HOST = 'localhost';
const DATABASE_USERNAME = 'root';
const DATABASE_PASSWORD = '';
const DATABASE = 'itunes';

$connect = mysqli_connect(DATABASE_HOST, DATABASE_USERNAME, DATABASE_PASSWORD, DATABASE);
mysqli_set_charset($connect, 'utf8');