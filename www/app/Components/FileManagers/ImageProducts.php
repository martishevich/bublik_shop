<?php

namespace App\Components\FileManagers;

use App\Components\FileManagers\ImageManager;

class ImageProducts extends ImageManager
{
    const SIZES = [
    '_s' => 150,
    '_m' => 320,
    '_l' => 600
    ];
    protected $saveDirectory;
    
    public function __construct($request, $id)
    {
        parent::__construct($request, $id);
        $this->saveDirectory = "images/products/$id/";
    }
}