

<script src="http://administrator.dev.icms.com/assets/global/jquery/jquery.js"></script>

<?php
/**
 * Page Security
 */
defined('BASEPATH') OR exit('No direct script access allowed');
echo"<pre>";
print_r($_SESSION);
?>


<!-- BEGIN PAGE CONTENT BODY -->
<div class="page-content"> 
    <div class="container">

        <!-- BEGIN PAGE CONTENT INNER -->
        <div class="page-content-inner">
            <div class="content-body">      
                <div class="card">

                    <div class="card-content">


                        <form action="#"  enctype="multipart/form-data" accept-charset="utf-8" name="formname" id="form-upload"  method="post" action="">

                            <span >File</span>
                            <input type="file" id="file-upload-doc"  accept="image/*,application/pdf" >
                            <section class="upload-progress hide">
                                <div class="upload-progress-caption"></div>
                            </section>

                        </form>  

                    </div>
                </div>
            </div>
            <!-- END PAGE CONTENT INNER -->
        </div>
    </div>
    <!-- END PAGE CONTENT BODY -->
    <!-- END CONTENT BODY -->
</div>

<script>
    $(document).ready(function () {

        $('#file-upload-doc').change(function () {
            fileUpload();
        });
    });

    function fileUpload() {


        var data = new FormData();
        var file = document.getElementById("file-upload-doc").files;
        var uploadURL = window.location.origin + '/ajax/drive/ajax';
        data.append('file', file[0]);
        data.append('type', 'uploadFile');
        $.ajax({
            xhr: function ()
            {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function (evt) {

                    if (evt.lengthComputable) {
                        var percentComplete = evt.loaded / evt.total;
                        var total = percentComplete * 100;
                        var num = Math.round(total);
                        var percentVal = num + '%';
                        // progress bar 
                        progress = $('.upload-progress');
                        progress.removeClass('hide');
                        progress.find('.determinate').css('width', percentVal);
                        progress.find('.upload-progress-caption').html(" " + percentVal + " uploading file.");
                    }
                }, false);
                return xhr;
            },
            url: uploadURL,
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            data: data,
            type: 'POST',
            success: function (rs) {
//                var fileHash = rs.data.output.hash;
//
//
//                uploadApplicantDocument(fileHash);
            },
            error: function () {

                //something went wrong
//                location.reload();
            }

        });
    }

</script>