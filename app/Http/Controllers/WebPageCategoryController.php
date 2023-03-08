<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Song;
use Illuminate\Http\Request;

class WebPageCategoryController extends Controller
{
    //
    public $page;
    public $url;
    public function __construct(Request $request)
    {
        $this->page = $request->get('page');
        $this->url = "?page=";
    }

    public function loadView($songs, $title, $ogTitle, $ogDes){
        return view("webpage.categories.index",
            ["songs" => $songs, "page" => $this->page, "url" => $this->url,
                "og_title" => $ogTitle, "og_des" => $ogDes, "title" => $title]);
    }

    public function newestSongs()
    {
        $songs = Song::orderBy("id", "desc")->where("display", 1)->paginate(14);
        return $this->loadView($songs,
            "Neueste Klingeltöne",
            "Neueste Klingeltöne - Kostenlose Klingeltöne herunterladen",
            "Neueste Klingeltöne für Handys - Laden Sie die täglich angesagten Klingeltöne kostenlos mit der schnellsten Geschwindigkeit für Ihr Telefon herunter");
    }
    public function popularSongs()
    {
        $songs = Song::orderBy("listeners", "desc")->where("display", 1)->paginate(14);
        return $this->loadView($songs,
            "Top Klingeltöne",
            "Klingeltöne - Über 1000+ beste Klingeltöne für Mobiltelefone",
            "Beste Klingeltöne - Die Sammlung der am häufigsten heruntergeladenen Klingeltöne");
    }

    public function categorySongs($slug){
        // Slug Solve //
        $category = Category::where("category_slug", $slug)->where("display",1)->first();
        $song = Song::where("slug", $slug)->where("display",1)->first();
        $post = Post::where("slug", $slug)->where("display",1)->first();

        if ($category != null){ // has category

            $songs = Song::where("category_id", $category->id)->where("display", 1)->paginate(10);
            $title = "Baixar Toques Para Celular $category->category_name Grátis";
            $metaDes = "Baixar Toques Para Celular $category->category_name Grátis, Download Ringtone iPhone iphone, android mp3 m4r free ";
            return $this->loadView($songs, $title, $title, $metaDes);

            // return view
        } elseif ($song!= null){ // has Song

            $similarSongs = Song::where("category_id", $song->category_id)
                ->where("display", 1)
                ->where("id", "!=", $song->id)
                ->limit(12)->get();
            $currentListener = $song->listeners;
            Song::where("id", $song->id)->update(["listeners" => $currentListener+1]);
            return view("webpage.song.index",
                ["song" => $song, "similarSongs" => $similarSongs, "og_title" => $song->meta_title,
                    "og_des" => $song->meta_description]);

        } elseif ($post != null){ // has Post

            return view("webpage.post.index", ["post" => $post]);
        }
        else {
            abort("404");
        }
    }

    public function losMejores(){
        $songs  = Song::orderBy("downloads", "desc")->where("display", 1)->paginate(14);
        return $this->loadView($songs,
            "Beste Klingeltöne",
            "Baixar Melhores toques gratis - Best Ringtone Collection",
            "Hier finden Sie eine Liste der meist herunterladen beste klingeltöne charts von unserer Webseite");
    }
    public function search(Request $request, $search){
        $songs = Song::where('title', 'LIKE', "%$search%")->paginate(14);
        return $this->loadView($songs, "Search Results: $search", "You searched for $search",
            "");
    }
}
