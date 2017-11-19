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

/*alert message hide*/
$('.alert-success').fadeOut(5000);




/*date picker*/
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

/*editing the news for category*/
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

/*form validations*/
$('#create_news').validate();
$('#create_landmark').validate();
$('#page_category').validate();
$('#news_category').validate();
$('#create_user').validate();
$('#page_group').validate();
$('#page_create').validate();

/*for model popup*/
$('.user_detail').on('click',function(){
    var user_id=$(this).data("id");
     $('#user-details').removeData();
     $('#user-details').modal();
     $.ajax({
        type:'POST',
        url:base_url+'admin/user/user_details',
        dataType:'json',
        data:{id:user_id},
        success:function(response)
        {
            $('#firstname').val(response.first_name);
            $('#middlename').val(response.middle_name);
            $('#lastname').val(response.last_name);
            $('#username').val(response.username);
            $('#email').val(response.email);
            $('#ipaddress').val(response.ip_address);
            $('#status').val(response.status);
            $('#created_at').val(response.created_at);
            console.log(response.first_name);
        }

     });


});



    


