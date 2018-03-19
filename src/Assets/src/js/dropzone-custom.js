Dropzone.options.fileDropzone = {
    paramName: "location",
    addRemoveLinks: true,
    autoProcessQueue: false,
    init: function() {
        this.on("success", function(file, responseText) {
            file.serverData = responseText.data;
            $(['name', 'original', 'mime', 'size']).each(function() {
                $("#fileDetailsForm").prepend('<input id="file_'+file.serverData.name+'" name="location['+file.serverData.name+']['+this+']" value="'+file.serverData[this]+'" type="hidden" />');
            });
            this.options.autoProcessQueue = true;
        });
        this.on("queuecomplete", function(){
            $('#fileDetailsForm').submit();
        });
        this.on("removedfile", function(file) {
            if (! file.serverData) {
                return;
            } else {
                $.get(_url+"/cms/files/remove/"+file.serverData.name);
                $("#file_"+file.serverData.name).remove();
            }
        });
    },
    accept: function(file, done) {
        done();
    }
};