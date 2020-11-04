<?php

interface Account{
	public function login($pdo);
	public function register($pdo);
    public function changepassword($pdo);
    public function logout($pdo);
}
?>