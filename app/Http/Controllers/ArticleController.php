<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Article;
use App\Models\Image;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ArticleRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class ArticleController extends Controller
{
    use AuthenticatesUsers;

    public function __construct()
    {
        parent::__construct();
    }

    public function index($slug = null)
    {
        $articles = Article::with('images')->get();

        return view('articles.index', [
            'articles' => $articles
        ]);
    }

    public function create()
    {
        $user = Auth::user();
        return view('articles.create', compact('user'));
    }

    public function store(ArticleRequest $request)
    {
        $request->request->set('user_id', Auth::id());
        $files = $request->file('filenames');

        $article = Article::create($request->except(['filenames']));
        $articleId = $article->id;

        if($files) {

            foreach($files as $file) {
                $name = time().'.'.$file->getClientOriginalName();
                $file->move('image', $name);
                $images[] = $name;
                Image::insert(['image'=> $name, 'user_id' => Auth::id(), 'article_id' => $articleId]);
            }
        }

        if($article !== null && !empty($images)) {

            return redirect()->back()->with('alert-success', 'Votre annonce à bien été publiée.');
        }
        return redirect()->back()->with('alert-danger', 'Un problème est survenue, image et catégorie obligatoire !');
    }


    public function show($id)
    {
        $article = Article::findOrFail($id);
        $user = User::findOrFail($article->user_id);
        return view('articles.show', compact('article', 'user'));
    }

    public function edit($id)
    {
        $article = Article::findOrFail($id);
        if (! Gate::allows('owner-article', $article)) {
            abort(403);
        }

        return view('articles.edit', compact('article'));
    }

    public function update(ArticleRequest $request, $id)
    {
        $article = Article::findOrFail($id);
        if (! Gate::allows('owner-article', $article)) {
            abort(403);
        }

        $request->request->set('user_id', $article->user_id);
        $files = $request->file('filenames');

        $article->update($request->except(['filenames']));
        $articleId = $article->id;

        $allAttr = $request->toArray();

        $arrImgDel = array();
        foreach($allAttr as $attr => $value) {
            if($value === "off" ) {
                array_push($arrImgDel, str_replace('_', ".", $attr));
            }
        }

        foreach ($arrImgDel as $delImg) {

            if(File::exists(public_path('image/'.$delImg))){
                File::delete(public_path('image/'.$delImg));
            }else{
                dd('File does not exists. '. $delImg);
            }
            DB::table('images')->where('article_id', '=', $articleId)->where("image", '=', $delImg)->delete();
        }

        $arrImgDb = DB::table('images')->where('article_id', '=', $articleId)->where("user_id", '=', $article->user_id)->get()->toArray();

        if($files) {
            $imageSend = [];
            $imageDb = [];
            foreach($arrImgDb as $fileDb) {
                $fileDb = substr($fileDb->image, strpos($fileDb->image, '.') +1);
                array_push($imageDb, $fileDb);
            }

            foreach($files as $file) {
                if(!in_array($file->getClientOriginalName(), $imageDb)) {
                    array_push($imageSend, $file);
                }
            }

            foreach($imageSend as $file) {
                $name = time().'.'.$file->getClientOriginalName();
                $file->move('image', $name);
                $images[] = $name;
                Image::insert( ['image'=> $name, 'user_id' => Auth::id(), 'article_id' => $articleId]);
            }
        }

        if($article !== null) {

            return redirect()->back()->with('alert-success', 'Votre annonce à bien été publiée.');
        }
        return redirect()->back()->with('alert-danger', 'Un problème est survenue');
    }


    public function destroy($id)
    {
        $article = Article::findOrFail($id);
        if (! Gate::allows('owner-article', $article)) {
            abort(403);
        }
        $dbImages = DB::table('images')->where('article_id', '=', $id)->get();

        foreach($dbImages as $image) {

            if(File::exists(public_path('image/'.$image->image))){
                File::delete(public_path('image/'.$image->image));
            }else{
                dd('File does not exists. '. $image->image);
            }
            DB::table('images')->where('article_id', '=', $id)->delete();
        }

        $article->delete();
        return redirect()->route('home.index');
    }

    public function searchArticle(Request $request) {

        $articles = Article::when($request->searchTitle, function($query) use ($request){
            $query->where("title", "LIKE", "%$request->searchTitle%");
        })->when($request->category, function($query) use ($request) {
            $query->where("category", "=", "$request->category");
        })->when(($request->priceMin && $request->priceMax), function($query) use ($request) {
            $query->whereBetween('price', [$request->priceMin, $request->priceMax]);
        })->when($request->order === "priceAsc", function($query) use ($request) {
            $query->orderBy('price','asc');
        })->when($request->order === "priceDesc", function($query) use ($request) {
                $query->orderBy('price','desc');
        })->get();

        if(empty($request->searchTitle) && empty($request->category) && empty($request->priceMin) &&
            (empty($request->priceMin) ||empty( $request->priceMax)) && empty($request->order)) {
            $articles = Article::all();
        }

        return view('articles.index', [
            'articles' => $articles,
        ]);

    }
}
