function close_window() {
    parent.lightbox.close();
    $.lightbox.close();
    parent.$.lightbox.close();
} 

CKEDITOR.replace( 'site[paginaSobre]' ,{
	filebrowserBrowseUrl : '/filemanager/dialog.php?type=2&editor=ckeditor&fldr=',
	filebrowserUploadUrl : '/filemanager/dialog.php?type=2&editor=ckeditor&fldr=',
    filebrowserImageBrowseUrl : '/filemanager/dialog.php?type=1&editor=ckeditor&fldr=',
    height: 200
} );
