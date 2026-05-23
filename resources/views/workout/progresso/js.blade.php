<script>
    function executarModalCriarTreinoProgresso()
        {
            var headers = {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            
            var user_id           = $("#user_id").val(); 
            var data_registro     = $("#data_registro").val();
            var idade             = $("#idade").val();
            var peso              = $("#peso").val();
            var altura            = normalizarDecimalProgresso($("#altura").val());
            var meta_kcal         = $("#meta_kcal").val();
            var meta_necessaria   = $("#meta_necessaria").val();
            var carboidrato       = $("#carboidrato").val();
            var proteina          = $("#proteina").val();
            var gordura           = $("#gordura").val();

            if(data_registro == ''){
                Swal.fire({ icon: 'error', title: 'Oops...', text: 'Preencha o campo Data'});
                return false;
            }

            $.ajax({
                url: "{{ route('treino.progresso.store') }}",
                type: "POST",
                data: "user_id=" + user_id + "&data_registro=" + data_registro + "&idade=" + idade + "&peso=" + peso + "&altura=" + altura + "&meta_kcal=" + meta_kcal + "&meta_necessaria=" + meta_necessaria + "&carboidrato=" + carboidrato + "&proteina=" + proteina + "&gordura=" + gordura,
                headers: headers,
                error: function(data) {

                    if(data.status === 422) {
                        var message = '';
                        $.each(data.responseJSON.errors, function(campo, conteudo) {
                            message = message.concat(conteudo);
                        });
                        Swal.fire({ icon: 'error', title: 'Oops...', text: message });
                    }

                },
                success: function(data) {

                    $('#modal_cadastro').modal('toggle');

                    var message = '';
                    var success = '';
                    var id = '';

                    $.each(data, function(campo, conteudo) {
                        if(campo == 'success'){
                            success = conteudo;
                        }
                        if(campo == 'message'){
                            message = conteudo;
                        }
                        if(campo == 'id'){
                            id = conteudo;
                        }
                    });

                    if(success == true){

                        Swal.fire({ icon: 'success', title: 'Sucesso!', text: message });
                        window.location.reload();

                    }else{
                        Swal.fire({ icon: 'error', title: 'Oops...', text: message });
                    }
                }
            });
        }

    function normalizarDecimalProgresso(value)
        {
            return String(value || '').trim().replace(',', '.');
        }

    function excluirTreinoProgresso(id)
        {
            var headers = {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }

            Swal.fire({
            title: 'Tem certeza que deseja excluir?',
            text: "Não será possível reverter essa ação.",
            icon: 'warning',
            showCancelButton: true,
            cancelButtonText: 'Cancelar',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sim, excluir!'
            }).then((result) => {

                if(typeof(result.value) != "undefined" && result.value == true){ // Se foi apertado o botão de "Sim, excluir"

                    $.ajax({
                        url: "{{ route('treino.progresso.destroy', '') }}/"+id,
                        type: "DELETE",
                        headers: headers,
                        success: function(data) {

                            var message = '';
                            var success = '';

                            $.each(data, function(campo, conteudo) {
                                if(campo == 'success'){
                                    success = conteudo;
                                }
                                if(campo == 'message'){
                                    message = conteudo;
                                }
                            });

                            if(success == true){
                                Swal.fire({ icon: 'success', title: 'Sucesso!', text: message });
                                window.location.reload();
                            }else{
                                Swal.fire({ icon: 'error', title: 'Oops...', text: message });
                            }
                        }
                    });
                }
            })
        }

    function abrirModalEditarTreinoProgresso(data)
        {
            $("#id_edit").val(valorProgresso(data.id));
            $("#user_id_edit").val(valorProgresso(data.user_id) || $("#user_id_edit").val());
            $("#data_registro_edit").val(formatarDataProgresso(data.data_registro));
            $("#idade_edit").val(valorProgresso(data.idade));
            $("#peso_edit").val(valorProgresso(data.peso));
            $("#altura_edit").val(valorProgresso(data.altura));
            $("#meta_kcal_edit").val(valorProgresso(data.meta_kcal));
            $("#meta_necessaria_edit").val(valorProgresso(data.meta_necessaria));
            $("#carboidrato_edit").val(valorProgresso(data.carboidrato));
            $("#proteina_edit").val(valorProgresso(data.proteina));
            $("#gordura_edit").val(valorProgresso(data.gordura));

            mostrarModalProgresso('modal_editar_progresso');
        }

    function valorProgresso(value)
        {
            return value === null || typeof value === 'undefined' ? '' : value;
        }

    function formatarDataProgresso(value)
        {
            if (!value) {
                return '';
            }

            return String(value).split('T')[0].split(' ')[0];
        }

    function mostrarModalProgresso(id)
        {
            var modalElement = document.getElementById(id);

            if (!modalElement) {
                return;
            }

            if (window.bootstrap) {
                bootstrap.Modal.getOrCreateInstance(modalElement).show();
                return;
            }

            $("#" + id).modal('show');
        }

    function esconderModalProgresso(id)
        {
            var modalElement = document.getElementById(id);

            if (!modalElement) {
                return;
            }

            if (window.bootstrap) {
                bootstrap.Modal.getOrCreateInstance(modalElement).hide();
                return;
            }

            $("#" + id).modal('hide');
        }

    function executarModalEditarTreinoProgresso()
        {

            var headers = {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }

            var id               = $("#id_edit").val();
            var user_id          = $("#user_id_edit").val();
            var data_registro    = $("#data_registro_edit").val();
            var idade            = $("#idade_edit").val();
            var peso             = $("#peso_edit").val();
            var altura           = $("#altura_edit").val();
            var meta_kcal        = $("#meta_kcal_edit").val();
            var meta_necessaria  = $("#meta_necessaria_edit").val();
            var carboidrato      = $("#carboidrato_edit").val();
            var proteina         = $("#proteina_edit").val();
            var gordura          = $("#gordura_edit").val();

            if(data_registro == ''){
                Swal.fire({ icon: 'error', title: 'Oops...', text: 'Preencha o campo Data'});
                return false;
            }

            $.ajax({
                url: "{{ route('treino.progresso.update', '') }}/"+id,
                type: "PUT",
                data: {
                    user_id: user_id,
                    data_registro: data_registro,
                    idade: idade,
                    peso: peso,
                    altura: altura,
                    meta_kcal: meta_kcal,
                    meta_necessaria: meta_necessaria,
                    carboidrato: carboidrato,
                    proteina: proteina,
                    gordura: gordura
                },
                headers: headers,
                error: function(data) {

                    if(data.status === 422) {
                        var message = '';
                        $.each(data.responseJSON.errors, function(campo, conteudo) {
                            message = message.concat(conteudo);
                        });
                        Swal.fire({ icon: 'error', title: 'Oops...', text: message });
                    }

                },
                success: function(data) {
                    esconderModalProgresso('modal_editar_progresso');

                    var message = '';
                    var success = '';

                    $.each(data, function(campo, conteudo) {
                        if(campo == 'success'){
                            success = conteudo;
                        }
                        if(campo == 'message'){
                            message = conteudo;
                        }
                    });

                    if(success == true){
                        Swal.fire({ icon: 'success', title: 'Sucesso!', text: message });
                        window.location.reload();
                    }else{
                        Swal.fire({ icon: 'error', title: 'Oops...', text: message });
                    }

                }
            });
        }

</script>
