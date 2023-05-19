<link rel="shortcut icon" href="<?php echo base_url();?>assets/global/favicon.png">
<!-- Neon theme css -->
<link rel="stylesheet" href="<?php echo base_url('assets/backend/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css');?>" type="text/css">
<link rel="stylesheet" href="<?php echo base_url('assets/backend/css/font-icons/entypo/css/entypo.css');?>" type="text/css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600" type="text/css">
<link rel="stylesheet" href="<?php echo base_url('assets/backend/css/bootstrap.css');?>" type="text/css">
<link rel="stylesheet" href="<?php echo base_url('assets/backend/css/neon-core.css');?>" type="text/css">
<link rel="stylesheet" href="<?php echo base_url('assets/backend/css/neon-theme.css');?>" type="text/css">
<link rel="stylesheet" href="<?php echo base_url('assets/backend/css/neon-forms.css');?>" type="text/css">
<link rel="stylesheet" href="<?php echo base_url('assets/backend/css/custom.css');?>" type="text/css">
<link rel="stylesheet" href="<?php echo base_url('assets/backend/js/vertical-timeline/css/component.css');?>" type="text/css">
<link rel="stylesheet" href="<?php echo base_url('assets/backend/js/datatable/css/dataTables.bootstrap.css');?>" type="text/css"/>
<link rel="stylesheet" href="<?php echo base_url('assets/backend/js/datatable/buttons/css/buttons.bootstrap.css');?>" type="text/css"/>
<link rel="stylesheet" href="<?php echo base_url('assets/backend/js/wysihtml5/bootstrap-wysihtml5.css');?>" type="text/css">
<link rel="stylesheet" href="<?php echo base_url('assets/backend/js/dropzone/dropzone.css');?>" type="text/css">
<link rel="stylesheet" href="<?php echo base_url('assets/backend/js/daterangepicker/daterangepicker-bs3.css');?>" type="text/css">
<!-- font awesome 5 -->
<link href="<?php echo base_url('assets/backend/css/fontawesome-all.min.css') ?>" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url('assets/backend/css/font-awesome-icon-picker/fontawesome-iconpicker.min.css') ?>" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css">
<link href="<?php echo base_url('assets/backend/css/main.css') ?>" rel="stylesheet" type="text/css" />

<!-- Bootstrap Sweet Alert CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.css">
<!-- RTL Theme -->
<?php if ($text_align == 'right-to-left') : ?>
    <link rel="stylesheet" href="<?php echo base_url('assets/backend/css/neon-rtl.css');?>">
<?php endif; ?>
<script src="<?php echo base_url('assets/backend/js/jquery-2.2.4.min.js'); ?>" charset="utf-8"></script>
<!-- AM Chart resources -->
<script src="https://www.amcharts.com/lib/4/core.js"></script>
<script src="https://www.amcharts.com/lib/4/charts.js"></script>
<script src="https://www.amcharts.com/lib/4/themes/animated.js"></script>


<style type="text/css">
        /*Loading gif code*/
        .loader {
            position: fixed !important;
            left: 0px;
            top: 0px;
            width: 100%;
            height: 100%;
            z-index: 9999;
            background: url('<?php echo base_url();?>/assets/backend/images/loader.gif') 50% 50% no-repeat rgb(249,249,249) !important;
            opacity: .8;
        }
        .sweet-alert{
            background-color: #fff;
            width: 478px;
            padding: 17px;
            border-radius: 5px;
            text-align: center;
            left: 50%;
            top: 30% !important;
            margin-left: 0px !important;
            margin-top: 0px !important;
            overflow: hidden;
            z-index: 2000;
        }
        .sweet-alert  .showSweetAlert .visible{
            margin-top: 0px !important;
        }
        @media screen and (min-width: 1200px) and (max-width: 1900px){
            .sweet-alert{
                background-color: #fff !important;
                width: 478px !important;
                padding: 17px !important;
                border-radius: 5px !important;
                text-align: center !important;
                left: 40% !important;
                top: 30% !important;
                margin-left: 0px !important;
                margin-top: 0px !important;
                overflow: hidden !important;
                z-index: 2000 !important;
            }
        }
        @media screen and (min-width: 991px) and (max-width: 1200px){
            .sweet-alert{
                background-color: #fff !important;
                width: 478px !important;
                padding: 17px !important;
                border-radius: 5px !important;
                text-align: center !important;
                left: 30% !important;
                top: 24% !important;
                margin-left: 0px !important;
                margin-top: 0px !important;
                overflow: hidden !important;
                z-index: 2000 !important;
            }
        }
        @media screen and (min-width: 768px) and (max-width: 991px) {
            .sweet-alert{
                background-color: #fff !important;
                width: 478px !important;
                padding: 17px !important;
                border-radius: 5px !important;
                text-align: center !important;
                left: 30% !important;
                top: 32% !important;
                margin-left: 0px !important;
                margin-top: 0px !important;
                overflow: hidden !important;
                z-index: 2000 !important;
            }
        }
        @media screen and (max-width: 768px) {
            .sweet-alert{
                background-color: #fff;
                width: 478px;
                padding: 17px;
                border-radius: 5px;
                text-align: center;
                left: 24%;
                top: 30% !important;
                margin-left: 0px !important;
                margin-top: 0px !important;
                overflow: hidden;
                z-index: 2000;
            }
        }
        @media screen and (min-width: 575px) and (max-width: 700px) {
            .sweet-alert {
                background-color: #fff;
                width: 328px !important;
                padding: 17px;
                border-radius: 5px;
                text-align: center;
                left: 24%;
                top: 30% !important;
                margin-left: 0px !important;
                margin-top: 0px !important;
                overflow: hidden;
                z-index: 2000;
            }
        }
        @media screen and (min-width: 380px) and (max-width: 575px) {
            .sweet-alert {
                background-color: #fff;
                width: 327px !important;
                padding: 17px;
                border-radius: 5px;
                text-align: center;
                left: 12% !important;
                top: 30% !important;
                margin-left: 0px !important;
                margin-top: 0px !important;
                overflow: hidden;
                z-index: 2000;
            }
        }
        @media screen and (min-width: 320px) and (max-width: 380px) {
            .sweet-alert {
                background-color: #fff;
                width: 230px !important;
                padding: 17px;
                border-radius: 5px;
                text-align: center;
                left: 12% !important;
                top: 30% !important;
                margin-left: 0px !important;
                margin-top: 0px !important;
                overflow: hidden;
                z-index: 2000;
            }
        }
    </style>