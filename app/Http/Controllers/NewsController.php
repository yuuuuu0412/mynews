<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\HTML;

use App\News;

class NewsController extends Controller
{
  public function index(Request $request)
  {
    $cond_title = $request->cond_title;
    /* $cond_titleが空白でない場合（＝検索ワードがリクエストされている場合）は、
    記事を検索して取得する*/
    if ($cond_title != ''){
      $posts = News::where('title', $cond_title).orderBy('updated_at', 'desc')->get();
    } else {
      $posts = News::all()->sortByDesc('updated_at');
    }
    if (count($posts) > 0) {
      $headline = $posts->shift();//$postsの最初の要素だけ切り取って代入している
    } else {
      $headline = null;
    }
    // news/index.blade.php ファイルを渡している
    // また view テンプレートに headline, posts, cond_title という変数を渡している
    return view('news.index', ['headline' => $headline, 'posts' => $posts,
  'cond_title' => $cond_title]);
  }
}
