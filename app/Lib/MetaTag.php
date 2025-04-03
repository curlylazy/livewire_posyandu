<?php

namespace App\Lib;

use App\Models\BeritaModel;
use Butschster\Head\Facades\Meta;
use Illuminate\Support\Str;

class MetaTag
{

	public $title;
	public $description;
	public $url;
	public $creator;
	public $image;
	public $favIcon;
	public $keywords;
	public $rowsPaginate;

	public function __construct()
    {
        $this->keywords = collect([
            "adventure travel packages",
            "best adventure vacations",
            "outdoor adventure trips",
            "extreme adventure tours",
            "adventure holiday deals",
            "adrenaline-filled travel",
            "hiking and trekking tours",
            "wildlife and nature expeditions",
            "thrill-seeking travel experiences",
            "best destinations for adventure travel"
        ]);
    }

	public function addKeyword($val)
	{
		$this->keywords->push($val);
	}

	public function addKeywordArray($val)
	{
		foreach ($val as $value) {
            $this->addKeyword($value);
        }
	}

	public function setPaginate($rows)
	{
		$this->rowsPaginate = $rows;
	}

	public function genMetaTag()
    {
		if(empty($this->title))
			$this->title = config('app.webname');

		if(empty($this->url))
			$this->url = config('app.web_url');

		if(empty($this->description))
			$this->description = config('app.webdesc');

		if(empty($this->creator))
			$this->creator = config('app.webcreator');

		if(empty($this->image))
			$this->image = asset('cover.jpg');

		if(empty($this->favIcon))
			$this->favIcon = asset('favicon.ico');

		// Facebook
        $og = new \Butschster\Head\Packages\Entities\OpenGraphPackage(config('app.webname'));
        $og->setType('article')
            ->setSiteName(config('app.webname'))
            ->setTitle(config('app.webname').' - '.$this->title)
            ->setDescription(Str::of($this->description)->stripTags())
            ->setUrl($this->url)
            ->addImage($this->image)
            ->toHtml();

        Meta::setTitle(config('app.webname'))
            ->prependTitle($this->title)
            ->setDescription(Str::of($this->description)->stripTags())
            ->addMeta('author', ['content' => $this->creator])
            ->setKeywords($this->keywords->all())
            ->setFavicon($this->favIcon)
            ->setCanonical($this->url)
            ->setRobots('nofollow,noindex')
            ->registerPackage($og);

        if(!empty($this->rowsPaginate))
            Meta::setPaginationLinks($this->rowsPaginate);

        // Twitter Card
        $card = new \Butschster\Head\Packages\Entities\TwitterCardPackage(config('app.webname')." ".$this->title);
        $card->setType('summary_large_image')
            ->setSite(config('app.webname'))
            ->setTitle(config('app.webname').' - '.$this->title)
            ->setCreator($this->creator)
            ->setImage($this->image)
            ->setDescription(Str::of($this->description)->stripTags());

        Meta::registerPackage($card);

    }

}
