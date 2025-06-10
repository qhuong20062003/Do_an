<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Colors;
use Illuminate\Http\Request;

class AdminColorController extends Controller
{
    private $colors;

    public function __construct(Colors $colors)
    {
        $this->colors = $colors;
    }

    public function index()
    {
        $colors = $this->colors->paginate(10);

        return view('admin.colors.index', compact('colors'));
    }

    public function create()
    {
        return view('admin.colors.add');
    }

    public function store(Request $request) 
    {
        $result = $this->colors->create([
            'name' => $request->name,
            'code' => $request->code
        ]);

        if($result) {
            return redirect()->route('colors.index');
        }
    }

    public function edit(string $id)
    {
        $color = $this->colors->find($id);
        return view('admin.colors.edit', compact('color'));
    }

    public function update(string $id, Request $request)
    {
        $result = $this->colors->find($id)->update([
            'name' => $request->name,
            'code' => $request->code
        ]);

        if($result) {
            return redirect()->route('colors.index');
        }
    }

    public function delete(string $id)
    {
        $result = $this->colors->find($id)->delete();
        if($result) {
            return redirect()->route('colors.index');
        }
    }
}
