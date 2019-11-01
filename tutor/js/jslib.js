
function checkFileSize(inputFile) {
   
    // CHECK FILE SIZE
    var max = (10*1024*1024); // 10 MB

    if (inputFile.files && inputFile.files[0].size > max ) {
        alert("File too large. Max = 10.0 MB"); // Do your thing to handle the error.
        inputFile.value = null; // Clears the field.
    }
    

    // CHECK FILE TYPE
    var fileExtension = ['mp4', 'webm'];
    if ($.inArray($(inputFile).val().split('.').pop().toLowerCase(), fileExtension) === -1) {
        
        alert("File is not an image! Only 'MP4' and 'WEBM' formats are allowed.");
         // Do your thing to handle the error.
         
         // blank out
        inputFile.value = null; // Clears the field.   
    }

}


/*
 * DOES NOT WORK !!!
 * 
function isFileImage(file) {
    return file && file['type'].split('/')[0] === 'image';
}
*/


