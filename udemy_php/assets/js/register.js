$(document).ready(function(){

    //on click sighup, hide login and show registration form
    $("#signup").click(function(){
        $('#first').slideUp("slow",function(){
            $('#second').slideDown('slow');
        })
    });

    //on click sighin, hide registration form and hide login
    $("#signin").click(function(){
        $('#second').slideUp("slow",function(){
            $('#first').slideDown('slow');
        })
    })


});