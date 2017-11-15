CKEDITOR.editorConfig = function( config ) {

    var base_url = document.getElementById('base-url').value;
    config.allowedContent = true;
    config.extraAllowedContent = '*(*);*{*}';
    config.protectedSource.push(/<i[^>]*><\/i>/g);
    config.filebrowserImageBrowseUrl = base_url+'assets/plugins/ckfinder/ckfinder.html?type=Images';
    config.uiColor = '#f1f1f1';
};

