<?php

namespace App\Http\Controllers\ToDo;

use App\Http\Controllers\Controller;
use App\Models\ToDo;
use Illuminate\Http\Request;

class ToDoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $max_data = 3;

        if (request('search')) {
            $data = ToDo::where('task', 'like', '%' . request('search') . '%')->paginate($max_data)->withQueryString();
        } else {
            $data = ToDo::orderBy('task', 'asc')->paginate($max_data);
        }
        return view('todo.app', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'task' => 'required|min:3|max:50'
        ], [
            'task.required' => 'Kolom task wajib diisikan',
            'task.min' => 'Minimal isian untuk task adalah 3 karakter',
            'task.max' => 'Maksimal isian untuk task adalah 50 karakter',
        ]);

        $data = [
            'task' => $request->input('task')
        ];

        ToDo::create($data);
        return redirect()->route('todo')->with('success', 'Berhasil simpan data');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'task' => 'required|min:3|max:50'
        ], [
            'task.required' => 'Kolom task wajib diisikan',
            'task.min' => 'Minimal isian untuk task adalah 3 karakter',
            'task.max' => 'Maksimal isian untuk task adalah 50 karakter',
        ]);

        $data = [
            'task' => $request->input('task'),
            'is_done' => $request->input('is_done')
        ];

        ToDo::where('id', $id)->update($data);
        return redirect()->route('todo')->with('success', 'Berhasil update data');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        ToDo::where('id', $id)->delete();
        return redirect()->route('todo')->with('success', 'Berhasil menghapus data');
    }
}
