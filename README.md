# Dionysus Upload

Dionysus Upload is an easy to use class to help you with uploading any file.

### How To Use

##### Create your HTML form

    <form action="upload.php" method="post" enctype="multipart/form-data">
      Select a file to upload:
      <input type="file" name="fileToUpload" id="fileToUpload">
      <input type="submit" value="Upload File" name="submit">
    </form>
    
##### Create "upload.php"

    <?php
    
    /**
     * Make sure to include Simple Upload !!!
     */
    require_once 'SimpleUpload.php';
    
    $simpleUpload = new SimpleUpload;
    
    // Set your desired upload directory
    $simpleUpload->setDirectory('uploads/');
    
    // Limit which file types to receive
    $simpleUpload->setAllowedTypes('xlsx', 'pdf', 'jpg');
    
    // Set the max file size in bytes
    $simpleUpload->setMaxFileSize(500000);
    
    // Upload the file. Should correspond to the name attribute in the form.
    $simpleUpload->upload($_FILES["fileToUpload"]);
    
    if ($simpleUpload->successful) {
      echo 'Upload Successful';
    } else {
      echo 'Upload Failed';
    }
    
