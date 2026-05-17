<div class="modal fade" id="modal_adicionar_forma_pagamento" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <form method="POST" action="{{ route('finance.payment-methods.store') }}" id="form_adicionar_forma_pagamento" data-payment-method-form novalidate>
                @csrf

                <div class="modal-header">
                    <h2 class="fw-bold">Adicionar forma de pagamento</h2>
                    <button type="button" class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal" aria-label="Fechar">
                        <span class="svg-icon svg-icon-1">x</span>
                    </button>
                </div>

                <div class="modal-body py-10 px-lg-12">
                    <div class="row g-6">
                        <div class="col-md-6">
                            <label class="required form-label">Nome</label>
                            <input type="text" name="nome" class="form-control form-control-solid @error('nome', 'paymentMethod') is-invalid @enderror" value="{{ old('nome') }}" placeholder="Nubank, Itaú, PicPay..." required />
                            @error('nome', 'paymentMethod')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="required form-label">Tipo</label>
                            <select name="tipo" class="form-select form-select-solid @error('tipo', 'paymentMethod') is-invalid @enderror" required>
                                <option value="">Selecione</option>
                                <option value="credito" @selected(old('tipo') === 'credito')>Cartão de crédito</option>
                                <option value="debito" @selected(old('tipo') === 'debito')>Cartão de débito</option>
                                <option value="carteira_digital" @selected(old('tipo') === 'carteira_digital')>Carteira digital</option>
                                <option value="dinheiro" @selected(old('tipo') === 'dinheiro')>Dinheiro</option>
                            </select>
                            @error('tipo', 'paymentMethod')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Bandeira</label>
                            <input type="text" name="bandeira" class="form-control form-control-solid @error('bandeira', 'paymentMethod') is-invalid @enderror" value="{{ old('bandeira') }}" placeholder="Visa, Mastercard, Elo..." />
                            @error('bandeira', 'paymentMethod')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Últimos dígitos</label>
                            <input type="text" name="ultimos_digitos" class="form-control form-control-solid @error('ultimos_digitos', 'paymentMethod') is-invalid @enderror" value="{{ old('ultimos_digitos') }}" maxlength="4" inputmode="numeric" />
                            @error('ultimos_digitos', 'paymentMethod')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Status</label>
                            <div class="form-control form-control-solid d-flex align-items-center min-h-44px">
                                <input type="hidden" name="ativo" value="0" />
                                <div class="form-check form-switch form-check-custom form-check-solid m-0">
                                    <input class="form-check-input" type="checkbox" name="ativo" value="1" id="forma_pagamento_ativo" @checked(old('ativo', '1') === '1') />
                                    <label class="form-check-label" for="forma_pagamento_ativo">Ativo</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Cadastrar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_editar_forma_pagamento" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <form method="POST" id="form_editar_forma_pagamento" data-payment-method-form novalidate>
                @csrf
                @method('PUT')

                <div class="modal-header">
                    <h2 class="fw-bold">Editar forma de pagamento</h2>
                    <button type="button" class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal" aria-label="Fechar">
                        <span class="svg-icon svg-icon-1">x</span>
                    </button>
                </div>

                <div class="modal-body py-10 px-lg-12">
                    <div class="row g-6">
                        <div class="col-md-6">
                            <label class="required form-label">Nome</label>
                            <input type="text" name="nome" id="editar_forma_pagamento_nome" class="form-control form-control-solid" required />
                        </div>

                        <div class="col-md-6">
                            <label class="required form-label">Tipo</label>
                            <select name="tipo" id="editar_forma_pagamento_tipo" class="form-select form-select-solid" required>
                                <option value="">Selecione</option>
                                <option value="credito">Cartão de crédito</option>
                                <option value="debito">Cartão de débito</option>
                                <option value="carteira_digital">Carteira digital</option>
                                <option value="dinheiro">Dinheiro</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Bandeira</label>
                            <input type="text" name="bandeira" id="editar_forma_pagamento_bandeira" class="form-control form-control-solid" />
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Últimos dígitos</label>
                            <input type="text" name="ultimos_digitos" id="editar_forma_pagamento_ultimos_digitos" class="form-control form-control-solid" maxlength="4" inputmode="numeric" />
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Status</label>
                            <div class="form-control form-control-solid d-flex align-items-center min-h-44px">
                                <input type="hidden" name="ativo" value="0" />
                                <div class="form-check form-switch form-check-custom form-check-solid m-0">
                                    <input class="form-check-input" type="checkbox" name="ativo" value="1" id="editar_forma_pagamento_ativo" />
                                    <label class="form-check-label" for="editar_forma_pagamento_ativo">Ativo</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Salvar alterações</button>
                </div>
            </form>
        </div>
    </div>
</div>
