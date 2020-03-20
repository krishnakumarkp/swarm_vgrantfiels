<?php
namespace Application\Lib;
interface UserStore 
{
    public function Create(User $user) : User;
	//public function GetById(string $id) : ?User;
    public function getByUserName(string $userName) : ?User;
} 