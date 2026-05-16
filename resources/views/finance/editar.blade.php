<div class="modal fade" id="modal_editar_financeiro" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <form method="POST" id="form_editar_financeiro">
                @csrf
                @method('PUT')
                <input type="hidden" name="mes" id="editar_mes" value="{{ $financeMonth }}" />
                <input type="hidden" name="ano" id="editar_ano" value="{{ $financeYear }}" />

                <div class="modal-header">
                    <h2 class="fw-bold">Editar lançamento</h2>
                    <button type="button" class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal" aria-label="Fechar">
                        <span class="svg-icon svg-icon-1">x</span>
                    </button>
                </div>

                <div class="modal-body py-10 px-lg-12">
                    <div class="row g-6">
                        <div class="col-md-8">
                            <label class="required form-label">Título</label>
                            <input type="text" name="titulo" id="editar_titulo" class="form-control form-control-solid" required />
                        </div>

                        <div class="col-md-4">
                            <label class="required form-label">Tipo</label>
                            <select name="tipo" id="editar_tipo" class="form-select form-select-solid" required>
                                <option value="receita">Receita</option>
                                <option value="despesa">Despesa</option>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label class="required form-label">Valor</label>
                            <input type="text" name="valor" id="editar_valor" class="form-control form-control-solid" placeholder="0,00" required />
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Categoria</label>
                            <select name="categoria_id" id="editar_categoria_id" class="form-select form-select-solid">
                                <option value="">Selecione</option>
                                @foreach ($financeCategories as $category)
                                    <option value="{{ $category->id }}">{{ $category->nome }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label class="required form-label">Status</label>
                            <select name="status" id="editar_status" class="form-select form-select-solid" required>
                                <option value="pendente">Pendente</option>
                                <option value="pago">Pago</option>
                                <option value="cancelado">Cancelado</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Data de vencimento</label>
                            <input type="date" name="data_vencimento" id="editar_data_vencimento" class="form-control form-control-solid" />
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Data de pagamento</label>
                            <input type="date" name="data_pagamento" id="editar_data_pagamento" class="form-control form-control-solid" />
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Forma de pagamento</label>
                            <input type="text" name="forma_pagamento" id="editar_forma_pagamento" class="form-control form-control-solid" />
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Descrição</label>
                            <input type="text" name="descricao" id="editar_descricao" class="form-control form-control-solid" />
                        </div>

                        <div class="col-12">
                            <label class="form-label">Observações</label>
                            <textarea name="observacoes" id="editar_observacoes" class="form-control form-control-solid" rows="3"></textarea>
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
