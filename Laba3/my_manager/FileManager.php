<?php

    $path = $_SERVER['DOCUMENT_ROOT'];
    echo $path;
    
    #Add
    if (isset($_FILES['userfiles'])) {
        foreach($_FILES['userfiles']['error'] as $key=>$value) {
            if($_FILES['userfiles']['error'][$key] === UPLOAD_ERR_OK) { 
                $newFullName = $path . '/' . $_FILES['userfiles']['name'][$key];
                if (move_uploaded_file($_FILES['userfiles']['tmp_name'][$key],
                    $newFullName)) {
                    echo $_FILES['userfiles']['name'][$key] . ' is loaded </br>';    
                    showFileContent('/' . $_FILES['userfiles']['name'][$key], $path);
                }
                else {
                    echo $_FILES['userfiles']['name'] . ' is not loaded <br>';
                }
            }
        }
    }
    
    #Delete
    if (isset($_GET['del'])) {
        unlink($_GET['del']);
        echo '</br>The file ' . $_GET['del'] . ' has been deleted </br>';
        unset($_GET['del']);
        update($path, $folders, $files);
    }
    
    #Copy to
    if (isset($_GET['copy'])) {
        $newFolders = array();
        $files = array();
        $newPath = isset($_GET['copyPath']) ? $_GET['copyPath'] : $path;
        update($newPath, $newFolders, $files);
        echo $newPath;
        ?> 
            <a title="Copy" href="?copy&finish&filename=<?php echo $_GET['filename']?>&copyPath=<?php echo $_GET['copyPath']; ?>">
                </br><button>Переместить</button></br></a>
        <?php
        if (isset($_GET['finish'])) {
            rename($_GET['filename'], $newPath . '/' . basename($_GET['filename']));
            unset($_GET['copy']);
            echo $_GET['filename'] . ' is moved to ' . $_GET['copyPath'] .'</br>';
        }
        foreach($newFolders as $folder) {
            ?>
            <a href="?copy&copyPath=<?php echo $newPath . '/' . $folder;?>&filename=<?php echo $_GET['filename'];?>"><?php echo $folder;?></br></a>
            <?php
        }
        echo '--------------------------</br>';
    }
    
    
    
    $folders = array();
    $files = array();
    update($path, $folders, $files);
    
##Creating table    
?>
<form action="FileManager.php" method="post" enctype="multipart/form-data">
<table>
    <tr><td><a href="?upl">Upload</a></td></tr>
    <tr><td>Name</td><td>Size</td></tr>
<?php
    foreach($files as $file) {
        $fileSize = filesize($path . '/' . $file);
?>
            <tr><td><?php echo $file;?></td><td><?php echo $fileSize;?></td>
                <td><a title='Delete' href="?del=<?php echo $path . '/' . $file;?>">Delete</a></td>
                    <td><a title="copyto" href="?copy&filename=<?php echo $path . '/' . $file;?>
                        &copyPath=<?php echo $path;?>">Copy to</a></td></tr>
<?php        }?>
</table>
<input type="file" name="userfiles[]">
<input type="submit" value="Добавить" />
</form>
<?php
    ##functions
function update($path, &$folders, &$files) {
    echo 'Updating...';
    $objects = scandir($path);
    if (is_array($objects)) {
        foreach($objects as $obj) {
             $newPath = $path . '/' . $obj;
             if(is_file($newPath)) {
                $files[] = $obj;
            }
            else {
                if (is_dir($newPath)) {
                    $folders[] = $obj;
                }
            }
        }
    }             
}        

function clear(&$array) {
    foreach($array as $key=>$value) {
        if(isset($array[$key])) {
            unset($array[$key]);
        }
    }
}

function showFileContent($fileName, $path) {
    $imageExtensions = array('png' => 'png', 'jpg' => 'jpg');
    $textExtensions = array('txt' => 'txt', 'c' => 'c');
    $extension = getExtension($fileName);
    echo $extension;
    if (isset($imageExtensions[$extension])) {
        showImageContent($fileName);
    }
    else {
        if (isset($textExtensions[$extension])) {
            showTextContent($path . $fileName);
        }
    }
}

function getExtension($fileName) {
    $info = new SplFileInfo($fileName);
    return $info->getExtension();
}

function showImageContent($fileName) {
    echo $fileName . '</br>'; 
    echo "<img src='$fileName' height='100' width='100'/>";
}

function showTextContent($fileName) {
    echo '</br>';
    $f = fopen($fileName, 'r');
    $counter = 0;
    if (!$f) {
        echo 'The file can not be open</br>';
    }
    else {
        while(!feof($f) && $counter < 30) {
            $ch = fgetc($f);
            echo $ch;
        }
        fclose($f);
        echo '</br>';
    }
}

