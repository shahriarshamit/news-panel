<?php

namespace App\Controllers;

use App\Models\NewsModel;

class News extends BaseController {

    public function index() {
        $dateYear = new \DateTime();
        $model = model(NewsModel::class);
        $data = [
            'news' => $model->getNews(),
            'title' => 'News archive',
            'year' => $dateYear->format('Y')
        ];
        return view('templates/header', $data)
                . view('news/overview')
                . view('templates/footer', $data);
    }

    public function view($slug = null) {
        $dateYear = new \DateTime();
        $model = model(NewsModel::class);
        $news_data = $model->getNews($slug);
        if (empty($news_data)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Cannot find the news item: ' . $slug);
        }
        $data = [
            'news' => $news_data,
            'title' => $news_data['title'],
            'year' => $dateYear->format('Y')
        ];
        return view('templates/header', $data)
                . view('news/view', $data)
                . view('templates/footer', $data);
    }

}
