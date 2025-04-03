<?php

namespace App\Livewire\Front;

use App\Lib\MetaTag;
use Illuminate\Support\Facades\Http;
use App\Models\GaleriModel;
use App\Models\KategoriModel;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Url;
use App\Models\ProdukModel;

class Video extends Component
{
    use WithPagination;

    public $pageTitle = "Video";
    public $pageName = "video";
    public $nextPageToken = "";
    public $prevPageToken = "";
    public $detailVideo;

    #[Url]
    public $katakunci = "", $pageToken = "";

    public function mount()
    {

    }

    public function readVideo()
    {
        $arrSend = collect([
            'key' => 'AIzaSyDAf6XxoWyJE1hNLLft5yHNKerX29JeXXQ',
            'channelId' => 'UCKjpwP4ypg331QRWcdBEQmg',
            'part' => 'snippet, id',
            'order' => 'date',
            'q' => $this->katakunci,
            'maxResults' => '12',
        ]);

        if(!empty($this->pageToken))
            $arrSend->put('pageToken', $this->pageToken);

        $response = Http::get('https://www.googleapis.com/youtube/v3/search', $arrSend->all());

        $colVideo = collect();
        $rowsVideo = $response->json()['items'];
        $this->nextPageToken = !empty($response->json()['nextPageToken']) ? $response->json()['nextPageToken'] : "";
        $this->prevPageToken = !empty($response->json()['prevPageToken']) ? $response->json()['prevPageToken'] : "";

        foreach($rowsVideo as $row)
        {
            if(empty($row['id']['videoId']))
                continue;

            $rowData = new \StdClass();
            $rowData->videoID = $row['id']['videoId'];
            $rowData->title = $row['snippet']['title'];
            $rowData->publishedAt = $row['snippet']['publishedAt'];
            $rowData->description = $row['snippet']['description'];
            $rowData->thumbnails = $row['snippet']['thumbnails']['high']['url'];
            $colVideo->push($rowData);
        }

        return $colVideo;
    }

    public function detail($id)
    {

        $arrSend = collect([
            'key' => 'AIzaSyDAf6XxoWyJE1hNLLft5yHNKerX29JeXXQ',
            'part' => 'snippet',
            'id' => $id,
        ]);

        $response = Http::get('https://www.googleapis.com/youtube/v3/videos', $arrSend->all());
        $rowVideo = $response->json()['items'];

        $this->detailVideo = new \StdClass();
        $this->detailVideo->videoID = $rowVideo[0]['id'];
        $this->detailVideo->title = $rowVideo[0]['snippet']['title'];
        $this->detailVideo->publishedAt = $rowVideo[0]['snippet']['publishedAt'];
        $this->detailVideo->description = $rowVideo[0]['snippet']['description'];
        $this->detailVideo->thumbnails = $rowVideo[0]['snippet']['thumbnails']['high']['url'];

        $this->dispatch('open-modal', namamodal: "modalDetailVideo");
    }

    public function render()
    {
        // *** meta tag
        $mt = new MetaTag;
        $mt->title = "Video | ".config('app.webname');
        $mt->url = url("/video");
        $mt->description = "Travel Through Our Lens – Explore Iconic Destinations!";
        $mt->genMetaTag();

        return view("livewire.front.".$this->pageName, [
            "dataVideo" => $this->readVideo(),
        ])
        ->layout('components.layouts.front');
    }
}
