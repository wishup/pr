<?php

namespace common\components;

class attachments{

    public function uploadAll( $path = '', $max_file_size = 5, $valid_formats = ['jpg', 'png', 'gif', 'jpeg'] ){

        $files_info = [];

        foreach( $_FILES as $index=>$files ){

            $files_info[ $index ] = $this->upload( $files, $path, $max_file_size, $valid_formats );

        }

        return $files_info;

    }

    public function save( $files ){



    }

    /*
     * Function for uploading attachments to file system.
     * Returns array with files uploaded info.
     *
     * @param max_file_size : integer , maximum size of file uploaded in MB
     * @param valid_formats : Array , array of valid extensions
     */
    public function upload( $files, $path = '', $max_file_size = 5, $valid_formats = ['jpg', 'png', 'gif', 'jpeg'], $field = '' ){

        if( $field != '' ){

            $files = $this->getFilesArray( $files , $field );

        }

        $max_file_size *= 1024 * 1024;

        $uploaded_files = [];

        $upload_path = \Yii::getAlias('@frontend').'/web/upload/'.$path;
        if( substr($upload_path,-1)!='/' ) $upload_path = $upload_path.'/';

        if( !is_dir( $upload_path ) ) mkdir($upload_path, 0777, true);

        foreach ($files['name'] as $f => $name) {
            if ($files['error'][$f] == 4) {
                continue;
            }
            if ($files['error'][$f] == 0) {
                if ($files['size'][$f] > $max_file_size) {
                    throw new \Exception("$name is too large!");
                    continue; // Skip large files
                }
                elseif( is_array($valid_formats) && !in_array(strtolower(pathinfo($name, PATHINFO_EXTENSION)), $valid_formats) ){
                    throw new \Exception("$name is not a valid format");
                    continue; // Skip invalid file formats
                }
                else{ // No error found! Move uploaded files

                    if( $up_file = $this->saveFile( $files["tmp_name"][$f], $upload_path, $name ) ) {
                        $uploaded_files[] = $up_file;
                    } else {
                        throw new \Exception("Can't upload file $name");
                    }

                }
            }
        }

        return $uploaded_files;

    }

    public function getThumbnailUrl( $path, $width = 100, $height = 100, $resize_type = 'NONE' ){

        $pathinfo = pathinfo($path);

        if( !file_exists( \Yii::getAlias('@frontend/web' . $pathinfo["dirname"]."/".$pathinfo["filename"].'.'.$pathinfo["extension"]) ) ) return '';

        if( !file_exists( \Yii::getAlias('@frontend/web' . $pathinfo["dirname"]."/thumbnails_".$width.'_'.$height.'_'.strtolower($resize_type)."/") ) ) mkdir( \Yii::getAlias('@frontend/web' . $pathinfo["dirname"]."/thumbnails_".$width.'_'.$height.'_'.strtolower($resize_type)."/"), 0777, true );

        $thumbnail_url = $pathinfo["dirname"]."/thumbnails_".$width.'_'.$height.'_'.strtolower($resize_type)."/".$pathinfo["filename"].'.'.$pathinfo["extension"];

        if( !file_exists(\Yii::getAlias('@frontend/web' . $thumbnail_url)) || !is_readable(\Yii::getAlias('@frontend/web' . $thumbnail_url)) ) {

            $file = \Yii::getAlias('@frontend/web' . $path);
            $image = \Yii::$app->image->load($file);
            $image->resize($width, $height, constant("\yii\image\drivers\Image::$resize_type"))->save(\Yii::getAlias('@frontend/web' . $thumbnail_url), 100);

        }

        return $thumbnail_url;

    }

    private function saveFile( $tmp_file, $path, $filename ){

        $uploadPath = $this->generateSha1PathFromFile( $path, $tmp_file );
        $sha1filename = $this->createPath($uploadPath, pathinfo($filename, PATHINFO_EXTENSION));

        if(move_uploaded_file($tmp_file, $sha1filename)) {

             return [
                'path' => $uploadPath["path"],
                'full_path' => $sha1filename,
                'filename' => $filename,
                'base_url' => str_replace(\Yii::getAlias('@frontend').'/web','',$sha1filename),
            ];

        }

        return false;

    }

    private function generateSha1PathFromFile($strPathname='', $tempName, $intDepth=3, $intDirLength=3)
    {
        $strSha1File = sha1_file($tempName);
        $strPath = '';
        for( $i=0; $i<$intDepth; $i++ ) {
            $strDir = substr($strSha1File, $i*$intDirLength, $intDirLength);
            $strPath .= $strDir . DIRECTORY_SEPARATOR;
        }
        $strPathname .= $strPath;
        $arrPath = array(
            'path' => $strPathname,
            'sha1_file_name' => $strSha1File,
        );
        return $arrPath;
    }

    private function createPath($arrPath, $extension)
    {
        $strPath = $arrPath['path'];
        if( empty( $arrPath ) || empty( $strPath ) ) {
            return false;
        }

        $strPathName = $strPath . $arrPath['sha1_file_name'] . '.' . $extension;
        if (!file_exists($strPathName)) {
            if( file_exists($strPath) || mkdir($strPath, 0777, true) ) {

            }
        }
        return $strPathName;
    }

    private function getFilesArray( $files , $field ){

        $f = [];

        foreach( $files as $index=>$value ){

            foreach( $value[ $field ] as $ind=>$val ){

                $f[ $index ][ $ind ] = $val;

            }

        }

        return $f;

    }

}