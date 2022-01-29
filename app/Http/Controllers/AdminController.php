<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function products()
    {
        return view('admin.products.index');
    }

    public function create_product()
    {
        return view('admin.products.create');
    }

    public function list_users()
    {
        return view('admin.users');
    }

    public function categories_index()
    {
        return view('admin.categories.index');
    }

    public function create_category()
    {
        return view('admin.categories.create');
    }

    public function order_index()
    {
        return view('admin.orders.index');
    }

    public function characteristics_index()
    {
        return view('admin.characteristics.index');
    }

    public function create_characteristics()
    {
        return view('admin.characteristics.create');
    }

    public function reports()
    {
        return view('admin.reports.index');
    }
}
