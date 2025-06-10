<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sizes;
use Illuminate\Http\Request;

class AdminSizeController extends Controller
{
    private $sizes;

    public function __construct(Sizes $sizes)
    {
        $this->sizes = $sizes;    
    }

    public function index()
    {
        $sizes = $this->sizes->paginate(10);

        return view('admin.sizes.index', compact('sizes'));
    }

    public function create()
    {
        return view('admin.sizes.add');
    }

    public function store(Request $request)
    {
        $result = $this->sizes->create([
            'name' => $request->name,
        ]);

        if($result) {
            return redirect()->route('sizes.index');
        }
    }

    public function edit(string $id)
    {
        $size = $this->sizes->find($id);
        return view('admin.sizes.edit', compact('size'));
    }

    public function update(string $id, Request $request)
    {
        $result = $this->sizes->find($id)->update([
            'name' => $request->name
        ]);

        if($result) {
            return redirect()->route('sizes.index');
        }
    }

    public function delete(string $id)
    {
        $result = $this->sizes->find($id)->delete();

        if($result) {
            return redirect()->route('sizes.index');
        }
    }
}
