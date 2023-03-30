<?php
// Check if a file was uploaded
if(isset($_FILES['file'])) {
    $file = $_FILES['file'];
    $filename = $file['name'];
    $filetype = $file['type'];
    $filetmpname = $file['tmp_name'];
    
    // Check the file extension
    $ext = pathinfo($filename, PATHINFO_EXTENSION);
    
    // If the file is a TXT file
    if($ext == 'txt') {
        // Read the contents of the file
        $contents = file_get_contents($filetmpname);
        // Display the contents
        echo "<pre>$contents</pre>";
    }
    // If the file is a Python file
    elseif($ext == 'py') {
        // Highlight the code using Pygments
        require_once 'pygments.php';
        $code = file_get_contents($filetmpname);
        $highlighted_code = Pygments::highlight($code, 'python', 'html');
        // Display the highlighted code
        echo $highlighted_code;
    }
    // If the file is a PDF file
    elseif($ext == 'pdf') {
        // Display the PDF file
        header('Content-type: application/pdf');
        readfile($filetmpname);
    }
    // If the file is not a supported file type
    else {
        echo "Unsupported file type.";
    }
}
?>