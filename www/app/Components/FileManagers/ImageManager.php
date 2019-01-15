<?php

namespace App\Components\FileManagers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

abstract class ImageManager
{
	protected $id;
	protected $image;
	protected $sizeH;
	protected $sizeW;
	protected $type;
	
	public function __construct($request, $id)
	{
		$this->id    = $id;
		$this->image = Image::make($request->file('image'));
		$this->sizeH = $this->image->height();
		$this->sizeW = $this->image->width();
		$this->type  = $request->image->extension();
	}
	
	public function createImages()
	{
		$class_from = get_called_class();
		dd();
		if (file_exists($class_from->saveDirectory)){
			rmdir($class_from->saveDirectory);
		}
		
		if (!mkdir($class_from->saveDirectory, 0777)){
			die('Не удалось создать директории...');
		}
		
		$sizes = $this->getPossibleSizes($class_from::SIZES);
		array_walk($sizes, function ($v, $k) use ($class_from){
			$this->image
				->resizeCanvas($k, $k, 'center', true, 'fff')
				->save($class_from->saveDirectory . $this->id . $v . '.' . $this->type, 60);
			if (App::environment('local')){
				chmod($class_from->saveDirectory . $this->id . $v . '.' . $this->type, 0777);
			}
		});
		$this->image->move($class_from->saveDirectory, $this->id . '_raw.' . $this->type);
	}
	
	public function getPossibleSizes($arraySazes)
	{
		$max_size = $this->sizeH > $this->sizeW ? $this->sizeH : $this->sizeW;
		/*todo один или два аргумента чтобы ключ-значение сохранились?*/
		$can_sizes = array_filter($arraySazes, function ($a) use ($max_size){
			return $a <= $max_size;
		}, ARRAY_FILTER_USE_BOTH);
		if (isEmpty($can_sizes)){
			$can_sizes['_s'] = $arraySazes['_s'];
		}
		return $can_sizes;
	}
}