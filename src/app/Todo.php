<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    //
    protected $table = 'todos';
    protected $fillable = [
        'content'
    ];
    // fillableプロパティを使用することで、モデルクラスでfillメソッドを使用して、データを保存することができる。
    // 今回は'content' カラムだけだが、複数のカラムを保存するときにfillメソッドを使用することで、記述する量を省くことができる。
}
