$(document).ready(function(){
    var tabela = $('#tabelaViatura').DataTable();
    tabela.on('click','.btnEditar', function(){
        $tr = $(this).closest('tr');
        if($($tr).hasClass('child')){
            $tr = $tr.prev('.parent')
        }

        var dados = tabela.row($tr).data();
        console.log(dados);

        $('#modelo').val(dados[1]);
        $('#tipo').val(dados[2]);
        $('#cor').val(dados[3]);
        $('#categoria').val(dados[4]);
        $('#formUpdViatura').attr('action', '/editViatura/'+dados[0])
        $('#edit').modal('show');
    })

    /*$('#formAddCliente').on('submit', function(e){
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: "/clienteAdd",
            data: $('#formAddCliente').serialize(),
            success: function(response){
                console.log(response)
                $('#cadCliente').modal('hide')
                alert("Cliente cadastrado com sucesso")
            },
            error: function(error){
                console.log(error)
                alert("Cliente não cadatrado, algo correu mal.");
            }
        })
    })*/


    //----------------------------Eliminar---------------------------------
    tabela.on('click','.btnEliminar', function(){
        $tr = $(this).closest('tr');
        if($($tr).hasClass('child')){
            $tr = $tr.prev('.parent')
        }

        var dados = tabela.row($tr).data();
        console.log(dados);

        $('#formDelViatura').attr('action', '/delViatura/'+dados[0])
        $('#deletar').modal('show');
    })

});

