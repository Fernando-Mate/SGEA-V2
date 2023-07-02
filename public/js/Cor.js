$(document).ready(function(){
    var tabela = $('#tabelaCor').DataTable();
    tabela.on('click','.btnEditar', function(){
        $tr = $(this).closest('tr');
        if($($tr).hasClass('child')){
            $tr = $tr.prev('.parent')
        }

        var dados = tabela.row($tr).data();
        console.log(dados);

        $('#txtNome').val(dados[1]);
        $('#txtDescricao').val(dados[2]);
        $('#formUpdCor').attr('action', '/editCor/'+dados[0])
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

        $('#formDelCor').attr('action', '/delCor/'+dados[0])
        $('#deletar').modal('show');
    })

});

