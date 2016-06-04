<?php
/**
 * Created by PhpStorm.
 * User: tanteng
 * Date: 16/5/8
 * Time: 13:46
 */

namespace App\Http\Controllers;

use App\Models\Destination;
use App\Models\Travel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class TravelController extends Controller
{
    public function __construct(Destination $destination, Travel $travel)
    {
        $this->destination = $destination;
        $this->travel = $travel;
    }

    //旅行栏目首页，列出所有目的地，链接指向目的地最新游记
    public function index()
    {
        $navFlag = 'travel';

        $lists = Cache::remember('travel.destination.lists', 20, function () {
            return $this->destination->getList();
        });
        return view('travel.index', compact('navFlag', 'lists'));
    }

    //目的地游记列表
    public function travelList($destinationSlug)
    {
        $navFlag = 'travel';

        $rs = $this->destination->where('slug', $destinationSlug)->first(['id', 'destination', 'seo_title', 'description']);
        $destinationId = $rs->id;
        if (!$destinationId) {
            abort(404);
        }
        $destination = $rs->destination;
        $seoTitle = $rs->seo_title;
        $description = $rs->description;

        $seoSuffix = "_tanteng.me";
        $lists = Cache::remember('travel.destination.travel.list.' . $destinationId, 20, function () use ($destinationId) {
            return $this->travel->travelList($destinationId);
        });
        return view('travel.destination', compact('navFlag', 'lists', 'destination', 'destinationSlug', 'seoTitle', 'description', 'seoSuffix'));
    }

    //游记详情
    public function travelDetail($destinationSlug, $slug)
    {
        $navFlag = 'travel';

        $destinationList = Cache::remember('travel.destination.list', 30, function () {
            return $this->destination->getList();
        });

        $info = Cache::remember('travel.destination.info.' . $destinationSlug, 30, function () use ($destinationSlug) {
            return $this->destination->where('slug', $destinationSlug)->first(['id', 'destination']);
        });

        $destination = $info->destination;
        $destinationId = $info->id;
        $seoSuffix = "_{$info->destination}游记_tanteng.me";

        $detail = Cache::remember('travel.detail.' . $destinationId . $slug, 20, function () use ($slug) {
            return $this->travel->where('slug', $slug)->firstOrFail();
        });
        
        return view('travel.detail', compact('navFlag', 'detail', 'destinationList', 'destination', 'destinationSlug', 'slug', 'seoSuffix', 'sid'));
    }
}