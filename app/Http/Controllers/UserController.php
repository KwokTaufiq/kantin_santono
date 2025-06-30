<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;

class UserController extends Controller
{
    // tampilan utama
    public function index(Request $request)
    {
        $query = Menu::query();

        if ($request->has('search') && $request->search != '') {
            // Proteksi input ringan dari karakter HTML
            $keyword = strip_tags($request->search);

            $query->where('nama_menu', 'like', '%' . $keyword . '%');
        }

        $menus = $query->get();

        return view('pesan.index', compact('menus'));
    }
}
