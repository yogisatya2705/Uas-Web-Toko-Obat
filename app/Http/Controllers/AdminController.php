<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Barang;
use App\Supplier;
use App\Pembelian;
use App\User;
use App\RoleUser;

class AdminController extends Controller
{
  //Index method for Admin Controller
  public function index()
  {
    return view('admin.home');
  }

  public static function NotifUltah()
  {
    $dataulangtahun = User::where('tgllahir', date("Y-m-d"))->get();
    // dd($dataulangtahun);

    return $dataulangtahun;
  }

  public static function NotifObat()
  {
    $datahabis = Pembelian::with('users', 'barang')->where('tgl_habis', date("Y-m-d"))->get();
    // dd($dataulangtahun);

    return $datahabis;
  }

  public function __construct()
  {
    $this->middleware('auth');
    $this->middleware('role:ROLE_ADMIN');
  }

  function AI($id, $sep)
  {
    list(, $idtemp) = explode($sep, $id);
    $idtemp = (int)$idtemp;
    $idtemp++;
    $idtemp = (string)$idtemp;

    $idtemp2 = "";

    $id = strlen($idtemp);

    for ($i = $id; $i < 3; $i++) {
      $idtemp2 = $idtemp2 . '0';
    }

    $id = $sep . $idtemp2 . $idtemp;

    return $id;
  }

  public function ShowDashboard()
  {
    // $jbarang = DB::table('barang')
    // ->select(DB::raw('COUNT(*) AS \'val\''))
    // ->first();
    // $jpemb = DB::table('pembelian')
    // ->select(DB::raw('COUNT(*) AS \'val\''))
    // ->first();
    // $jsup = DB::table('supplier')
    // ->select(DB::raw('COUNT(*) AS \'val\''))
    // ->first();

    $jbarang = Barang::all()->groupBy('id')->count();
    $jpemb = Pembelian::all()->groupBy('id')->count();
    $jsup = Supplier::all()->groupBy('id')->count();

    return view('admin/page/homepage', ['jbarang' => $jbarang, 'jpemb' => $jpemb, 'jsup' => $jsup]);
  }

  public function ShowSupInput()
  {
    $iddb = Supplier::select('id')
      ->orderBy('id', 'desc')
      ->first();

    $id = "";

    if ($iddb) {
      $id = $this->AI($iddb->id, "S-");
    } else {
      $id = "S-001";
    }

    return view('admin/page/sup', ['act' => 'showinput', 'id' => $id]);
  }
  public function ShowSupList()
  {
    $listdata = Supplier::all();
    return view('admin/page/sup', ['act' => 'showlist', 'listdata' => $listdata]);
  }
  public function ShowSupDelete($id)
  {
    $listdata = Supplier::all();
    return view('admin/page/sup', ['act' => 'showlist', 'listdata' => $listdata, 'val_del' => $id]);
  }
  public function ShowSupEdit($id)
  {
    // $listdata = DB::table('supplier')->where('id', '=', $id)->first();
    $listdata = Supplier::find($id);

    return view('admin/page/sup', ['act' => 'showedit', 'listdata' => $listdata]);
  }

  public function ShowMembInput()
  {
    return view('admin/page/memb', ['act' => 'showinput']);
  }

  public function ShowMembListMsg($msg)
  {
    $datauser = User::whereHas('roles', function ($query) {
      $query->where('name', 'ROLE_MEMBER');
    })->get();


    return view('admin/page/memb', ['act' => 'showlist', 'listdata' => $datauser, 'msg' => $msg]);
  }

  public function ShowMembList()
  {
    $datauser = User::whereHas('roles', function ($query) {
      $query->where('name', 'ROLE_MEMBER');
    })->get();


    return view('admin/page/memb', ['act' => 'showlist', 'listdata' => $datauser]);
  }

  public function ShowMembEdit($id)
  {
    $listdata = User::where('id', $id)->first();

    return view('admin/page/memb', ['act' => 'showedit', 'listdata' => $listdata]);
  }

  public function ShowMembDel($id)
  {
    $datauser = User::whereHas('roles', function ($query) {
      $query->where('name', 'ROLE_MEMBER');
    })->get();


    return view('admin/page/memb', ['act' => 'showlist', 'listdata' => $datauser, 'val_del' => $id]);
  }

