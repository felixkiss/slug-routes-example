<?php

class UsersController extends BaseController
{
    public function index()
    {
        $users = User::all();

        return View::make('users.index', compact('users'));
    }

    public function show(User $user)
    {
        return View::make('users.show', compact('user'));
    }
}