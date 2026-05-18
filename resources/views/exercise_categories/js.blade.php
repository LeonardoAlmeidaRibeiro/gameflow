<script>
    $("#tabela").DataTable({
        language: {
            lengthMenu: "Mostrar _MENU_ registros",
        },
        dom:
            "<'row'" +
            "<'col-sm-6 d-flex align-items-center justify-conten-start'l>" +
            "<'col-sm-6 d-flex align-items-center justify-content-end'f>" +
            ">" +
            "<'table-responsive'tr>" +
            "<'row'" +
            "<'col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start'i>" +
            "<'col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end'p>" +
            ">"
    });

    function csrfHeaders() {
        return {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        };
    }

    function showError(message) {
        Swal.fire({ icon: 'error', title: 'Oops...', text: message });
    }

    function showSuccess(message) {
        Swal.fire({ icon: 'success', title: 'Sucesso!', text: message });
    }

    function validationMessage(response) {
        if (response && response.errors) {
            return Object.values(response.errors).flat().join(' ');
        }

        return response && response.message ? response.message : 'Não foi possível concluir a operação.';
    }

    function imageCell(record) {
        if (!record.imagem_url) {
            return '<span class="badge badge-light">Sem imagem</span>';
        }

        return '<img src="' + record.imagem_url + '" class="rounded" width="46" height="46" style="object-fit: cover;" alt="' + record.nome + '">';
    }

    function rowHtml(record) {
        return '<tr id="tr_' + record.id + '">' +
            '<td id="celula_imagem_' + record.id + '">' + imageCell(record) + '</td>' +
            '<td id="celula_nome_' + record.id + '" class="fw-bold text-dark">' + record.nome + '</td>' +
            '<td id="celula_grupo_' + record.id + '">' + record.muscle_group_nome + '</td>' +
            '<td id="celula_descricao_' + record.id + '">' + (record.descricao || '-') + '</td>' +
            '<td class="text-end">' +
            '<button type="button" class="btn btn-sm btn-light-primary me-2" onclick="abrirModalEditar(' + record.id + ')" data-bs-toggle="modal" data-bs-target="#modal_editar">Editar</button>' +
            '<button type="button" class="btn btn-sm btn-light-danger" onclick="excluir(' + record.id + ')">Excluir</button>' +
            '</td>' +
            '<input type="hidden" id="celula_muscle_group_id_' + record.id + '" value="' + record.muscle_group_id + '">' +
            '<input type="hidden" id="celula_imagem_url_' + record.id + '" value="' + (record.imagem_url || '') + '">' +
            '</tr>';
    }

    function abrirModalEditar(id) {
        $("#id_edit").val(id);
        $("#nome_edit").val($("#celula_nome_" + id).text());
        $("#descricao_edit").val($("#celula_descricao_" + id).text() === '-' ? '' : $("#celula_descricao_" + id).text());
        $("#muscle_group_id_edit").val($("#celula_muscle_group_id_" + id).val());
        $("#imagem_edit").val('');
    }

    function buildFormData(formId) {
        return new FormData(document.getElementById(formId));
    }

    function executarModalCriar() {
        if ($("#muscle_group_id").val() === '') {
            showError('Selecione o grupo muscular.');
            return false;
        }

        if ($("#nome").val().trim() === '') {
            showError('Preencha o campo Nome.');
            return false;
        }

        $.ajax({
            url: "{{ route('exercise_categories.store') }}",
            type: "POST",
            data: buildFormData('form_cadastro'),
            headers: csrfHeaders(),
            processData: false,
            contentType: false,
            error: function(data) {
                showError(validationMessage(data.responseJSON));
            },
            success: function(data) {
                $('#modal_cadastro').modal('toggle');

                if (data.success === true) {
                    $("#form_cadastro")[0].reset();
                    $("#tabela tbody").prepend(rowHtml(data.record));
                    showSuccess(data.message);
                } else {
                    showError(data.message);
                }
            }
        });
    }

    function executarModalEditar() {
        var id = $("#id_edit").val();

        if ($("#muscle_group_id_edit").val() === '') {
            showError('Selecione o grupo muscular.');
            return false;
        }

        if ($("#nome_edit").val().trim() === '') {
            showError('Preencha o campo Nome.');
            return false;
        }

        var formData = buildFormData('form_editar');
        formData.append('_method', 'PUT');

        $.ajax({
            url: "{{ route('exercise_categories.update', '') }}/" + id,
            type: "POST",
            data: formData,
            headers: csrfHeaders(),
            processData: false,
            contentType: false,
            error: function(data) {
                showError(validationMessage(data.responseJSON));
            },
            success: function(data) {
                $('#modal_editar').modal('toggle');

                if (data.success === true) {
                    $("#tr_" + id).replaceWith(rowHtml(data.record));
                    showSuccess(data.message);
                } else {
                    showError(data.message);
                }
            }
        });
    }

    function excluir(id) {
        Swal.fire({
            title: 'Tem certeza que deseja excluir?',
            text: 'Não será possível reverter essa ação.',
            icon: 'warning',
            showCancelButton: true,
            cancelButtonText: 'Cancelar',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sim, excluir!'
        }).then((result) => {
            if (result.isConfirmed || result.value === true) {
                $.ajax({
                    url: "{{ route('exercise_categories.destroy', '') }}/" + id,
                    type: "DELETE",
                    headers: csrfHeaders(),
                    error: function(data) {
                        showError(validationMessage(data.responseJSON));
                    },
                    success: function(data) {
                        if (data.success === true) {
                            $('#tr_' + id).remove();
                            showSuccess(data.message);
                        } else {
                            showError(data.message);
                        }
                    }
                });
            }
        });
    }
</script>
