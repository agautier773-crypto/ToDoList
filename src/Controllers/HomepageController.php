<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\View;


class HomepageController extends Controller{

    public function home():void{
        View::render("HomePage.index");
    }
}