  public function ProsesMembDel($id)
  {
    try {
      // $del = DB::table('supplier')->where('id', '=', $id)->delete();
      $del = User::destroy($id);
      $del = RoleUser::where('user_id', $id)->delete();
    } catch (\Illuminate\Database\QueryException $e) {
      // $listdata = DB::table('supplier')->get();
      $err = $e->errorInfo;
      return redirect('memb/showlist/6');
    }

    // $listdata = DB::table('supplier')->get();
    if ($del) {
      return redirect('memb/showlist/5');
    } else {
      return redirect('memb/showlist/6');
    }
  }

  public function ShowBarInput()
  {
    // $iddb = DB::table('barang')
    //   ->select('id')
    //   ->orderBy('id', 'desc')
    //   ->first();

    $iddb =  Barang::select('id')->orderBy('id', 'desc')->first();

    $id = "";

    if ($iddb) {
      $id = $this->AI($iddb->id, "B-");
    } else {
      $id = "B-001";
    }

    // $listsup = DB::table('supplier')->select('id', 'nama')->get();
    $listsup = Supplier::select('id', 'nama')->get();

    return view('admin/page/bar', ['act' => 'showinput', 'id' => $id, 'listsup' => $listsup]);
  }
  public function ShowBarList()
  {
    // $listdata = DB::table('barang')->get();
    $listdata = Barang::all();
    return view('admin/page/bar', ['act' => 'showlist', 'listdata' => $listdata]);
  }
  public function ShowBarDetail($id)
  {
    // $listdata = DB::table('barang')->get();
    // $detail_sup = DB::table('supplier')->where('id', '=', $id)->first();
    $listdata = Barang::all();
    $detail_sup = Supplier::where('id', $id)->first();

    return view('admin/page/bar', ['act' => 'showlist', 'listdata' => $listdata, 'detail_sup' => $detail_sup]);
  }
  public function ShowBarDelete($id)
  {
    // $listdata = DB::table('barang')->get();
    $listdata = Barang::all();
    return view('admin/page/bar', ['act' => 'showlist', 'listdata' => $listdata, 'val_del' => $id]);
  }
  public function ShowBarEdit($id)
  {
    // $listdata = DB::table('barang')->where('id', '=', $id)->first();
    // $listsup = DB::table('supplier')->select('id', 'nama')->get();
    $listdata = Barang::where('id', $id)->first();
    $listsup = Supplier::select('id', 'nama')->get();

    return view('admin/page/bar', ['act' => 'showedit', 'listdata' => $listdata, 'listsup' => $listsup]);
  }


  public function ShowPembInput()
  {
    $listdata = Barang::all();

    return view('admin/page/pemb', ['act' => 'showinput', 'listdata' => $listdata]);
  }
  public function ShowPembInputBeli($id)
  {
    $databar = Barang::where('id', $id)->first();
    $datasup = Supplier::where('id', $databar->id_sup)->first();

    // $datauser = User::all();
    $datauser = User::whereHas('roles', function ($query) {
      $query->where('name', 'ROLE_MEMBER');
    })->get();

    return view('admin/page/pemb', ['act' => 'showinputbeli', 'databar' => $databar, 'datasup' => $datasup, 'datauser' => $datauser]);
  }
  public function ShowPembInputBeliMsg($id, $msg)
  {
    $databar = Barang::where('id', $id)->first();
    $datasup = Supplier::where('id', $databar->id_sup)->first();

    // $datauser = User::all();
    $datauser = User::whereHas('roles', function ($query) {
      $query->where('name', 'ROLE_MEMBER');
    })->get();

    return view('admin/page/pemb', ['act' => 'showinputbeli', 'databar' => $databar, 'datasup' => $datasup, 'datauser' => $datauser, 'msg' => $msg]);
  }
  public function ShowPembList()
  {
    // $listdata = DB::table('pembelian')->get();
    // $listdata = Pembelian::all();
    $listdata = Pembelian::has('users')->get();
    // dd($listdata);

    return view('admin/page/pemb', ['act' => 'showlist', 'listdata' => $listdata]);
  }
  public function ShowPembDetail($id)
  {
    $listdata = Pembelian::all();
    $detail_bar = Barang::where('id', $id)->first();

    return view('admin/page/pemb', ['act' => 'showlist', 'listdata' => $listdata, 'detail_bar' => $detail_bar]);
  }
  public function ShowPembDelete($id)
  {
    $listdata = Pembelian::all();
    return view('admin/page/pemb', ['act' => 'showlist', 'listdata' => $listdata, 'val_del' => $id]);
  }
  public function ShowPembEdit($id)
  {
    $listdata = Pembelian::where('id', $id)->first();
    // $bar = DB::table('barang')->select('id', 'nama', 'harga', 'stok')->where('id', '=', $listdata->id_bar)->first();
    $bar = Barang::select('id', 'nama', 'harga', 'stok')->where('id', $listdata->id_bar)->first();

    return view('admin/page/pemb', ['act' => 'showedit', 'listdata' => $listdata, 'bar' => $bar]);
  }

