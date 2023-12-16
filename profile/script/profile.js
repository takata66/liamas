$(document).ready(function() {
    
    function checkUserData() {
        $.ajax({
            url: '/liamas/profile/logic/check_user_data.php', 
            type: 'GET',
            success: function(response) {
                
                if (response.allFieldsFilled) {
                    $('.form-buttons').prop('disabled', true);
                } else {
                    $('.form-buttons').prop('disabled', false);
                }
            }
        });
    }
    checkUserData();
});