$(function(){

    $("#saveImagesBtn").click(function(e){
        e.preventDefault();
        Dropzone.forElement(".dropzone").processQueue();
    });

});