  public function ProsesSupInput(Request $req)
  {
    $id = $req->id;
    $nama = $req->nama;
    $alamat = $req->alamat;
    $notelp = $req->notelp;
    $msg = 0;

    // $hasil = DB::table('supplier')->insert(
    //   ['id' => $id, 'nama' => $nama, 'alamat' => $alamat, 'telp' => $notelp]
    // );
    $hasil = Supplier::create(['id' => $id, 'nama' => $nama, 'alamat' => $alamat, 'telp' => $notelp]);

    if ($hasil) {
      $msg = 1;
    } else {
      $msg = 2;
    }

    $iddb = Supplier::select('id')
      ->orderBy('id', 'desc')
      ->first();

    $id = "";

    if ($iddb) {
      $id = $this->AI($iddb->id, "S-");
    } else {
      $id = "S-001";
    }

    return view('admin/page/sup', ['act' => 'showinput', 'id' => $id, 'msg' => $msg]);
  }
  public function ProsesSupDelete($id)
  {
    try {
      // $del = DB::table('supplier')->where('id', '=', $id)->delete();
      $del = Supplier::destroy($id);
    } catch (\Illuminate\Database\QueryException $e) {
      // $listdata = DB::table('supplier')->get();
      $listdata = Supplier::all();

      $err = $e->errorInfo;
      return view('admin/page/sup', ['act' => 'showlist', 'listdata' => $listdata, 'msg' => 6]);
    }

    // $listdata = DB::table('supplier')->get();
    $listdata = Supplier::all();
    if ($del) {
      return view('admin/page/sup', ['act' => 'showlist', 'listdata' => $listdata, 'msg' => 5]);
    } else {
      return view('admin/page/sup', ['act' => 'showlist', 'listdata' => $listdata, 'msg' => 6]);
    }
  }
  public function ProsesSupEdit(Request $req)
  {
    $id = $req->id;
    $nama = $req->nama;
    $alamat = $req->alamat;
    $notelp = $req->notelp;
    $msg = 0;

    // $hasil = DB::table('supplier')
    //   ->where('id', '=', $id)
    //   ->update(
    //     ['nama' => $nama, 'alamat' => $alamat, 'telp' => $notelp]
    //   );

    $hasil = Supplier::find($id)->update(['nama' => $nama, 'alamat' => $alamat, 'telp' => $notelp]);

    $msg = 3;
    $listdata = Supplier::all();

    return view('admin/page/sup', ['act' => 'showlist', 'listdata' => $listdata, 'msg' => $msg]);
  }

