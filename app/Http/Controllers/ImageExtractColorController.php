<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use League\ColorExtractor\Color;
use League\ColorExtractor\ColorExtractor;
use League\ColorExtractor\Palette;
use Image as InterventionImage;

use App\Models\Image;

class ImageExtractColorController extends Controller
{

    /**
     * Extract mostly used colors
     *
     * @param  \App\Models\Image $id
     * @return \Illuminate\Http\Response
     */
    public function extractColors($id)
    {
		$image = Image::findOrFail($id);

		$originalImageFileName = $image->name;
		$originalImagePathWithFileName = $image->path;

		// Crop Bottom Half of Image
		$croppedImageFileName = $this->cropBottomHalfOfImage($originalImageFileName, $originalImagePathWithFileName);

		// Get cropped image as a pallete of colors
		$palette = Palette::fromFilename(public_path() . '/storage/images/' . $croppedImageFileName);

		// An extractor is built from a palette
		$extractor = new ColorExtractor($palette);

		// It defines an extract method which return the most “representative” colors
		$colorsInIntFormat = $extractor->extract(5);

		// Convert Color from Int to Hex
		$colorsInHexFormat = [];
		foreach($colorsInIntFormat as $color) {
			$hexColor = Color::fromIntToHex($color);
			array_push($colorsInHexFormat, $hexColor);
		}

		// Return view with required data
		return view('extract-colors')
			->with('status', 'Colors extracted successfully.')
			->with('originalImage', $originalImageFileName)
			->with('croppedImage', $croppedImageFileName)
			->with('colors', $colorsInHexFormat);
	}

    /**
     * Crop bottom half of given image
     *
     * @param  String $imageName
     * @param  String $originalImagePathWithFileName
	 * @return String
     */
    public function cropBottomHalfOfImage(String $originalImageFileName, String $originalImagePathWithFileName)
    {
		// Get original image uploaded by user
		$contents = Storage::get($originalImagePathWithFileName);
		$originalImage = imagecreatefromstring($contents);

		// Get original width and height of image
		$originalWidth = imagesx($originalImage);
		$originalHeight = imagesy($originalImage);

		// Set values of rectangle to crop bottom half of image
		$expectedImageWidth = $originalWidth;
		$expectedImageHeight = round($originalHeight/2);
		$x = 0;
		$y = round($originalHeight/2);

		// Get image to crop
		$imageToCrop = InterventionImage::make(public_path().'/storage/images/'.$originalImageFileName);
        // Crop image
		$imageToCrop->crop($expectedImageWidth, $expectedImageHeight, $x, $y);
		// Save cropped image
		$imageToCrop->save(public_path().'/storage/images/cropped-'.$originalImageFileName);

		return "cropped-".$originalImageFileName;
	}
}
