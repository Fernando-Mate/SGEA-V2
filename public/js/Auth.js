$(function(){
    $('#formLogin').submit(function(e){
        e.preventDefault();
        $.ajax({
            url: "/login",
            type: "POST",
            data: $(this).serialize(),
            dataType: 'json',
            success: function(response){
                if(response.success === true ){
                    window.location.href = "/admin"
                } else{
                    $('.messageBox').removeClass('d-none').html(response.message)
                }
                console.log(response)
            }
        })
    })

})

$('#confirmarPass').on('change',function(){
    var pass = $('#tPassword').val();
    var confirm = $('#confirmarPass').val();

    if(pass == confirm){
      $('#inscrever').removeAttr('disabled')
      $('.messageBox').addClass('d-none').html("Esta palavra passe não corresponde a anterior")
    }
    else{
      $('.messageBox').removeClass('d-none').html("Esta palavra passe não corresponde a anterior")
    }
})
