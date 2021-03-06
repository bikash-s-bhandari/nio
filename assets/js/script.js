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

$("#press_publish_date").datepicker({
    startDate: 'today',
    autoclose: true,
    format: 'yyyy-mm-dd',
    todayHighlight: true

});

/*time picker*/
$(".start_time").timepicker({
    showInputs: false
});

$(".end_time").timepicker({
    showInputs: false
});

function getSubCat(id) {
    var url = base_url + 'admin/news/get_sub_cat_title';
    $.post(url, { data: id, sub_cat: "" }, function(response) {
        if (response == "") {

            $('#subcat').html("");
        } else {
            $('#subcat').append(response);
        }

    });

}

/*editing the news for category*/
var id = $('#parent_cat').val();
if (id) {

    var url = base_url + 'admin/news/get_sub_cat_title';
    var sub_cat_id = $('#sub_cat').val();

    $.post(url, { data: id, sub_cat: sub_cat_id }, function(response) {
        if (response == "") {

            $('#subcat').html("");
        } else {
            $('#subcat').append(response);
        }

    });


}

/*form validations*/
$('#create_news').validate();
$('#create_landmark').validate();
$('#create_counselor').validate();
$('#page_category').validate();
$('#news_category').validate();
$('#create_user').validate();
$('#page_group').validate();
$('#page_create').validate();
$('#landmark_category').validate();
$('#counselor_category').validate();
$('#create_event').validate();
$('#create_press_realese').validate();
$('#create_notice').validate();

/*for model popup*/
$('.user_detail').on('click', function() {
    var user_id = $(this).data("id");
    $('#user-details').removeData();
    $('#user-details').modal();
    $.ajax({
        type: 'POST',
        url: base_url + 'admin/user/user_details',
        dataType: 'json',
        data: { id: user_id },
        success: function(response) {
            // $('#firstname').val(response.first_name);
            // $('#middlename').val(response.middle_name);
            $('#fullname').val(response.full_name);
            $('#address').val(response.address);
            // $('#username').val(response.username);
            $('#email').val(response.email);
            // $('#ipaddress').val(response.ip_address);
            $('#status').val(response.status);
            $('#created_at').val(response.created_at);

        }

    });


});



/* for currency converter */

$('#from').on('change', function() {
    var from = $(this).val();
    var to = $('#to').val();

    if (from == "OMR") {
        $("#to").html('<option value="NPR">Neplease Rupee</option>');
    } else {
        $("#to").html('<option value="OMR">Omani rial</option>');
    }


    // if(from==to)
    // {

    //     $("#to option[value='"+to+"']").remove();
    // }else
    // {

    //     $('#to').append($("<option></option>").attr("value",to).text('test')); 
    // }

});

$('#to').on('change', function() {
    var to = $(this).val();
    var from = $('#from').val();
    if (to == from) {
        $("#from option[value='" + from + "']").remove();

    }


});

$('#convert').on('click', function(e) {
    e.preventDefault();
    var amount = $('#amount').val();
    var from = $('#from').val();
    var to = $('#to').val();
    var url = base_url + 'admin/currency/currencyConverter';
    if (amount == "") {
        alert('Amout is required');
    } else {

        $.post(url, { 'amount': amount, 'from': from, 'to': to }, function(data) {

            $('#result').val(data);

        });


    }


});

$('#start_date').datetimepicker({
    format: 'YYYY-MM-DD',
    minDate: 'now',
    ignoreReadonly: true

});
$('#end_date').datetimepicker({
    useCurrent: false, //Important! See issue #1025
    format: 'YYYY-MM-DD',
    minDate: 'now',
    ignoreReadonly: true
});
$("#start_date").on("dp.change", function(e) {
    $('#end_date').data("DateTimePicker").minDate(e.date);
});
$("#end_date").on("dp.change", function(e) {
    $('#start_date').data("DateTimePicker").maxDate(e.date);
});



//geocode

var locationForm = document.getElementById('create_landmark');
// Listen for submiot
//locationForm.addEventListener('submit', geocode);

function geocode() {
    setTimeout(function() {
        var location = document.getElementById('pac-input').value;

        axios.get('https://maps.googleapis.com/maps/api/geocode/json', {
                params: {
                    address: location,
                    key: 'AIzaSyBq_j4tHqMbNHCbk8EF0O39_XxjwN4XEcI'
                }
            })
            .then(function(response) {


                // Geometry
                var lat = response.data.results[0].geometry.location.lat;
                var lng = response.data.results[0].geometry.location.lng;
                lat = lat.toFixed(3);
                lng = lng.toFixed(3);


                var longitude = "<label for='longitude'>Longitude</label>";
                longitude += "<input type='text' name='longitude' value='" + lng + "' class='form-control'>";

                var latitude = "<label for='latitude'>Latitude</label>";
                latitude += "<input type='text' name='latitude' value='" + lat + "' class='form-control'>";
                $('#longitude').html(longitude);
                $('#latitude').html(latitude);



            })
            .catch(function(error) {
                console.log(error);
            });
    }, 1000);






}


/*for admin online status api*/

$('#login_status').on('click', function() {
    if (!$(this).hasClass('active')) {
        $.post(base_url + 'admin/user/login_status', { status: 1 }, function(data) {
            console.log(data);

        });

    } else {
        $.post(base_url + 'admin/user/login_status', { status: 0 }, function(data) {
            console.log(data);

        });

    }


});




/*for user reciept autocomplete*/
$('#users').autocomplete({
    source:base_url+'admin/user/search_user' ,
    select: function (event, ui) {
        console.log(ui);
        // $("#users").val(ui.item.label); // display the selected text
        $("#hiddenId").val(ui.item.studId); // save selected id to hidden input
    }
});
