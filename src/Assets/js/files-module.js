$(function(){

    $("#saveFilesBtn").click(function(e){
        e.preventDefault();
        Dropzone.forElement(".dropzone").processQueue();
    });

    $('#saveCategoryBtn').click(function(){
        $.ajax({
            type: "POST",
            url: _url+'/quarx/files/categories/create',
            data: {
                _token: _token,
                name: $('#categoryName').val()
            },
            cache: false,
            dataType: "html",
            success: function(data){
                if (JSON.parse(data).status === 'success') {
                    $('#categoryName').val('');
                    CollectCategories();
                    CollectCategoriesAsOptions();
                };
            }
        });
    });

    CollectCategories();
    CollectCategoriesAsOptions();

    $(document)
        .on('show.bs.modal', '.modal', function(event) {
            $(this).appendTo($('body'));
        })
        .on('shown.bs.modal', '.modal.in', function(event) {
            setModalsAndBackdropsOrder();
        })
        .on('hidden.bs.modal', '.modal', function(event) {
            setModalsAndBackdropsOrder();
    });

});

function confirmDelete (url) {
    $('#deleteBtn').attr('href', url);
    $('#deleteModal').modal('toggle');
}

function confirmCategoryDelete (url) {
    $('#deleteCategoryBtn').attr('href', url);
    $('#deleteCategoryModal').modal('toggle');
}

function categories () {
    $('#categoryModal').modal('toggle');
}

function CollectCategories () {
    $.ajax({
        type: "GET",
        url: _url+'/quarx/files/categories/listing',
        cache: false,
        dataType: "html",
        success: function(data){
            $("#categoryTable").html(data)
        }
    });
}

function CollectCategoriesAsOptions () {
    $.ajax({
        type: "GET",
        url: _url+'/quarx/files/categories/options',
        cache: false,
        dataType: "html",
        success: function(data){
            $("#File_category_id").html(data)
        }
    });
}

function setModalsAndBackdropsOrder() {
    var modalZIndex = 1040;
    $('.modal.in').each(function(index) {
        var $modal = $(this);
        modalZIndex++;
        $modal.css('zIndex', modalZIndex);
        $modal.next('.modal-backdrop.in').addClass('hidden').css('zIndex', modalZIndex - 1);
    });
    $('.modal.in:visible:last').focus().next('.modal-backdrop.in').removeClass('hidden');
}
