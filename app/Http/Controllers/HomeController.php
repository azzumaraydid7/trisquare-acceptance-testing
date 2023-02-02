<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PragmaRX\Countries\Package\Countries;
use App\Models\User;

class HomeController extends Controller
{
    public function index() {
        $countries = Countries::all()->pluck('name.common')->toArray();

        $data = [
            'countries' => $countries
        ];

        return view('welcome', $data);
    }

    public function users() {
        $users = User::select('name', 'email', 'date_of_birth', 'country')
            ->paginate();

        $data = [
            'users' => $users
        ];

        return view('users', $data);
    }
}
