var base_url = $('#base-url').val();

/* load ckeditor starts */
function load_ckeditor(textarea, customConfig) {
    if (customConfig) {
        configFile = base_url + 'assets/plugins/ckeditor/custom/minimal.js';
    } else {
        configFile = base_url + 'assets/plugins/ckeditor/custom/full.js';
    }

    CKEDITOR.replace(textarea, {
        customConfig: configFile
    });
    console.log(configFile);
}
/* load ckeditor ends */


$('p#pass').fadeOut(5000);
$('p#cpass').fadeOut(5000);


//datepicker


$('#newsDate').datepicker({
        startDate: 'today',

        autoclose: true,
        format: 'yyyy-mm-dd',
        todayHighlight: true

 });

function getSubCat(id)
{
    var url=base_url+'admin/news/get_sub_cat_title';
    $.post(url,{data:id,sub_cat:""},function(response){
        if(response=="")
        {
           
            $('#subcat').html("");
        }else
        {
            $('#subcat').append(response);
        }
       
    });

}

var id=$('#parent_cat').val();
if(id)
{

    var url=base_url+'admin/news/get_sub_cat_title';
    var sub_cat_id=$('#sub_cat').val();

     $.post(url,{data:id,sub_cat:sub_cat_id},function(response){
        if(response=="")
        {
           
            $('#subcat').html("");
        }else
        {
            $('#subcat').append(response);
        }
       
    });


}

$('#create_news').validate();

    


