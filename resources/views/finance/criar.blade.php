<div class="modal fade" id="modal_adicionar_financeiro" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <form method="POST" action="{{ route('finance.store') }}">
                @csrf
                <input type="hidden" name="mes" value="{{ $financeMonth }}" />
                <input type="hidden" name="ano" value="{{ $financeYear }}" />

                <div class="modal-header">
                    <h2 class="fw-bold">Adicionar lançamento</h2>
                    <button type="button" class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal" aria-label="Fechar">
                        <span class="svg-icon svg-icon-1">x</span>
                    </button>
                </div>

                <div class="modal-body py-10 px-lg-12">
                    @if ($errors->any())
                        <div class="alert alert-danger mb-8">
                            Verifique os campos e tente novamente.
                        </div>
                    @endif

                    <div class="row g-6">
                        <div class="col-md-8">
                            <label class="required form-label">Título</label>
                            <input type="text" name="titulo" class="form-control form-control-solid @error('titulo') is-invalid @enderror" value="{{ old('titulo') }}" required />
                            @error('titulo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label class="required form-label">Tipo</label>
                            <select name="tipo" class="form-select form-select-solid @error('tipo') is-invalid @enderror" required>
                                <option value="receita" @selected(old('tipo') === 'receita')>Receita</option>
                                <option value="despesa" @selected(old('tipo', 'despesa') === 'despesa')>Despesa</option>
                            </select>
                            @error('tipo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label class="required form-label">Valor</label>
                            <input type="text" name="valor" class="form-control form-control-solid @error('valor') is-invalid @enderror" value="{{ old('valor') }}" placeholder="0,00" required />
                            @error('valor')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Categoria</label>
                            <select name="categoria_id" class="form-select form-select-solid @error('categoria_id') is-invalid @enderror">
                                <option value="">Selecione</option>
                                @foreach ($financeCategories as $category)
                                    <option value="{{ $category->id }}" @selected((int) old('categoria_id') === $category->id)>{{ $category->nome }}</option>
                                @endforeach
                            </select>
                            @error('categoria_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label class="required form-label">Status</label>
                            <select name="status" class="form-select form-select-solid @error('status') is-invalid @enderror" required>
                                <option value="pendente" @selected(old('status', 'pendente') === 'pendente')>Pendente</option>
                                <option value="pago" @selected(old('status') === 'pago')>Pago</option>
                                <option value="cancelado" @selected(old('status') === 'cancelado')>Cancelado</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Data de vencimento</label>
                            <input type="date" name="data_vencimento" class="form-control form-control-solid @error('data_vencimento') is-invalid @enderror" value="{{ old('data_vencimento') }}" />
                            @error('data_vencimento')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Data de pagamento</label>
                            <input type="date" name="data_pagamento" class="form-control form-control-solid @error('data_pagamento') is-invalid @enderror" value="{{ old('data_pagamento') }}" />
                            @error('data_pagamento')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Forma de pagamento</label>
                            <input type="text" name="forma_pagamento" class="form-control form-control-solid @error('forma_pagamento') is-invalid @enderror" value="{{ old('forma_pagamento') }}" />
                            @error('forma_pagamento')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Recorrência</label>
                            <div class="form-control form-control-solid d-flex align-items-center min-h-44px">
                                <input type="hidden" name="recorrente" value="0" />
                                <div class="form-check form-switch form-check-custom form-check-solid m-0">
                                    <input class="form-check-input" type="checkbox" name="recorrente" value="1" id="recorrente_adicionar" @checked(old('recorrente')) />
                                    <label class="form-check-label" for="recorrente_adicionar">
                                        Repetir mensalmente
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 finance-recorrencia-opcao d-none">
                            <label class="form-label">Tipo de valor</label>
                            <select name="recorrencia_valor_tipo" class="form-select form-select-solid @error('recorrencia_valor_tipo') is-invalid @enderror">
                                <option value="fixo" @selected(old('recorrencia_valor_tipo', 'fixo') === 'fixo')>Fixo</option>
                                <option value="variavel" @selected(old('recorrencia_valor_tipo') === 'variavel')>Variável / estimado</option>
                            </select>
                            @error('recorrencia_valor_tipo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 finance-recorrencia-opcao d-none">
                            <label class="form-label">Repetir por</label>
                            <div class="input-group input-group-solid">
                                <input type="number" name="recorrencia_quantidade" class="form-control @error('recorrencia_quantidade') is-invalid @enderror" value="{{ old('recorrencia_quantidade', 12) }}" min="1" max="60" />
                                <span class="input-group-text">meses</span>
                            </div>
                            @error('recorrencia_quantidade')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Descrição</label>
                            <input type="text" name="descricao" class="form-control form-control-solid @error('descricao') is-invalid @enderror" value="{{ old('descricao') }}" />
                            @error('descricao')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12">
                            <label class="form-label">Observações</label>
                            <textarea name="observacoes" class="form-control form-control-solid @error('observacoes') is-invalid @enderror" rows="3">{{ old('observacoes') }}</textarea>
                            @error('observacoes')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success">Adicionar lançamento</button>
                </div>
            </form>
        </div>
    </div>
</div>

