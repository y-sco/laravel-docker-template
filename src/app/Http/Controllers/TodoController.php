<?php

namespace App\Http\Controllers;

use App\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    private $todo;

    public function __construct(Todo $todo)
    {
        $this->todo = $todo;
    }

    public function index()
    {
        $todos = $this->todo->all();
        return view('todo.index', ['todos' => $todos]);
        // 第一引数にBladeファイルの指定、第二引数にBlade内で利用できる変数の宣言[Blade内での変数名=>代入したい値]
        dd($todos);
    }

    public function create()
    {
        return view('todo.create');
    }

    public function store(Request $request)
    {
        $inputs = $request->all();
        $this->todo->fill($inputs);
        $this->todo->save();
        return redirect()->route('todo.index');
        // dd($this->todo);
    }

    public function show($id)
    {
        $todo = $this->todo->find($id);
        // findメソッドはそのモデルが対応するテーブルのプライマリーキーを引数に受け取り、その対象レコードを1件取得する。
        // dd(id);
        return view('todo.show', ['todo' => $todo]);
    }

    public function edit($id)
    {
        $todo = $this->todo->find($id);
        return view('todo.edit',['todo' => $todo]);
    }

    public function update(Request $request, $id)
    {
        $inputs = $request->all();
        $todo = $this->todo->find($id);
        $todo->fill($inputs);
        $todo->save();
        dd($this->todo->id, $todo->id);
        return redirect()->route('todo.show', $todo->id);
    }
}
