$(function(){

    $("#saveFilesBtn").click(function(e){
        e.preventDefault();
        Dropzone.forElement(".dropzone").processQueue();
    });

});

function confirmDelete (url) {
    $('#deleteBtn').attr('href', url);
    $('#deleteModal').modal('toggle');
}
