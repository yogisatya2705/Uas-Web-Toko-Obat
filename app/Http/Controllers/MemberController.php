<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pembelian;

use Auth;

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

  public function ShowDashboard()
  {
    $id = Auth::user()->id;
    $databeli = Pembelian::with('barang')->where('id_user', $id)->get();
    return view('member.home', ['act' => 'showlist','databeli' => $databeli]);
  }
}
