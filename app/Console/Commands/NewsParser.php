<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\Log;
use App\Models\News;
use App\Models\Image;
use Carbon\Carbon;

class NewsParser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'parser:start';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Console application for parsing and saving news in local database.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try{
            $response = Http::get('http://static.feed.rbc.ru/rbc/logical/footer/news.rss');

            //Loging response data save in DB
            $log = new Log;
            $log->request_method = "GET";
            $log->request_url   = "http://static.feed.rbc.ru/rbc/logical/footer/news.rss";
            $log->response_code = $response->status();
            $log->response_body = $response->body();
            $log->save();

            $xmlObject = simplexml_load_string($response->body(), 'SimpleXMLElement', LIBXML_NOCDATA);
            $json       = json_encode($xmlObject);
            $phpArray   = json_decode($json, true); 

            for($i = 0; $i < count($phpArray["channel"]["item"]); $i++){
                if($this->checkInDB($phpArray["channel"]["item"][$i]["guid"])){
                    $this->saveNews($phpArray["channel"]["item"][$i]);
                }
            }
        }catch (\Exception $e){
            print($e);
	    }
    }

    public function saveNews(array $item){
        $pubDate = new Carbon($item["pubDate"]);
        $news = new News;
        $news->title = $item["title"];
        $news->link = $item["link"];
        $news->description = $item["description"];
        $news->publication_date = $pubDate->toDateTimeString();
        $news->author = $item["author"] ?? null;
        $news->guid = $item["guid"];
        $news->save();

        if (isset($item["enclosure"])){
            $images = $item["enclosure"];
            if(count($images) == 1){
                $this->saveImage($news->id, $images["@attributes"]["url"]);
            }else{
                for($i = 0; $i < count($images); $i++){
                    $this->saveImage($news->id, $images[$i]["@attributes"]["url"]);
                }
            }
        }
    }

    public function saveImage(int $newsId, string $url){
        $image          = new Image;
        $image->news_id = $newsId;
        $image->url     = $url;
        $image->save();
    }

    //checks the database if there is such a record
    public function checkInDB(string $guid): bool{
       return News::where('guid', $guid)->first() == null;
    }
}
