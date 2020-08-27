<?php/* Template Name: Xero Template */get_header();?><?phpglobal $wpdb;$tok_res = $wpdb->get_results("SELECT * FROM `xero_token`", ARRAY_A);?><div style="display: none;" id="loader-wrapper">    <div id="loader"></div></div><div class="main-container xero_main">    <div class="projects-section">        <div class="wrapper overflow xero_sec">            <h3>Xero Connection</h3>            <div class="logos">                <ul>                    <li class="litt_wid">                        <img title="little fish" src="<?php echo get_template_directory_uri(); ?>/img/little_fish_logo.png"/>                    </li>                    <li class="check_wid">                        <?php if(count($tok_res)){ ?>                            <span class="xero_hype_left">---</span>                            <div class="checkmark">                                <div class="checkmark_circle"></div>                                <div class="checkmark_stem"></div>                                <div class="checkmark_kick"></div>                            </div>                            <span class="xero_hype_right">---</span>                        <?php }else{ ?>                            <div class="close_icon">                                <span class="xero_hype_left">---</span>                                <span class="close-icon"></span>                                <span class="xero_hype_right">---</span>                            </div>                        <?php } ?>                    </li>                    <li class="xero_wid">                        <img title="xero" src="<?php echo get_template_directory_uri(); ?>/img/xero_logo.png"/>                    </li>                    <li class="xero_button">                        <?php if(count($tok_res)){ ?>                            <button class="dis_connect_button">Disconnect with Xero</button>                       <?php }else{ ?>                            <span class="xero_hidden" data-xero-sso data-label="Connect to Xero" id="target"></span>                        <?php } ?>                    </li>                </ul>            </div>        </div>    </div></div><style>    .logos {        width: 100%;        text-align: center;    }    .xero_sec ul li {        text-align: center;        float: left;        list-style: none;    }    .xero_hype_left{        float:left;        font-weight: bold;        padding-right: 2px;    }    .xero_wid {        border-right: 2px solid #ddd;    }    .xero_hype_right{        float:right;        font-weight: bold;        padding-left: 2px;    }    .xero_sec ul li.litt_wid, .xero_sec ul li.xero_wid, .xero_sec ul li.xero_button{        width:25%;    }    .xero_sec ul li.check_wid{        width: auto;        margin-top: 16px;        margin-bottom: 16px;    }    .xero_wid img {        max-width: 26%;    }    .checkmark {        display:inline-block;        width: 22px;        height:22px;        -ms-transform: rotate(45deg); /* IE 9 */        -webkit-transform: rotate(45deg); /* Chrome, Safari, Opera */        transform: rotate(45deg);        margin-top:2px;    }    .checkmark_circle {        position: absolute;        width:22px;        height:22px;        background-color: green;        border-radius:11px;        left:0;        top:0;    }    .checkmark_stem {        position: absolute;        width:3px;        height:9px;        background-color:#fff;        left:11px;        top:6px;    }    .checkmark_kick {        position: absolute;        width:3px;        height:3px;        background-color:#fff;        left:8px;        top:12px;    }    .xero_sec .logos ul {        text-align: center;        box-shadow: 5px 5px 10px;        padding: 5em;        background-color: #eee;        display: inline-block;        width: 100%;    }    .main-container.xero_main{        padding: 0 0!important;    }    .xero_button {        margin-top: 12px;        margin-bottom: 12px;        width: 40% !important;    }    .dis_connect_button {        padding: 8px;        background-color: #fff;        cursor: pointer;        color: #404756;        border-radius: 5px;        box-shadow: 0 1px 2px #e6e7e9;        border: 1px solid #ddd;    }    .close-icon {        float:left;        display:block;        box-sizing:border-box;        width:20px;        height:20px;        border-width:3px;        border-style: solid;        border-color:red;        border-radius:100%;        background: -webkit-linear-gradient(-45deg, transparent 0%, transparent 46%, white 46%,  white 56%,transparent 56%, transparent 100%), -webkit-linear-gradient(45deg, transparent 0%, transparent 46%, white 46%,  white 56%,transparent 56%, transparent 100%);        background-color:red;        box-shadow:0px 0px 5px 2px rgba(0,0,0,0.5);        transition: all 0.3s ease;        margin-left:5px;        margin-right:5px;    }    .close_icon .xero_hype_left {        float: left;        width: auto;        line-height: 21px;    }    .close_icon .xero_hype_right {        float: right;        width: auto;        line-height: 21px;    }        #loader-wrapper {        position: fixed;        top: 0;        left: 0;        width: 100%;        height: 100%;        z-index: 1000;        background-color: #eee;        opacity: 0.5;    }    #loader {        display: block;        position: relative;        left: 50%;        top: 50%;        width: 150px;        height: 150px;        margin: -75px 0 0 -75px;        border-radius: 50%;        border: 3px solid transparent;        border-top-color: #3498db;        -webkit-animation: spin 2s linear infinite; /* Chrome, Opera 15+, Safari 5+ */        animation: spin 2s linear infinite; /* Chrome, Firefox 16+, IE 10+, Opera */    }    #loader:before {        content: "";        position: absolute;        top: 5px;        left: 5px;        right: 5px;        bottom: 5px;        border-radius: 50%;        border: 3px solid transparent;        border-top-color: #e74c3c;        -webkit-animation: spin 3s linear infinite; /* Chrome, Opera 15+, Safari 5+ */        animation: spin 3s linear infinite; /* Chrome, Firefox 16+, IE 10+, Opera */    }    #loader:after {        content: "";        position: absolute;        top: 15px;        left: 15px;        right: 15px;        bottom: 15px;        border-radius: 50%;        border: 3px solid transparent;        border-top-color: #f9c922;        -webkit-animation: spin 1.5s linear infinite; /* Chrome, Opera 15+, Safari 5+ */        animation: spin 1.5s linear infinite; /* Chrome, Firefox 16+, IE 10+, Opera */    }    @-webkit-keyframes spin {        0%   {            -webkit-transform: rotate(0deg);  /* Chrome, Opera 15+, Safari 3.1+ */            -ms-transform: rotate(0deg);  /* IE 9 */            transform: rotate(0deg);  /* Firefox 16+, IE 10+, Opera */        }        100% {            -webkit-transform: rotate(360deg);  /* Chrome, Opera 15+, Safari 3.1+ */            -ms-transform: rotate(360deg);  /* IE 9 */            transform: rotate(360deg);  /* Firefox 16+, IE 10+, Opera */        }    }    @keyframes spin {        0%   {            -webkit-transform: rotate(0deg);  /* Chrome, Opera 15+, Safari 3.1+ */            -ms-transform: rotate(0deg);  /* IE 9 */            transform: rotate(0deg);  /* Firefox 16+, IE 10+, Opera */        }        100% {            -webkit-transform: rotate(360deg);  /* Chrome, Opera 15+, Safari 3.1+ */            -ms-transform: rotate(360deg);  /* IE 9 */            transform: rotate(360deg);  /* Firefox 16+, IE 10+, Opera */        }    }</style><script type="text/javascript">    jQuery(document).ready(function() {        jQuery(document).on("click",".dis_connect_button",function() {            jQuery("#loader-wrapper").show();            var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";            var data = {                action: 'xero_disconnect'            };            jQuery.ajax({                type: 'post',                url: ajaxurl,                data: data,                success: function (response) {                    console.log(response);                    if(response == 'records_cleared'){                        jQuery("#loader-wrapper").hide();                        window.location.href = window.location.href;                    }                }            });        });    });</script><script src="https://edge.xero.com/platform/sso/xero-sso.js" async defer></script><?php get_footer(); ?>