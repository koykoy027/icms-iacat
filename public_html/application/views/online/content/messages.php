<?php
/**
 * Page Security
 */
defined('BASEPATH') OR exit('No direct script access allowed');
//echo"<pre>";
// print_r($_SESSION);
//
//echo $this->yel->generateCaseControlNumber();
?>
<div class="page-content">

    <!-- BEGIN PAGE CONTENT INNER -->
    <div class="page-content-inner">
        <div class="mt-content-body">
            <div class="row container-padding" >
                <div class="col-12">
                    <div class="card" >
                        <div class="row"> 

                            <div class="col-lg-12 col-md-12 col-sm-12"> 
                                <div class="card-title">
                                    <p>All Messages</p>
                                    <small class="card-desc"> List of all departments : government and non government agencies.  </small> 
                                </div>
                            </div>

                        </div>
                        <div class="page-body-container">

                            <div class="div-list">
                                <div class="row">
                                    <div class="col-lg-5">
                                        <div class=" border-right"  >
                                            <div class="card message-card" >
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <span class="text-left tab-content-title">Inbox</span>
                                                    </div>
                                                    <div class="col-lg-6 float-right ">
                                                        <div class="float-right">
                                                            <span class=" p-y-0 p-x-10 " id="addon-wrapping" style="display: none;"><i class="fa fa-search" aria-hidden="true"></i></span>
                                                            <span class=" d-inline-block p-y-0 p-x-10 msg-icon"><i class="fa fa-envelope" aria-hidden="true"></i></span>
                                                        </div>

                                                    </div>
                                                </div>

                                            </div>

                                            <div class="card message" >
                                                <div class="input-group flex-nowrap">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="addon-wrapping"><i class="fa fa-search" aria-hidden="true"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control message_search" placeholder="Search" aria-label="Search" aria-describedby="addon-wrapping">
                                                </div>
                                            </div>
                                            <div class="card" >

                                                <div class=" inbox_chat">
                                                    <ul class="list-group list-group-flush">

                                                        <li class="list-group-item active">
                                                            <div class="d-flex bd-highlight">
                                                                <div class="p-2 flex-shrink-1 bd-highlight"> 
                                                                    <div class="dropdown-list-image  d-inline-block">
                                                                        <img class="rounded-circle" src="<?= SITE_ASSETS ?>global/images/user-img.jpeg"  alt="" style="    width: 35px;">
                                                                        <div class="status-indicator bg-success"></div>
                                                                    </div>
                                                                </div>
                                                                <div class="p-2 w-100 bd-highlight">
                                                                    <div class="font-weight-bold d-inline-block">
                                                                        <div class="">Emily Fowler <span class="active-contact"></span> <span class="float-right text-gray-500 small " style=" line-height: 21px;">58m</span></div>
                                                                        <div class="small ">IACAT - Main</div>
                                                                        <div class="small text-gray-500 text-truncate">Hi there! I am wondering if you can help me with a problem I've been having.</div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </li>
                                                        <li class="list-group-item">
                                                            <div class="d-flex bd-highlight">

                                                                <div class="p-2 flex-shrink-1 bd-highlight"> 
                                                                    <div class="dropdown-list-image  d-inline-block">
                                                                        <img class="rounded-circle"  src="<?= SITE_ASSETS ?>global/images/user-img3.jpeg" alt="" style="    width: 35px;">
                                                                        <div class="status-indicator bg-success"></div>
                                                                    </div>

                                                                </div>
                                                                <div class="p-2 w-100 bd-highlight">
                                                                    <div class="font-weight-bold d-inline-block">
                                                                        <div class="">Jane Mary Anderson  <span class="active-contact"></span> <span class="float-right text-gray-500 small " style=" line-height: 21px;">1d</span></div>
                                                                        <div class="small  ">OPLE Center</div>
                                                                        <div class="small text-gray-500 text-truncate">Hi there! I am wondering if you can help me with a problem I've been having.</div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <div class="d-flex bd-highlight">

                                                                <div class="p-2 flex-shrink-1 bd-highlight"> 
                                                                    <div class="dropdown-list-image  d-inline-block">
                                                                        <img class="rounded-circle" src="<?= SITE_ASSETS ?>global/images/user-img2.jpeg" alt="" style="    width: 35px;">
                                                                        <div class="status-indicator bg-success"></div>
                                                                    </div>

                                                                </div>
                                                                <div class="p-2 w-100 bd-highlight">
                                                                    <div class="font-weight-bold d-inline-block">
                                                                        <div class="">Anna Cay Raymundo  <span class="float-right text-gray-500 small " style=" line-height: 21px;">3d</span></div>
                                                                        <div class="small  ">PNP- Makati</div>
                                                                        <div class="small text-gray-500 text-truncate">Hi there! I am wondering if you can help me with a problem I've been having.</div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <div class="d-flex bd-highlight">

                                                                <div class="p-2 flex-shrink-1 bd-highlight"> 
                                                                    <div class="dropdown-list-image  d-inline-block">
                                                                        <img class="rounded-circle"  src="<?= SITE_ASSETS ?>global/images/user-img3.jpeg" alt="" style="    width: 35px;">
                                                                        <div class="status-indicator bg-success"></div>
                                                                    </div>

                                                                </div>
                                                                <div class="p-2 w-100 bd-highlight">
                                                                    <div class="font-weight-bold d-inline-block">
                                                                        <div class="">Richard San Pedro  <span class="float-right text-gray-500 small " style=" line-height: 21px;">3d</span></div>
                                                                        <div class="small  ">DILG - Cavite</div>
                                                                        <div class="small text-gray-500 text-truncate">Hi there! I am wondering if you can help me with a problem I've been having.</div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <div class="d-flex bd-highlight">

                                                                <div class="p-2 flex-shrink-1 bd-highlight"> 
                                                                    <div class="dropdown-list-image  d-inline-block">
                                                                        <img class="rounded-circle" src="<?= SITE_ASSETS ?>global/images/user-img2.jpeg" alt="" style="    width: 35px;">
                                                                        <div class="status-indicator bg-success"></div>
                                                                    </div>

                                                                </div>
                                                                <div class="p-2 w-100 bd-highlight">
                                                                    <div class="font-weight-bold d-inline-block">
                                                                        <div class="">Francis Allen  <span class="active-contact"></span><span class="float-right text-gray-500 small " style=" line-height: 21px;">1w</span></div>
                                                                        <span class="small ">IACAT</span>
                                                                        <div class="small text-gray-500 text-truncate">Hi there! I am wondering if you can help me with a problem I've been having.</div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <div class="d-flex bd-highlight">

                                                                <div class="p-2 flex-shrink-1 bd-highlight"> 
                                                                    <div class="dropdown-list-image  d-inline-block">
                                                                        <img class="rounded-circle"  src="<?= SITE_ASSETS ?>global/images/user-img3.jpeg" alt="" style="    width: 35px;">
                                                                        <div class="status-indicator bg-success"></div>
                                                                    </div>

                                                                </div>
                                                                <div class="p-2 w-100 bd-highlight">
                                                                    <div class="font-weight-bold d-inline-block">
                                                                        <div class="">Richard San Pedro  <span class="float-right text-gray-500 small " style=" line-height: 21px;">3d</span></div>
                                                                        <div class="small  ">DILG - Cavite</div>
                                                                        <div class="small text-gray-500 text-truncate">Hi there! I am wondering if you can help me with a problem I've been having.</div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <div class="d-flex bd-highlight">

                                                                <div class="p-2 flex-shrink-1 bd-highlight"> 
                                                                    <div class="dropdown-list-image  d-inline-block">
                                                                        <img class="rounded-circle"  src="<?= SITE_ASSETS ?>global/images/user-img2.jpeg" alt="" style="    width: 35px;">
                                                                        <div class="status-indicator bg-success"></div>
                                                                    </div>

                                                                </div>
                                                                <div class="p-2 w-100 bd-highlight">
                                                                    <div class="font-weight-bold d-inline-block">
                                                                        <div class="">Richard San Pedro  <span class="float-right text-gray-500 small " style=" line-height: 21px;">3d</span></div>
                                                                        <div class="small  ">DILG - Cavite</div>
                                                                        <div class="small text-gray-500 text-truncate">Hi there! I am wondering if you can help me with a problem I've been having.</div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>



                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <div class="" >
                                            <div class="card " >
                                                <div class="d-flex bd-highlight">

                                                    <div class="p-2 p-l-0 flex-shrink-1 bd-highlight"> 
                                                        <div class="dropdown-list-image  d-inline-block">
                                                            <img src="<?= SITE_ASSETS ?>global/images/user-profile.png" alt="sunil" style="    width: 35px;">
                                                            <div class="status-indicator bg-success"></div>
                                                        </div>

                                                    </div>
                                                    <div class="p-2 w-100 bd-highlight">
                                                        <h6 class="text-bold ">Emily Fowler<span class="active-contact"></span> <br>
                                                            <div class="small txt-dark-grey">PNP- Makati</div></h6>
                                                    </div>
                                                </div>



                                                <div class="mesgs">
                                                    <div class="msg_history">
                                                        <div class="incoming_msg">
                                                            <div class="incoming_msg_img"> <img src="<?= SITE_ASSETS ?>global/images/user-profile.png" alt="sunil" style="    width: 35px;"> </div>
                                                            <div class="received_msg">
                                                                <div class="received_withd_msg">
                                                                    <p>Test which is a new approach to have all
                                                                        solutions</p>
                                                                    <span class="time_date"> 11:01 AM    |    June 9</span></div>
                                                            </div>
                                                        </div>
                                                        <div class="outgoing_msg">
                                                            <div class="sent_msg">
                                                                <p>Test which is a new approach to have all
                                                                    solutions</p>
                                                                <span class="time_date"> 11:01 AM    |    June 9</span> </div>
                                                        </div>
                                                        <div class="incoming_msg">
                                                            <div class="incoming_msg_img"> <img src="<?= SITE_ASSETS ?>global/images/user-profile.png"  alt="sunil" style="    width: 35px;"> </div>
                                                            <div class="received_msg">
                                                                <div class="received_withd_msg">
                                                                    <p>Test, which is a new approach to have</p>
                                                                    <span class="time_date"> 11:01 AM    |    Yesterday</span></div>
                                                            </div>
                                                        </div>
                                                        <div class="outgoing_msg">
                                                            <div class="sent_msg">
                                                                <p>Apollo University, Delhi, India Test</p>
                                                                <span class="time_date"> 11:01 AM    |    Today</span> </div>
                                                        </div>
                                                        <div class="incoming_msg">
                                                            <div class="incoming_msg_img"> <img src="<?= SITE_ASSETS ?>global/images/user-profile.png"  alt="sunil" style="    width: 35px;"> </div>
                                                            <div class="received_msg">
                                                                <div class="received_withd_msg">
                                                                    <p>We work directly with our designers and suppliers,
                                                                        and sell direct to you, which means quality, exclusive
                                                                        products, at a price anyone can afford.</p>
                                                                    <span class="time_date"> 11:01 AM    |    Today</span></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="type_msg">
                                                        <div class="input_msg_write">
                                                            <input type="text" class="write_msg" placeholder="Type a message" />
                                                            <button class="msg_send_btn" type="button"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>






                            </div>  

                        </div>







                    </div>
                </div> 
            </div> 
        </div> 
    </div> 
</div>


