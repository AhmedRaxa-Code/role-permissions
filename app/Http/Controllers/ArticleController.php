<?php

namespace App\Http\Controllers;

use App\Models\Ariticle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class ArticleController extends Controller implements HasMiddleware
{

public static function middleware():array
{
    return[
            new Middleware('permission:view article', only:['index']),
            new Middleware('permission:update article', only:['edit']),
            new Middleware('permission:create article', only:['create']),
            new Middleware('permission:delete article', only:['delete']),
    
    
    
        ];
}



    //


    public function index()
    {
        $articles = Ariticle::get   ();
        // dd($articles);
       return view('article.list',[
        'articles'=>$articles
       ]);    
    }

    public function create()
    {
        return view('article.create');
    }

    public function store(Request $request)
     {
        $validator =  Validator::make($request->all(),[
            'title' => 'required|min:3',
            'author'=> 'required|min:3'
            ]);
            if($validator->passes())
            {
                 $article = new Ariticle();
                 $article->title = $request->title;
                $article->text =$request->text;
                $article->author =$request->author;
                $article->save();
            
                return redirect()->route('art.index')->with('success','article added successfully');
                          
            }
            else {
                  return redirect()->route('create.art')->withInput()->withErrors($validator);
            }
    }

 
      //this method show edit permission
      public function edit($id)
      {
         $article=Ariticle::findorFail($id);
         return view('article.edit',[
        'article'=> $article 
         ]);
  
      }


      public function update(Request $request ,$id)
      {

         $article =Ariticle::findorFail($id);
        $validator =  Validator::make($request->all(),[
            'title' => 'required|min:3',
            'author'=> 'required|min:3'
            ]);
            if($validator->passes())
            {
            
                 $article->title = $request->title;
                $article->text =$request->text;
                $article->author =$request->author;
                $article->save();
            
                return redirect()->route('art.index')->with('success','article updated  successfully');
                          
            }
            else {
                  return redirect()->route('art.edit')->withInput()->withErrors($validator);
            }
    
      }


     public function destroy($id)

     {
        $art = Ariticle::findorFail($id);
        $art->delete();
        return redirect()->route('art.index')->with('success','article deleted  successfully');

     }


    }
