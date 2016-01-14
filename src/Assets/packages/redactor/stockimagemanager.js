if (!RedactorPlugins) var RedactorPlugins = {};

RedactorPlugins.stockimagemanager = function()
{
    return {
        getTemplate: function()
        {
            return String()
            + '<section id="redactor-modal-stockimagemanager">'
            + '<div class="input-group">'
            + '<input id="stockimagemanager-filter" type="textbox" placeholder="Search" class="form-control">'
            + '<span class="input-group-btn">'
            + '<button class="btn btn-default" type="button" id="stockimagemanager-search"><span class="fa fa-search"></span></button>'
            + '</span>'
            + '</div>'
            + '<div id="stockimagemanager-container" class="raw-block-400 quarx-row raw-margin-top-24 raw-margin-bottom-24" style="overflow: scroll;"></div>'
            + '<div id="stockimagemanager-links" class="raw-block-20 quarx-row"><button id="stockImgPrevBtn" class="btn btn-default pull-left">Prev</button><button id="stockImgNextBtn" class="pull-right btn btn-default">Next</button></div>'
            + '</section>';
        },
        init: function()
        {
            var button = this.button.add('stockimagemanager', 'Insert Stock Image');
            this.button.setAwesome('stockimagemanager', 'fa-camera-retro');
            this.button.addCallback(button, this.stockimagemanager.show);
        },
        show: function()
        {
            this.modal.addTemplate('stockimagemanager', this.stockimagemanager.getTemplate());

            this.modal.load('stockimagemanager', 'Insert Stock Images', 600);

            this.modal.show();

            this.stockimagemanager.load();
        },
        search: function(_term, _page) {
            if (typeof _page == 'undefined') {
                _page = 1;
            };
            $.ajax({
                dataType: "json",
                cache: false,
                headers: {
                    ApiKey: 'tOJRcQXeCesSMprwbtU5'
                },
                url: this.opts.stockImageManagerJson + "/" + _term + "/null?page=" + _page,
                error: function(data){
                    console.log(data)
                },
                success: $.proxy(function(data)
                {
                    if (data.last_page == data.current_page) {
                        $("#stockImgNextBtn").hide();
                    } else  {
                        $("#stockImgNextBtn").show();
                    }

                    if (data.current_page == 1) {
                        $("#stockImgPrevBtn").hide();
                    } else  {
                        $("#stockImgPrevBtn").show();
                    }

                    $("#stockImgNextBtn").attr('data-page', parseInt(data.current_page) + 1);
                    $("#stockImgPrevBtn").attr('data-page', parseInt(data.current_page) - 1);

                    $('#stockimagemanager-container').html("");
                    $.each((data.data), $.proxy(function(key, val)
                    {
                        var img = $('<div class="raw25 pull-left thumbnail-box"><img class="img-responsive" data-img-name="'+ val.thumb +'" data-url="' + val.web + '" src="' + val.thumb + '" rel="' + val.thumb + '" style="cursor: pointer;" /></div>');
                        $('#stockimagemanager-container').append(img);
                        $(img).click($.proxy(this.stockimagemanager.insert, this));
                    }, this));

                }, this)
            });
        },
        load: function()
        {
            var _module = this.stockimagemanager;
            _module.search('null');
            $("#stockimagemanager-search").bind("click", function(){
                var _val = $("#stockimagemanager-filter").val();
                if (_val == '') {
                    _val = 'null';
                };
                _module.search(_val);
            });
            $("#stockImgPrevBtn, #stockImgNextBtn").bind("click", function() {
                var _val = $("#stockimagemanager-filter").val();
                if (_val == '') {
                    _val = 'null';
                };
                _module.search(_val, $(this).attr('data-page'));
            });
        },
        insert: function(e)
        {
            var _imageURL = '';
            var _this = this;
            $.ajax({
                type: 'POST',
                dataType: "json",
                cache: false,
                headers: {
                    ApiKey: 'tOJRcQXeCesSMprwbtU5'
                },
                data: {
                    _token: _token,
                    location: $(e.target).attr('data-url')
                },
                url: _url + '/quarx/api/images/store',
                error: function(data){
                    console.log(data)
                },
                success: $.proxy(function(data) {
                    e.preventDefault();
                    _this.insert.html('<img src="' + data.data.location + '" />', false);
                    _this.modal.close();
                }, this)
            });
        }
    };
};