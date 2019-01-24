<?php

namespace App\Components\FileManagers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;

abstract class ImageManager
{

    protected $id;
    protected $image;
    protected $sizeH;
    protected $sizeW;
    protected $type = 'jpg';

    public function __construct(Request $request, $id)
    {
        $this->id    = $id;
        $this->image = Image::make($request->file('image'));
        $this->sizeH = $this->image->height();
        $this->sizeW = $this->image->width();
    }

    public function createImages()
    {
        $this->createDeleteDirectory();
        $image_raw = $this->image;
        $image_raw->save($this->saveDirectory . $this->id . '_raw.' . $this->type);
        $sizes = array_reverse($this::SIZES);
        array_walk(
            $sizes, function ($v, $k) {
                if ($this->sizeH > $this->sizeW) {
                    $this->image
                        ->heighten(
                            $v, function ($constraint) {
                                $constraint->upsize();
                            }
                        )
                        ->save($this->saveDirectory . $this->id . $k . '.' . $this->type);
                } else {
                    $this->image
                        ->widen(
                            $v, function ($constraint) {
                                $constraint->upsize();
                            }
                        )
                    ->save($this->saveDirectory . $this->id . $k . '.' . $this->type);
                }
                if (App::environment('local')) {
                    chmod($this->saveDirectory . $this->id . $k . '.' . $this->type, 0777);
                }
            }
        );
    }

    public function createDeleteDirectory()
    {
        if (file_exists($path = $this->saveDirectory)) {
            if (is_dir($path)) {
                $objects = scandir($path);
                foreach ($objects as $object) {
                    if ($object != "." && $object != "..") {
                        if (is_dir($path . "/" . $object)) {
                            rrmdir($path . "/" . $object);
                        } else {
                            unlink($path . "/" . $object);
                        }
                    }
                }
                rmdir($path);
            }
        }
        if (!mkdir($this->saveDirectory, 0777)) {
            die('Не удалось создать директории...');
        }
    }

    public function getPossibleSizes($arraySazes)
    {
        $max_size  = $this->sizeH > $this->sizeW ? $this->sizeH : $this->sizeW;
        $can_sizes = array_filter(
            $arraySazes, function ($a) use ($max_size) {
                return $a <= $max_size;
            }, ARRAY_FILTER_USE_BOTH
        );
        if (count($can_sizes) == 0) {
            $can_sizes['_s'] = $arraySazes['_s'];
        }
        return $can_sizes;
    }
}