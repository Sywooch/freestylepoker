/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


 jQuery(document).ready(function () {
        jQuery('#video-section + .iCheck-helper, .field-video-section label').attr('onclick', 'fun()');
    });
    
    fun();
    function fun() {
        x = $('#video-section').prop('checked');
        if (x === true) {
            $('#video-ids').attr('disabled', 'disabled');
            $('#video-id_training').attr('disabled', 'disabled');
            $('#video-val').attr('disabled', 'disabled');
            $('#video-password').attr('disabled', 'disabled');
            $('#subcat-id').attr('disabled', 'disabled');
            $('#video-tags').attr('disabled', 'disabled');     
        }
        else {
            $('#video-ids').removeAttr('disabled');
            $('#video-id_training').removeAttr('disabled');
            $('#video-val').removeAttr('disabled');
            $('#video-password').removeAttr('disabled');
            $('#subcat-id').removeAttr('disabled');
            $('#video-tags').removeAttr('disabled');
        }
    };