<?php

namespace App\Http\Controllers;

use App\Models\ErrorItem;
use Illuminate\Http\Request;

class ErrorItemController extends Controller
{
    // Show create form
public function index()
{
    $errorItems = ErrorItem::all();
    return view('error_items.index', compact('errorItems'));
}

    public function create()
    {
        return view('products.create-error-item');
    }

    // Store a new error item
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:error_items',
        ]);

        ErrorItem::create($validated);

        return redirect()->route('error-items.create')->with('success', 'Error item created successfully!');
    }
}
