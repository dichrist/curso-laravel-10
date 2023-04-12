<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Support;
use Illuminate\Http\Request;

class SupportController extends Controller
{
    public function index(Support $support)
    {
        $supports = $support->all();
        // dd($supports);

        return view('admin/supports/index', compact('supports'));
    }

    public function show(string|int $id)
    {
        if (!$support = Support::find($id)) {
            return redirect()->route('supports.index');
        }

        return view('admin/supports/show', compact('support'));
    }

    public function create()
    {
        return view('admin/supports/create');
    }

    public function store(Request $request, Support $support)
    {
        $data = $request->all();
        $data['status'] = 'a';

        $support->create($data);
        //dd($request->all());

        return redirect()->route('supports.index');
    }

    public function edit(string|int $id, Support $support) 
    {
        if (!$support = $support->find($id)) {
            return redirect()->route('supports.index');
        }

        return view('admin/supports.edit', compact('support'));
    }

    public function update(string|int $id, Request $request, Support $support)
    {
        if (!$support = $support->find($id)) {
            return redirect()->route('supports.index');
        }

        $support->update($request->only(
            ['subject', 'body'])
        );

        return redirect()->route('supports.index');
    }
}