  public function ProsesBarInput(Request $req)
  {
    $id = $req->id;
    $nama = $req->nama;
    $stok = $req->stok;
    $harga = $req->harga;
    $id_sup = $req->id_sup;
    $point = $req->point;
    $msg = 0;

    // $hasil = DB::table('barang')->insert(
    //   ['id' => $id, 'nama' => $nama, 'stok' => $stok, 'harga' => $harga, 'id_sup' => $id_sup]
    // );

    $hasil = Barang::create(['id' => $id, 'point' => $point, 'nama' => $nama, 'stok' => $stok, 'harga' => $harga, 'id_sup' => $id_sup]);

    if ($hasil) {
      $msg = 1;
    } else {
      $msg = 2;
    }

    // $iddb = DB::table('barang')
    //   ->select('id')
    //   ->orderBy('id', 'desc')
    //   ->first();

    $iddb =  Barang::select('id')->where('id', $id)->first();

    $id = "";

    if ($iddb) {
      $id = $this->AI($iddb->id, "B-");
    } else {
      $id = "B-001";
    }
    // $listsup = DB::table('supplier')->select('id', 'nama')->get();
    $listsup = Supplier::select('id', 'nama')->get();

    return view('admin/page/bar', ['act' => 'showinput', 'id' => $id, 'msg' => $msg, 'listsup' => $listsup]);
  }
  public function ProsesBarDelete($id)
  {
    try {
      // $del = DB::table('barang')->where('id', '=', $id)->delete();
      $del = Barang::destroy($id);
    } catch (\Illuminate\Database\QueryException $e) {
      // $listdata = DB::table('barang')->get();
      $listdata = Barang::all();
      $err = $e->errorInfo;
      return view('admin/page/bar', ['act' => 'showlist', 'listdata' => $listdata, 'msg' => 6]);
    }

    // $listdata = DB::table('barang')->get();
    $listdata = Barang::all();
    if ($del) {
      return view('admin/page/bar', ['act' => 'showlist', 'listdata' => $listdata, 'msg' => 5]);
    } else {
      return view('admin/page/bar', ['act' => 'showlist', 'listdata' => $listdata, 'msg' => 6]);
    }
  }
  public function ProsesBarEdit(Request $req)
  {
    $id = $req->id;
    $nama = $req->nama;
    $stok = $req->stok;
    $harga = $req->harga;
    $id_sup = $req->id_sup;
    $point = $req->point;
    $msg = 0;

    // $hasil = DB::table('barang')
    //   ->where('id', '=', $id)
    //   ->update(
    //     ['nama' => $nama, 'stok' => $stok, 'harga' => $harga, 'id_sup' => $id_sup]
    //   );
    $hasil = Barang::find($id)->update(['point' => $point, 'nama' => $nama, 'stok' => $stok, 'harga' => $harga, 'id_sup' => $id_sup]);

    $msg = 3;
    // $listdata = DB::table('barang')->get();
    $listdata = Barang::all();

    return view('admin/page/bar', ['act' => 'showlist', 'listdata' => $listdata, 'msg' => $msg]);
  }

