<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MemberController extends Controller
{
  //Index method for Admin Controller
  public function index()
  {
    return view('member.home');
  }

  public function __construct()
  {
    $this->middleware('auth');
    $this->middleware('role:ROLE_MEMBER');
  }
}
