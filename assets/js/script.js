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

$('#noticeDate').datepicker({
        startDate: 'today',

        autoclose: true,
        format: 'yyyy-mm-dd',
        todayHighlight: true
 });

