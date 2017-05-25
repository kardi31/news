<?php

namespace Kardi\MediaBundle\Service;


use Symfony\Component\HttpFoundation\JsonResponse;

class Croppic
{
    public static function crop($photoDir, $imgUrl, $outputUrlId, $imgInitW, $imgInitH, $imgW, $imgH, $imgY1, $imgX1, $cropW, $cropH, $angle)
    {
        $jpeg_quality = 100;

        $fullOriginalFullSizeImage = $photoDir . '/..' . $imgUrl;
        $fullTargetImageUrl = $photoDir . '/..' . $outputUrlId;

        $croppedId = "/croppedImg_" . rand();

        $fullTargetTempUrl = dirname($fullTargetImageUrl) . $croppedId;

        $what = getimagesize($fullOriginalFullSizeImage);

        switch (strtolower($what['mime'])) {
            case 'image/png':
                $img_r = imagecreatefrompng($fullOriginalFullSizeImage);
                $source_image = imagecreatefrompng($fullOriginalFullSizeImage);
                $type = '.png';
                break;
            case 'image/jpeg':
                $img_r = imagecreatefromjpeg($fullOriginalFullSizeImage);
                $source_image = imagecreatefromjpeg($fullOriginalFullSizeImage);
                error_log("jpg");
                $type = '.jpeg';
                break;
            case 'image/gif':
                $img_r = imagecreatefromgif($fullOriginalFullSizeImage);
                $source_image = imagecreatefromgif($fullOriginalFullSizeImage);
                $type = '.gif';
                break;
            default:
                die('image type not supported');
        }

        if (!is_writable(dirname($fullTargetTempUrl))) {
            $response = [
                "status" => 'error',
                "message" => 'Can`t write cropped File'
            ];
        } else {

            // resize the original image to size of editor
            $resizedImage = imagecreatetruecolor($imgW, $imgH);
            imagecopyresampled($resizedImage, $source_image, 0, 0, 0, 0, $imgW, $imgH, $imgInitW, $imgInitH);
            // rotate the rezized image
            $rotated_image = imagerotate($resizedImage, -$angle, 0);
            // find new width & height of rotated image
            $rotated_width = imagesx($rotated_image);
            $rotated_height = imagesy($rotated_image);
            // diff between rotated & original sizes
            $dx = $rotated_width - $imgW;
            $dy = $rotated_height - $imgH;
            // crop rotated image to fit into original rezized rectangle
            $cropped_rotated_image = imagecreatetruecolor($imgW, $imgH);
            imagecolortransparent($cropped_rotated_image, imagecolorallocate($cropped_rotated_image, 0, 0, 0));
            imagecopyresampled($cropped_rotated_image, $rotated_image, 0, 0, $dx / 2, $dy / 2, $imgW, $imgH, $imgW, $imgH);
            // crop image into selected area
            $final_image = imagecreatetruecolor($cropW, $cropH);
            imagecolortransparent($final_image, imagecolorallocate($final_image, 0, 0, 0));
            imagecopyresampled($final_image, $cropped_rotated_image, 0, 0, $imgX1, $imgY1, $cropW, $cropH, $cropW, $cropH);
            // finally output png image
            //imagepng($final_image, $output_filename.$type, $png_quality);
            imagejpeg($final_image, $fullTargetTempUrl . $type, $jpeg_quality);

            if (file_exists($fullTargetImageUrl)) {
                unlink($fullTargetImageUrl);
            }

            copy($fullTargetTempUrl.$type, $fullTargetImageUrl);
            unlink($fullTargetTempUrl. $type);

            $response = [
                "status" => 'success',
                "url" => $outputUrlId
            ];
        }
        return new JsonResponse($response);
    }
}
