<?php

namespace App\Modules\Wordpress\Helpers;

use Illuminate\Support\Facades\File;

class Uploader
{
    public static function uploadFromPath($source, $replaceName = null, $author = 1)
    {
        $uploadDir = wp_upload_dir();
        $fileType = wp_check_filetype(basename($source), null);

        $uuid = uniqid();
        $fileName = ($replaceName) ? $replaceName : $uuid . '.' . $fileType['ext'];
        $uploadPath = $uploadDir['path'] . '/' . $fileName;
        $uploadUrl = $uploadDir['url'] . '/' . $fileName;
        copy($source, $uploadPath);

        $attachment = [
            'guid' => $uploadUrl,
            'post_mime_type' => $fileType['type'],
            'post_title' => preg_replace('/\.[^.]+$/', '', basename($fileName)),
            'post_content' => '',
            'post_status' => 'inherit',
            'post_author' => $author
        ];

        $attach_id = wp_insert_attachment($attachment, $uploadPath, 0);

        require_once(ABSPATH.'wp-admin/includes/image.php');

        $attach_data = wp_generate_attachment_metadata($attach_id, $uploadPath);
        wp_update_attachment_metadata($attach_id, $attach_data);

        return $attach_id;
    }
}