<?php
require_once('getID3/getid3/getid3.php');
// Initialize getID3 engine
$getID3 = new getID3;


// write mp3 tags to audio file
if (isset($_POST["subtitle"])) {
    $imageCover = $_FILES["imageCover"];
    $audioFiletoEdit = $_FILES["audioFiletoEdit"];


    $APICdata = file_get_contents($_FILES['imageCover']['tmp_name']);
    
    $exif_imagetype = exif_imagetype($_FILES['imageCover']['tmp_name']);

    foreach ($_POST as $fields => $value) {
        $$fields = filter_var(strip_tags($value), FILTER_SANITIZE_STRING);
    }
    // $title = filter_var(strip_tags($_POST["title"]), FILTER_SANITIZE_STRING);

    $picName = $imageCover["name"];
    $img_tmp_name = $imageCover["tmp_name"];
    $splittedPicName = explode(".", $picName);
    $mainPicName = $splittedPicName[0];
    $img_ext = end($splittedPicName);

    $img_location = uniqid($mainPicName) . "." . $img_ext;

    if(move_uploaded_file($img_tmp_name, $img_location)){
        $audioName = $audioFiletoEdit["name"];
        $audio_tmp_name = $audioFiletoEdit["tmp_name"];
        $splittedAudioName = explode(".", $audioName);
        $mainAudioName = $splittedAudioName[0];
        $audio_ext = end($splittedAudioName);

        $audio_file_location = "Editted Audio Files/editted" . uniqid($mainAudioName) . "." . $audio_ext;

        if(move_uploaded_file($audio_tmp_name, $audio_file_location)){
            // Initialize getID3 engine
            $TextEncoding = 'UTF-8';
            $getID3 = new getID3;
            $getID3->setOption(array('encoding'=>$TextEncoding));

            require_once('getID3/getid3/write.php');
            // Initialize getID3 tag-writing module
            $tagwriter = new getid3_writetags;
            //$tagwriter->filename = '/path/to/file.mp3';
            $tagwriter->filename = $audio_file_location;

            //$tagwriter->tagformats = array('id3v1', 'id3v2.3');
            $tagwriter->tagformats = array('id3v2.3');

            // set various options (optional)
            $tagwriter->overwrite_tags    = true;  // if true will erase existing tag data and write only passed data; if false will merge passed data with existing tag data (experimental)
            $tagwriter->remove_other_tags = false; // if true removes other tag formats (e.g. ID3v1, ID3v2, APE, Lyrics3, etc) that may be present in the file and only write the specified tag format(s). If false leaves any unspecified tag formats as-is.
            $tagwriter->tag_encoding      = $TextEncoding;
            $tagwriter->remove_other_tags = true;

            // populate data array
            $TagData = array(
                'title'                  => array($title),
                'subtitle'               => array($subtitle),
                'encoded_by'             => array($enc_by),
                'band'                   => array($band),
                'publisher'              => array($band),
                'artist'                 => array($audioFileToEditArtist),
                'album'                  => array($album),
                'year'                   => array($year),
                'genre'                  => array($genre),
                'comment'                => array($comment),
                'track_number'           => array($track_number),
                'popularimeter'          => array('email'=>'paulosab@example.net', 'rating'=>128, 'data'=>$rating),
                'unique_file_identifier' => array('ownerid'=>'paulosab@example.net', 'data'=>md5(time())),
            );
            
            // Audio file Cover Picture
            $TagData['attached_picture'][0]['data']          = $APICdata;
            $TagData['attached_picture'][0]['picturetypeid'] = 2;
            $TagData['attached_picture'][0]['description']   = $title;
            $TagData['attached_picture'][0]['mime']          = image_type_to_mime_type($exif_imagetype);
            
            // write the tags
            $tagwriter->tag_data = $TagData;

            if($tagwriter->WriteTags()){
                unlink($img_location);

                echo json_encode(["status"=>0, 
                "msg"=>"Audio file metedata editted successfully!"]);
                exit();
            }else{
                echo json_encode(["status"=>1, 
                "msg"=>"An error occured could not edit audio file metatdata"]);
                exit();

            }

        }else {
            echo json_encode(["status"=>1, 
            "msg"=>"An error occured could not upload audio file and could not edit audio file"]);
            exit();
        }

    }else {
        echo json_encode(["status"=>1, 
        "msg"=>"An error occured could not upload cover image and could not edit audio file"]);
        exit();
    }
   

}


