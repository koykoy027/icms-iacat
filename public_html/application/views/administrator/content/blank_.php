<div class="page-content-inner">
    <div class="content-body">    
        <div class="card" style="padding: 1rem;">
            <div class="content-body-container">
                <div class="row">
                    <div class="col-md-12 col-lg-12 col-sm-12">
                        <div class="card-title">
                            <p>  Alerts and Notifications</p>
                        </div>
                    </div>
                </div>
                <div class="card" style="padding: 1rem;padding-left: 0!important;">
                    <!--<div class="content-body-container "style="    border-bottom: 1px solid #eef3f7;padding-bottom:0px;" >--> 
                    <div class="content-body-container "> 
                        <div class="bd-example">

                            <div class="card-btn">
                                <h5>Warning Alert</h5>
                                <button type="button" class="btn btn-primary ml2" data-toggle="modal" data-target="#msgmodal-warning">
                                    Launch warning modal
                                </button>
                            </div>
                            <div class="card card-figure p-4">

                                <ul class="nav nav-tabs">
                                    <li class="nav-item">
                                        <a class="nav-link active nav-tab" data-toggle="tab" href="#html_warning">html</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link  nav-tab" data-toggle="tab" href="#js_warning">js</a>
                                    </li>
                                </ul>
                                <div class="tab-content tab-legal" >
                                    <div class="tab-pane fade show active " id="html_warning" role="tabpanel">
                                        <div class="tab-content tab-inner px-0 pt-0" >
                                            <pre>
                                  <code>
&lt;div class="modal fade  modal-warning" id="msgmodal-warning"  tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true"&gt;
  &lt;div class="modal-dialog modal-dialog-centered modal-sm" role="document"&gt;
    &lt;div class="modal-content"&gt;
       &lt;div class="modal-header p-0 msgmodal-error-header mb-0 pt-3" style="margin: 0 auto !important;"&gt;
            &lt;div class="modal-body  msgmodal-warning-body" id="modal-body-update"&gt;
                &lt;div class="row&gt;
                    &lt;div class="col-12"&gt;
                        &lt;div&gt; &lt;span class="notif-title"&gt; WARNING&lt;/span&gt; &lt;br&gt;  &lt;/div&gt;
                            &lt;p class="mt-3"  id="warning-msg"&gt; You're about to add new agency. &lt;/p&gt;
                        &lt;/div&gt;
                    &lt;/div&gt;
                &lt;/div&gt;
             &lt;/div&gt;
            &lt;div class="modal-footer msgmodal-warning-footer m-footer pt-2"> &lt;button type="button" class="btn btn-close-warning-modal" data-dismiss="modal"&gt; Back &lt;/button&gt;  &lt;/div&gt;
        &lt;/div&gt;
    &lt;/div&gt;
&lt;/div&gt;
                            </code>
                                            </pre>     
                                        </div>
                                    </div>
                                    <div class="tab-pane fade   " id="js_warning" role="tabpanel">
                                        <div class="tab-content tab-inner px-0 pt-0" >
                                            <textarea></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="bd-example">
                        </div>
                    </div> 
                </div>
            </div>
        </div>
    </div>
</div>



<!--<div class="page-content">

     BEGIN PAGE CONTENT INNER 
    <div class="page-content-inner">
        <div class="mt-content-body">
            <div class="row container-padding" >


                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
                    Launch demo modal
                </button>
            </div>
        </div>
    </div>
</div>-->




<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-info" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Agency Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>