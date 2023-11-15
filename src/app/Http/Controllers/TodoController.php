<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoRequest;
use App\Todo;


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

    public function store(TodoRequest $request)
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

    // 更新処理を行う前にバリデーションを行うのが、バリデーションをするタイミングの中で一番良い。（不正な値が存在する時点で更新処理を行う必要がないから）
    public function update(TodoRequest $request, $id)
    {
        $inputs = $request->all();
        $todo = $this->todo->find($id);
        $todo->fill($inputs);
        $todo->save();
        // dd($this->todo->id, $todo->id);
        return redirect()->route('todo.show', $todo->id);
    }

    public function delete($id)
    {
        $todo = $this->todo->find($id);
        $todo->delete();
        return redirect()->route('todo.index');
    }
}
