$(document).ready(function()
{
       //scripts for data tables
        $("#example1").DataTable();
        $('#example2').DataTable
        ({
          "paging": true,
          "lengthChange": false,
          "searching": false,
          "ordering": true,
          "info": true,
          "autoWidth": false
        });

        //script for success alert
        $('#success').fadeOut(3000);

        



   
        // CKEDITOR.replace('editorCk',
        //         {
        //             filebrowserBrowseUrl: 'assets/plugin/ckfinder/ckfinder.html',
        //             filebrowserImageBrowseUrl: 'assets/plugin/bower_components/ckfinder/ckfinder.html?type=Images',
        //             filebrowserFlashBrowseUrl: 'assets/plugin/bower_components/ckfinder/ckfinder.html?type=Flash',
        //             filebrowserUploadUrl: 'assets/plugin/ckfinder/bower_components/core/connector/java/connector.java?command=QuickUpload&type=Files',
        //             filebrowserImageUploadUrl: 'assets/plugin/bower_components/ckfinder/core/connector/java/connector.java?command=QuickUpload&type=Images',
        //             filebrowserFlashUploadUrl: 'assets/plugin/bower_components/ckfinder/core/connector/java/connector.java?command=QuickUpload&type=Flash'
        //         });


});
     
    
















