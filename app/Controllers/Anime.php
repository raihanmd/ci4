<?php

namespace App\Controllers;

use App\Models\AnimeModel;

class Anime extends BaseController
{
    protected $animeModel;
    public function __construct()
    {
        $this->animeModel = new AnimeModel();
    }

    public function index(){
        // $anime = $this->animeModel->findAll();

        $keyword = $this->request->getVar('keyword');
        if($keyword){
            $anime = $this->animeModel->search($keyword);
            $searching = false;
        }else{
            $anime = $this->animeModel;
            $searching = true;
        }

        $data = [
            'title' => 'Anime | Lynx',
            // 'anime' => $this->animeModel->getAnime()
            'anime' => $anime->paginate(5, 'anime'),
            'pager' => $anime->pager,
            'searching' => $searching
        ];

        // $animeModel = new \App\Models\animeModel();

        return view('anime/index', $data);
    }
}
