<?php
include_once "getID3/getid3/getid3.php";
// include_once "getID3/demos/demo.joinmp3.php";
$getID3 = new getID3();


?>
<!DOCTYPE html>
<html lang="en"><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Audio Files Editor with getID3</title>

    <!-- Bootstrap core CSS -->
    <link href="bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
  </head>

  <body>

    <nav class="navbar navbar-expand-md navbar-dark bg-success fixed-top">
      <a class="navbar-brand" href="#">Paulos Ab</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item"><a class="nav-link" href="blog-page.php">Blog Page</a>
          </li>
          <li class="nav-item">
            <a class="nav-link disabled" href="#">Disabled</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="http://example.com/" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropdown</a>
            <div class="dropdown-menu" aria-labelledby="dropdown01">
              <a class="dropdown-item" href="#">Action</a>
              <a class="dropdown-item" href="#">Another action</a>
              <a class="dropdown-item" href="#">Something else here</a>
            </div>
          </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
          <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
      </div>
    </nav>

    <main class="container">

    <div class="row">
      <div class="starter-template mt-5 col-lg-12">
        <h1 class="mt-5 text-center">Edit, Split, Join Audio Files in PHP with getID3 plugin with jQuery/AJAX & PHP</h1>
          
        <!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////
                                      Some of the Cool Stuffs that getID3 can do
        /////////////////////////////////////////////////////////////////////////////////////////////////////// -->
        
        <div class="bg-success text-white mt-4 p-3 mb-4">
          <h3 class="border-bottom mb-2 p-2">Some of the Cool Stuffs that getID3 can do</h3>
          <p class="">can Edit Audio file Metadata/details</p> 
          <p class="">can get Audio file Info</p>
          <p class="">can Join Audio files into one file</p>
          <p class="">can split Audio file</p>
          <p class="">can get any file mime type</p>

        </div>

        <!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////
                                      Audio File Metadata/Details Editing Form
        /////////////////////////////////////////////////////////////////////////////////////////////////////// -->
          <h3 class="">Audio File Metadata/Details Editing Form</h3>
          <form method="post" id="audioDetailForm">
            
            <div class="row">

            <div class="col-12 form-group mb-3">
              <label for="imageCover">Cover Image</label>
              <input type="file" name="imageCover" id="imageCover" class="form-control">
            </div>
            <div class="col-6 form-group mb-3">
              <label for="artist">Artist</label>
              <input type="text" name="audioFileToEditArtist" id="artist" class="form-control">
            </div>
            <div class="col-6 form-group mb-3">
              <label for="title">Title of the Song</label>
              <input type="text" name="title" id="title" class="form-control">
            </div>
            <div class="col-6 form-group mb-3">
              <label for="year">Year of Release</label>
              <input type="text" name="year" id="year" class="form-control">
            </div>
            <div class="col-6 form-group mb-3">
              <label for="enc_by">Encoded By</label>
              <input type="text" name="enc_by" id="enc_by" class="form-control">
            </div>
            <div class="col-6 form-group mb-3">
              <label for="subtitle">Subtitle</label>
              <input type="text" name="subtitle" id="subtitle" class="form-control">
            </div>
            <div class="col-6 form-group mb-3">
              <label for="album">Album</label>
              <input type="text" name="album" id="album" class="form-control">
            </div>
            <div class="col-6 form-group mb-3">
              <label for="band">Band</label>
              <input type="text" name="band" id="band" class="form-control">
            </div>
            <div class="col-6 form-group mb-3">
              <label for="genre">Genre</label>
              <input type="text" name="genre" id="genre" class="form-control">
            </div>
            <div class="col-6 form-group mb-3">
              <label for="comment">Comment on the Song</label>
              <input type="text" name="comment" id="comment" class="form-control">
            </div>
            <div class="col-6 form-group mb-3">
              <label for="track_number">Track Number</label>
              <input type="text" name="track_number" id="track_number" class="form-control">
            </div>
            <div class="col-6 form-group mb-3">
              <label for="rating">Rating</label>
              <input type="number" name="rating" id="rating" class="form-control">
            </div>

            </div>
            <div class="form-group mb-3">
              <label for="mp3file">Choose MP3 File to Edit</label>
              <input type="file" name="audioFiletoEdit" id="mp3file" class="form-control">
            </div>

            <input type="submit" name="editaudiometadata" class="btn btn-primary btn-block"  id="submit-editaudio" value="Edit Metadata">

        </form>

        <hr class="border-danger">

        <!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////
                                      Audio File Spliting Form
        /////////////////////////////////////////////////////////////////////////////////////////////////////// -->

          <h1>Extract Audio File</h1>
          <h3 class="">Audio File Extract Form</h3>
          <form method="post" id="audioSplitForm">
            <div class="form-group row">
              <div class="col-6">
                <label for="startSplitFrom">From</label>
                <input type="number" name="startSplitFrom" id="startSplitFrom" class="form-control">
              </div>
              <div class="col-6">
                <label for="stopSplitAt">Length</label>
                <input type="number" name="stopSplitAt" id="stopSplitAt" class="form-control">
              </div>
            </div>
            <div class="form-group mb-3">
              <label for="extractedAudioFilename">Preferred Splited Filename</label>
              <input type="text" name="extractedAudioFilename" id="extractedAudioFilename" class="form-control">
            </div>
            <div class="form-group mb-3">
              <label for="mp3FileToSplit">Choose Audio File to Split</label>
              <input type="file" name="mp3FileToSplit" id="mp3FileToSplit" class="form-control">
            </div>

            <button class="btn btn-primary btn-block" id="submit-post">Split Audio</button>

        </form>

        <hr class="border-danger">

        <!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////
                                      Audio File Joining Form
        /////////////////////////////////////////////////////////////////////////////////////////////////////// -->

          <h3 class="">Audio File Joining Form</h3>
          <form method="post" id="joinAudioForm">
            
            <div class="form-group mb-3">
              <label for="audioFileToJoin">Choose Audio Files to Join</label>
              <input type="file" name="audioFileToJoin[]" multiple id="audioFileToJoin" class="form-control">
              <input type="hidden" name="audioFilestojoin">
            </div>
            <div class="form-group mb-3">
              <label for="joinedFilename">Preferred Joined Filename</label>
              <input type="text" name="joinedFilename" id="joinedFilename" class="form-control">
            </div>
            <div class="row">
            <div class="form-group col-6 mb-3">
              <label for="startExtractFrom">Start Extract From</label>
              <input type="text" name="startExtractFrom" id="startExtractFrom" class="form-control">
            </div>
            <div class="form-group col-6 mb-3">
              <label for="stopExtractAt">Extract Length</label>
              <input type="text" name="stopExtractAt" id="stopExtractAt" class="form-control">
            </div>
            </div>

            <button class="btn btn-primary btn-block" type="submit" id="joinfiles-submit">Join Audio Files</button>

        </form>

        <hr class="border-danger">

        <div class="mt-4">


          <h3>Editted Files In Uploads Folder</h3>

          <table class="table  table-responsive table-striped">
            <tr>
              <th>S/N</th>
              <th>Filename</th>
              <th>Artist</th>
              <th>Title</th>
              <th>Year</th>
              <th>Encoded By</th>
              <th>Subtitle</th>
              <th>Album</th>
              <th>Band</th>
              <th>Genre</th>
              <th>Comment</th>
              <th>track_number</th>
              <th>Bitrate</th>
              <th>Playtime</th>
            </tr>
              <?php
                
                
                $DirectoryToScan = 'Editted Audio Files'; // change to whatever directory you want to scan
                $dir = opendir($DirectoryToScan);
                $counter = 1;
                while (($file = readdir($dir)) !== false) {
                  $FullFileName = realpath($DirectoryToScan.'/'.$file);
                  if ((substr($file, 0, 1) != '.') && is_file($FullFileName)) {
                    set_time_limit(30);

                $ThisFileInfo = $getID3->analyze($FullFileName);

                $getID3->CopyTagsToComments($ThisFileInfo); ?>

                <!-- output desired information in whatever format you want -->
                <tr>
                <td>      <?php echo $counter; ?></td>
                <td>      <?php echo htmlentities($ThisFileInfo['filenamepath']) ?></td>
                <td>      <?php echo htmlentities(implode('<br>', $ThisFileInfo['comments_html']['artist'])) ?> </td>
                <td>      <?php echo htmlentities(implode('<br>', $ThisFileInfo['comments_html']['title'])) ?>  </td>
                <td>      <?php echo htmlentities(implode('<br>', $ThisFileInfo['comments_html']['year'])) ?> </td>
                <td>      <?php echo htmlentities(implode('<br>', $ThisFileInfo['comments_html']['encoded_by'])) ?> </td>
                <td>      <?php echo htmlentities(implode('<br>', $ThisFileInfo['comments_html']['subtitle'])) ?> </td>
                <td>      <?php echo htmlentities(implode('<br>', $ThisFileInfo['comments_html']['album'])) ?>  </td>
                <td>      <?php echo htmlentities(implode('<br>', $ThisFileInfo['comments_html']['band'])) ?> </td>
                <td>      <?php echo htmlentities(implode('<br>', $ThisFileInfo['comments_html']['genre'])) ?>  </td>
                <td>      <?php echo htmlentities(implode('<br>', $ThisFileInfo['comments_html']['comment'])) ?>  </td>
                <td>      <?php echo htmlentities(implode('<br>', $ThisFileInfo['comments_html']['track_number'])) ?>  </td>
                <td align="right">  <?php echo htmlentities(round($ThisFileInfo['audio']['bitrate'] / 1000)) ?> </td>
                <td align="right">  <?php echo htmlentities($ThisFileInfo['playtime_string']) ?>  </td>
                </tr>

              <?php 
              $counter++;
              }
            }
            
            $remotefilename = 'mp3 audio files\\edittedDeep Chillout - AShamaluevMusic609e592098894.mp3';
  
            $mp3FileInfo = $getID3->analyze($remotefilename);
  
            $getID3->CopyTagsToComments($mp3FileInfo);
            
            echo var_dump($mp3FileInfo);
            
            ?>
          </table>
          
          
          
        </div>

      </div>

    </div>

    </main><!-- /.container -->

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="jquery-3.5.1.min.js"></script>
    <script src="popper.js"></script>
    <script src="bootstrap.min.js"></script>
    <script src="main.js"></script>
  

</body></html>