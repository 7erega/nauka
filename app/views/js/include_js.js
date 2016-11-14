include('app/views/bootstrap/js/bootstrap.min.js');
include('app/views/js/calculator.js');
include('app/views/js/upload.js');
include('app/views/js/io.js');
include('app/views/js/controller.js');
include('system/lib/upload/js/AjaxFileUpload(XHR2).js');
include('system/lib/qb/js/qb.js');
include('app/views/js/libs/jquery.validate.min.js');
include('app/views/js/scripts.js');

function include(url) {
    document.write('<script type="text/javascript" src="'+ url + '"></script>');
    return false ;
}