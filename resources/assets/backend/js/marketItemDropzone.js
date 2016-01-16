var previewNode = document.querySelector("#template");
previewNode.id = '';
var previewTemplate = previewNode.parentNode.innerHTML;
previewNode.parentNode.removeChild(previewNode);
var myDropzone = new Dropzone(document.body, {
  url: '/admin/market/item/image/store', 
  thumbnailWidth: 200,
  thumbnailHeight: 200,
  parallelUploads: 20,
  previewTemplate: previewTemplate,
  autoQueue: false, 
  previewsContainer: '#previews', 
  clickable: '.fileinput-button' 
});
function newItemForm() {
    if(myDropzone.getFilesWithStatus(Dropzone.ADDED).length > 0) {
        myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED));
        myDropzone.on('sending', function(file) {
            document.querySelector('#total-progress').style.opacity = '1';
            document.querySelector(".start").setAttribute('disabled', 'disabled');
        });
         myDropzone.on('totaluploadprogress', function(progress) {
            document.querySelector('#total-progress .progress-bar').style.width = progress + '%';
        });
        myDropzone.on('queuecomplete', function(progress) {
            document.querySelector('#total-progress').style.opacity = '0';
            document.getElementById('form').submit();
        });
    } else {
        document.getElementById('form').submit();
    }
};