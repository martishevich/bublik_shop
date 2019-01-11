<?php

namespace App\Components\FileManagers;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ImageManager
{
	public static function createImageProduct($request, $id)
	{
		$directory = "images/products/$id";
		$image = file_get_contents($request->file('image'));
		dd(readfile($image));
		
		if (file_exists($directory)){
			rmdir($directory);
		}
		//проверить изначальный размер
		if (!mkdir($directory, 0777)) {
			die('Не удалось создать директории...');
		}
		self::makeImageSize($request, 150, 150, $id);
		self::makeImageSize($request, 300, 300, $id);
		self::makeImageSize($request, 600, 600, $id);
		$image->move($directory, $id.'_raw.jpg');
		
	}
	
	public static function makeImageSize($request, $width, $height, $id){
		$prefix = '';
		switch ($width){
			case $width >=500:
				$prefix = '_l';
				break;
			case $width>=300:
				$prefix = '_m';
				break;
			default:
				$prefix = '_s';
		}
		Image::make($request->file('image'))
			->resize($width, $height)
			->save('images/products/'.$id.'/'.$id.$prefix.'.jpg', 60);
		chmod('images/products/'.$id.'/'.$id.$prefix.'.jpg', 0777);
	}
}