<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;


class WishlistController extends Controller
{
    public function index()
    {
        return view('frontend.wishlist.index');
    }
}
