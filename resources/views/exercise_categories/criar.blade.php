<div class="modal fade" id="modal_cadastro" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Adicionar categoria de exercício</h2>
                <button type="button" class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">x</button>
            </div>
            <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                <form id="form_cadastro" class="form" enctype="multipart/form-data">
                    @csrf
                    <div class="d-flex flex-column mb-7 fv-row">
                        <label class="fs-6 fw-bold form-label mb-2"><span class="required">Grupo muscular</span></label>
                        <select class="form-select form-select-solid" id="muscle_group_id" name="muscle_group_id">
                            <option value="">Selecione</option>
                            @foreach ($muscleGroups as $muscleGroup)
                                <option value="{{ $muscleGroup->id }}">{{ $muscleGroup->nome }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="d-flex flex-column mb-7 fv-row">
                        <label class="fs-6 fw-bold form-label mb-2"><span class="required">Nome</span></label>
                        <input type="text" class="form-control form-control-solid" id="nome" name="nome">
                    </div>
                    <div class="d-flex flex-column mb-7 fv-row">
                        <label class="fs-6 fw-bold form-label mb-2">Descrição</label>
                        <textarea class="form-control form-control-solid" id="descricao" name="descricao" rows="3"></textarea>
                    </div>
                    <div class="d-flex flex-column mb-7 fv-row">
                        <label class="fs-6 fw-bold form-label mb-2">Imagem</label>
                        <input type="file" class="form-control form-control-solid" id="imagem" name="imagem" accept="image/*">
                    </div>
                    <div class="text-center pt-10">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-primary" onclick="executarModalCriar()">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