  public function ProsesPembInput(Request $req)
  {
    // $iddb = DB::table('pembelian')
    //   ->select('id')
    //   ->orderBy('id', 'desc')
    //   ->first();

    $iddb =  Pembelian::select('id')->orderBy('id', 'desc')->first();

    $id = "";

    if ($iddb) {
      $id = $this->AI($iddb->id, "P-");
    } else {
      $id = "P-001";
    }

    $id_bar = $req->idbar;
    // $nama_pemb = $req->nama;
    $jmlh_beli = $req->jumlahbar;
    $total_hrg = $req->total;
    $id_user = $req->nama;
    $point = $req->point;
    $dosis = $req->dosis;
    $total_point = $req->totalpoint;
    $tanggal = date("Y-m-d");
    $obathabis = $jmlh_beli / $dosis;
    $obathabis = ceil($obathabis);
    // dd($obathabis);
    $tgl_habis = date("Y-m-d");
    $tgl_habis = date("Y-m-d", strtotime(($tgl_habis . ' + ' . $obathabis . ' days')));
    $msg = 0;

    $currentpoint = User::find($id_user);

    $isPoint = $req->isPoint;
    if ($isPoint == "1") {
      if ($currentpoint->point < $total_point) {
        $rurl = 'pemb/showinput/beli/' . $id_bar . '/2';
        return redirect($rurl);
      }
      $updatepoint = User::find($id_user)->update(['point' => $currentpoint->point - $total_point]);
    } else {
      $updatepoint = User::find($id_user)->update(['point' => $currentpoint->point + $point]);
    }

    // $hasil = DB::table('pembelian')->insert(
    //   ['id' => $id, 'id_bar' => $id_bar, 'nama_pemb' => $nama_pemb, 'jmlh_beli' => $jmlh_beli, 'total_hrg' => $total_hrg, 'tanggal' => $tanggal]
    // );
    $hasil = Pembelian::create(['id' => $id, 'tgl_habis' => $tgl_habis, 'dosis' => $dosis, 'id_bar' => $id_bar, 'id_user' => $id_user, 'jmlh_beli' => $jmlh_beli, 'total_hrg' => $total_hrg, 'tanggal' => $tanggal]);

    // $jmlhstok = DB::table('barang')
    //   ->select('stok')
    //   ->where('id', '=', $id_bar)
    //   ->first();
    $jmlhstok = Barang::select('stok')->where('id', '=', $id_bar)->first();
    // $updatestok = DB::table('barang')
    //   ->where('id', '=', $id_bar)
    //   ->update(
    //     ['stok' => $jmlhstok->stok - $jmlh_beli]
    //   );
    $updatestok = Barang::find($id_bar)->update(['stok' => $jmlhstok->stok - $jmlh_beli]);

    if ($hasil) {
      $msg = 1;
    } else {
      $msg = 2;
    }

    // // $databar = DB::table('barang')->where('id', '=', $id_bar)->first();
    // $databar = Barang::where('id', $id_bar)->first();
    // // $datasup = DB::table('supplier')->where('id', '=', $databar->id_sup)->first();
    // $datasup = Supplier::where('id', $databar->id_sup)->first();


    // $datauser = User::whereHas('roles', function ($query) {
    //   $query->where('name', 'ROLE_MEMBER');
    // })->get();

    $rurl = 'pemb/showinput/beli/' . $id_bar . '/' . $msg;
    return redirect($rurl);
  }
  public function ProsesPembDelete($id)
  {
    try {
      // $del = DB::table('pembelian')->where('id', '=', $id)->delete();
      $del = Pembelian::destroy($id);
    } catch (\Illuminate\Database\QueryException $e) {
      // $listdata = DB::table('pembelian')->get();
      $listdata = Pembelian::all();
      $err = $e->errorInfo;
      return view('admin/page/pemb', ['act' => 'showlist', 'listdata' => $listdata, 'msg' => 6]);
    }

    // $listdata = DB::table('pembelian')->get();
    $listdata = Pembelian::all();
    if ($del) {
      return view('admin/page/pemb', ['act' => 'showlist', 'listdata' => $listdata, 'msg' => 5]);
    } else {
      return view('admin/page/pemb', ['act' => 'showlist', 'listdata' => $listdata, 'msg' => 6]);
    }
  }
  public function ProsesPembEdit(Request $req)
  {
    $id = $req->id;
    $nama_pemb = $req->namapemb;
    $jmlh_beli = $req->jumlahbar;
    $total_hrg = $req->total;
    $tanggal = $req->tgl;
    $id_bar = $req->idbar;
    $msg = 0;

    $jmlh_beli_db = Pembelian::select('jmlh_beli')
      ->where('id', '=', $id)
      ->first();

    // $hasil = DB::table('pembelian')
    //   ->where('id', '=', $id)
    //   ->update(
    //     ['nama_pemb' => $nama_pemb, 'jmlh_beli' => $jmlh_beli, 'total_hrg' => $total_hrg, 'tanggal' => $tanggal]
    //   );
    $hasil = Pembelian::find($id)->update(['nama_pemb' => $nama_pemb, 'jmlh_beli' => $jmlh_beli, 'total_hrg' => $total_hrg, 'tanggal' => $tanggal]);

    // $jmlhstok = DB::table('barang')
    //   ->select('stok')
    //   ->where('id', '=', $id_bar)
    //   ->first();
    $jmlhstok = Barang::select('stok')->where('id', '=', $id_bar)->first();

    // $updatestok = DB::table('barang')
    //   ->where('id', '=', $id_bar)
    //   ->update(
    //     ['stok' => $jmlhstok->stok - ($jmlh_beli - $jmlh_beli_db->jmlh_beli)]
    //   );
    $updatestok = Barang::find($id_bar)->update(['stok' => $jmlhstok->stok - ($jmlh_beli - $jmlh_beli_db->jmlh_beli)]);


    $msg = 3;
    // $listdata = DB::table('pembelian')->get();
    $listdata = Pembelian::all();
    return view('admin/page/pemb', ['act' => 'showlist', 'listdata' => $listdata, 'msg' => $msg]);
  }
}
