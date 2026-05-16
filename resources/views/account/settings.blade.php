@php
    $profileUser = $profileUser ?? auth()->user();
    $profilePhotoPath = data_get($profileUser, 'photo');
    $profilePhoto = $profilePhotoPath
        ? route('account.photo')
        : asset('assets/media/avatars/300-1.jpg');
@endphp

<!--begin::Modal - Editar perfil-->
<div class="modal fade" id="modal_editar" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <form id="account_edit_form" class="form" action="{{ route('account.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="modal-header">
                    <h2>Editar perfil</h2>
                    <button type="button" class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal" aria-label="Fechar">
                        <span class="svg-icon svg-icon-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black" />
                                <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black" />
                            </svg>
                        </span>
                    </button>
                </div>

                <div class="modal-body py-8 px-8">
                    <div class="row mb-8">
                        <label class="col-lg-4 col-form-label fw-semibold fs-6">Foto do perfil</label>
                        <div class="col-lg-8">
                            <div class="d-flex align-items-center gap-6">
                                <div class="symbol symbol-125px flex-shrink-0">
                                    <img src="{{ $profilePhoto }}" alt="Foto do perfil" />
                                </div>
                                <div class="flex-grow-1">
                                <input type="file" name="photo" class="form-control form-control-solid @error('photo') is-invalid @enderror" accept=".png,.jpg,.jpeg,.gif" />
                                <div class="form-text">Formatos aceitos: PNG, JPG, JPEG ou GIF. Tamanho maximo: 10 MB.</div>
                                @error('photo')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-6">
                        <label class="col-lg-4 col-form-label required fw-semibold fs-6">Nome completo</label>
                        <div class="col-lg-8">
                            <input type="text" name="name" class="form-control form-control-lg form-control-solid @error('name') is-invalid @enderror" placeholder="Digite seu nome completo" value="{{ old('name', data_get($profileUser, 'name')) }}" required />
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-6">
                        <label class="col-lg-4 col-form-label required fw-semibold fs-6">CPF</label>
                        <div class="col-lg-8">
                            <input type="text" name="cpf" class="form-control form-control-lg form-control-solid @error('cpf') is-invalid @enderror" placeholder="Somente numeros" value="{{ old('cpf', data_get($profileUser, 'cpf')) }}" maxlength="14" required />
                            @error('cpf')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-6">
                        <label class="col-lg-4 col-form-label required fw-semibold fs-6">E-mail</label>
                        <div class="col-lg-8">
                            <input type="email" name="email" class="form-control form-control-lg form-control-solid @error('email') is-invalid @enderror" placeholder="Digite seu e-mail" value="{{ old('email', data_get($profileUser, 'email')) }}" required />
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-6">
                        <label class="col-lg-4 col-form-label fw-semibold fs-6">Telefone</label>
                        <div class="col-lg-8">
                            <input type="tel" name="phone" id="profile_phone" class="form-control form-control-lg form-control-solid @error('phone') is-invalid @enderror" placeholder="(00) 00000-0000" value="{{ old('phone', data_get($profileUser, 'phone')) }}" maxlength="15" inputmode="numeric" autocomplete="tel" />
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" id="account_edit_submit" class="btn btn-primary" onclick="executarModalEditar()">Salvar alteracoes</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--end::Modal - Editar perfil-->

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var phoneInput = document.getElementById('profile_phone');

        if (! phoneInput) {
            return;
        }

        var formatPhone = function (value) {
            var digits = value.replace(/\D/g, '').slice(0, 11);

            if (digits.length <= 2) {
                return digits;
            }

            if (digits.length <= 6) {
                return '(' + digits.slice(0, 2) + ') ' + digits.slice(2);
            }

            if (digits.length <= 10) {
                return '(' + digits.slice(0, 2) + ') ' + digits.slice(2, 6) + '-' + digits.slice(6);
            }

            return '(' + digits.slice(0, 2) + ') ' + digits.slice(2, 7) + '-' + digits.slice(7);
        };

        phoneInput.value = formatPhone(phoneInput.value);

        phoneInput.addEventListener('input', function () {
            phoneInput.value = formatPhone(phoneInput.value);
        });
    });

    function executarModalEditar() {
        var form = document.getElementById('account_edit_form');
        var button = document.getElementById('account_edit_submit');

        if (! form) {
            return;
        }

        var formData = new FormData(form);

        if (button) {
            button.disabled = true;
            button.setAttribute('data-original-text', button.innerHTML);
            button.innerHTML = 'Salvando...';
        }

        fetch(form.action, {
            method: 'POST',
            body: formData,
            headers: {
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
            .then(function (response) {
                return response.json().then(function (data) {
                    return {
                        ok: response.ok,
                        status: response.status,
                        data: data
                    };
                });
            })
            .then(function (result) {
                if (! result.ok) {
                    var message = 'Confira os campos e tente novamente.';

                    if (result.status === 422 && result.data.errors) {
                        message = Object.values(result.data.errors).flat().join('\n');
                    } else if (result.data.message) {
                        message = result.data.message;
                    }

                    if (window.Swal) {
                        Swal.fire({ icon: 'error', title: 'Ops...', text: message });
                    } else {
                        alert(message);
                    }

                    return;
                }

                if (window.Swal) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Sucesso!',
                        text: result.data.message || 'Perfil atualizado com sucesso.'
                    }).then(function () {
                        window.location.reload();
                    });
                } else {
                    window.location.reload();
                }
            })
            .catch(function () {
                var message = 'Nao foi possivel salvar as alteracoes. Tente novamente.';

                if (window.Swal) {
                    Swal.fire({ icon: 'error', title: 'Ops...', text: message });
                } else {
                    alert(message);
                }
            })
            .finally(function () {
                if (button) {
                    button.disabled = false;
                    button.innerHTML = button.getAttribute('data-original-text') || 'Salvar alteracoes';
                }
            });
    }
</script>
