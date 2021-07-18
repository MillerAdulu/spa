<?php

namespace App\Services;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class Upload
{
    protected $name = '';
    protected $path;

    public function __construct()
    {
        $this->base_url = URL('/');
    }

    public function getName()
    {
        return asset('/app/uploads/'.$this->name);
    }

    public function setName()
    {
        $this->name = Str::random(5). time() . '.jpg';
        // $this->name = str_random(5). time() . '.jpg';
    }

    public function path()
    {
        if($this->base_url === "http://www.teek.sstudio.io" or $this->base_url === "http://teek.sstudio.io") {
            $this->path = substr(public_path(), 0, 15).'teek.sstudio.io/uploads/';
        }
        else {
            $this->path = public_path().'/app/uploads/';
        }
    }

    public function upload($resource) {
        $this->setName();
        $this->path();

        $resource->move($this->path, $this->name);
    }

    public function delete($fileName)
    {
        $imgPath = substr(str_replace(URL('/'), '', $fileName), 1);
        if (file_exists($imgPath)) {
            File::delete($imgPath);
        }
    }

}