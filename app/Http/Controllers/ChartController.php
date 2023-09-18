<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ChartController extends Controller
{
    public function categoryDistribution()
    {
        $categories = Category::all();
        $data = [];

        foreach ($categories as $category) {
            $data[] = [
                'label' => $category->name,
                'value' => $category->products->count(),
            ];
        }

        return response()->json($data);
    }
}
