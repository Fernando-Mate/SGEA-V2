$(document).ready(function(){
    var tabela = $('#tabelaCliente').DataTable();
    tabela.on('click','.btnEditar', function(){
        $tr = $(this).closest('tr');
        if($($tr).hasClass('child')){
            $tr = $tr.prev('.parent')
        }

        var dados = tabela.row($tr).data();
        console.log(dados);

        $('#txtNome').val(dados[1]);
        $('#txtApelido').val(dados[2]);
        $('#txtEmail').val(dados[4]);
        $('#jcGenero').val(dados[3]);
        $('#txtSaldo').val(dados[5]);
        $('#formUpdCliente').attr('action', '/editCliente/'+dados[0])
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

        $('#formDelCliente').attr('action', '/delCliente/'+dados[0])
        $('#deletar').modal('show');
    })

});

