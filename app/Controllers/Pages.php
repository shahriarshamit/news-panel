<?php

namespace App\Controllers;

use App\Models\NewsModel;

class Pages extends BaseController {

    public function index() {
        return view('welcome_message');
    }

    public function view($page = 'home') {
        if (!is_file(APPPATH . 'Views/pages/' . $page . '.php')) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
        }
        $dateYear = new \DateTime();
        $data = [
            'title' => ucfirst($page),
            'year' => $dateYear->format('Y')
        ];

        return view('templates/header', $data)
                . view('pages/' . $page)
                . view('templates/footer', $data);
    }

}