// extract audio backend handling
if (isset($_POST["extractedAudioFilename"])) {
    require_once('getID3/demos/demo.joinmp3.php');
    $mp3FileToSplit = $_FILES["mp3FileToSplit"];

    foreach ($_POST as $fields => $value) {
        $$fields = filter_var(strip_tags($value), FILTER_SANITIZE_STRING);
    }

    $audioName = $mp3FileToSplit["name"];
    $audio_tmp_name = $mp3FileToSplit["tmp_name"];
    $splittedAudioName = explode(".", $audioName);
    $mainAudioName = $splittedAudioName[0];
    $audio_ext = end($splittedAudioName);

    $audio_file_location = uniqid($mainAudioName) . "." . $audio_ext;

    if(move_uploaded_file($audio_tmp_name, $audio_file_location)){
        // $startSplitFrom
        // $stopSplitAt
        if (CombineMultipleMP3sTo("extracted audio/" . $extractedAudioFilename . "." . $audio_ext, 
            array(array($audio_file_location, $startSplitFrom, $stopSplitAt)))){
                unlink($audio_file_location);

                echo json_encode(["status"=>0, 
                "msg"=>"Successfully extracted {$stopSplitAt} seconds from {$audioName} audio"]);
                exit();
            }else{
                echo json_encode(["status"=>1, 
                "msg"=>"an error occured could not extracted {$stopSplitAt} seconds from {$audioName} audio"]);
                exit();

            }
    }else {
        echo json_encode(["status"=>1, 
        "msg"=>"An error occured could not upload audio file and could not extract from audio file"]);
        exit();
    }

    
    
}

// Join audio files backend handling
if (isset($_POST["joinedFilename"])) {
    require_once('getID3/demos/demo.joinmp3.php');
    $mp3FileToJoin = $_FILES["audioFileToJoin"];

    foreach ($_POST as $fields => $value) {
        $$fields = filter_var(strip_tags($value), FILTER_SANITIZE_STRING);
    }


    $startExtractFrom  = explode(",", trim($startExtractFrom));
    $extractLenght  = explode(",", trim($stopExtractAt));
    // $stopExtractAt

    for ($from=0; $from < count($startExtractFrom); $from++) { 
        if ($startExtractFrom[$from] == "") {
            $startExtractFrom[$from] = 0;
        }

        // array_push($extractFrom, $startExtractFrom[$from]);
    }
    for ($extLenght=0; $extLenght < count($extractLenght); $extLenght++) { 
        if ($extractLenght[$extLenght] == "") {
            $extractLenght[$extLenght] = 0;
        }

        // array_push($extractFrom, $extractLenght[$extLenght]);
    }

    

    $uploadedFiles = [];

    for ($i=0; $i < count($mp3FileToJoin["name"]); $i++) { 
        $audioName = $mp3FileToJoin["name"][$i];
        $audio_tmp_name = $mp3FileToJoin["tmp_name"][$i];
        $splittedAudioName = explode(".", $audioName);
        $mainAudioName = $splittedAudioName[0];
        $audio_ext = end($splittedAudioName);

        $audio_file_location = uniqid($mainAudioName) . "." . $audio_ext;

        if (move_uploaded_file($audio_tmp_name, $audio_file_location)) {
            array_push($uploadedFiles, $audio_file_location);
        }else {
            continue;
        }


    }


    $FilenameOut   = "joined audios file/" . $joinedFilename . ".mp3";

    // $startExtractFrom  = explode(",", trim($startExtractFrom));
    // $extractLenght  = explode(",", trim($stopExtractAt));
    // 0,0,0

    $FilenamesIn = [];
    for ($u=0; $u < count($uploadedFiles); $u++) { 
        $FilenamesIn[] = array($uploadedFiles[$u],   $startExtractFrom[$u],   $extractLenght[$u]);  // filename with zero for start/length is the same as not specified (start = beginning, length = full duration)
        
    }

  if (CombineMultipleMP3sTo($FilenameOut, $FilenamesIn)) {
      for ($d=0; $d < count($uploadedFiles); $d++) { 
          unlink($uploadedFiles[$d]);
      }
      echo json_encode(['status'=>0, 'msg'=>'Successfully joined file to '.$FilenameOut]);
    } else {
      echo json_encode(['status'=>0, 'msg'=>'could not joined file to '.$FilenameOut]);
    //   echo 'Failed to copy '.implode(' + ', $FilenamesIn).' to '.$FilenameOut;
  }


}
