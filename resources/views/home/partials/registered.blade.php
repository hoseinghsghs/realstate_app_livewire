<div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="registermodal" aria-hidden="true">
    <div class="modal-dialog modal-xl login-pop-form" role="document">
        <div class="modal-content overli" id="registermodal">
            <div class="modal-body p-0">
                <div class="resp_log_wrap">
                    <div class="resp_log_thumb" style="background:url(assets/home/img/log.jpg)no-repeat;"></div>
                    <div class="resp_log_caption">
                        <span class="mod-close" data-dismiss="modal" aria-hidden="true"><i class="ti-close"></i></span>
                        <div class="edlio_152">
                            <ul class="nav nav-pills tabs_system center" id="pills-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="pills-login-tab" data-toggle="pill"
                                        href="#pills-login" role="tab" aria-controls="pills-login"
                                        aria-selected="true"><i class="fas fa-sign-in-alt ml-2"></i>ورود</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-signup-tab" data-toggle="pill" href="#pills-signup"
                                        role="tab" aria-controls="pills-signup" aria-selected="false"><i
                                            class="fas fa-user-plus ml-2"></i>ثبت نام</a>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-login" role="tabpanel"
                                aria-labelledby="pills-login-tab">
                                <div class="login-form">
                                    <livewire:Auth.login />

                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-signup" role="tabpanel"
                                aria-labelledby="pills-signup-tab">
                                <div class="login-form">
                                    <livewire:Auth.register />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
