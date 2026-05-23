<!--begin::Modal - Progresso-->
<div class="modal fade" id="modal_editar_progresso" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header">
                <!--begin::Modal title-->
                <h2>Editar Progresso</h2>
                <!--end::Modal title-->
                <!--begin::Close-->
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                    <span class="svg-icon svg-icon-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black" />
                            <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black" />
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                </div>
                <!--end::Close-->
            </div>
            <!--end::Modal header-->

            <!--begin::Modal body-->
            <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                <!--begin::Form-->
                <form class="form" method="post" action="#">
                    @csrf
                    <!--begin::Input group-->
                    <div class="row g-5">
                        <div class="col-md-6">
                            <input type="hidden" id="id_edit" name="id_edit" value="">
                        </div>
                         <div class="col-md-6">
                            <input type="hidden" id="user_id_edit" name="user_id_edit" value="{{ auth()->id() }}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label required">Data</label>
                            <input type="date" id="data_registro_edit" name="data_registro_edit" class="form-control" data-label="Data">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Idade</label>
                            <input type="number" id="idade_edit" name="idade_edit" class="form-control" min="1">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Peso</label>
                            <input type="number" id="peso_edit" name="peso_edit" class="form-control" min="1" step="0.01">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Altura</label>
                            <input type="number" id="altura_edit" name="altura_edit" class="form-control" min="0.5" step="0.01">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Meta kcal</label>
                            <input type="number" id="meta_kcal_edit" name="meta_kcal_edit" class="form-control" min="1">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Meta necessária</label>
                            <input type="number" id="meta_necessaria_edit" name="meta_necessaria_edit" class="form-control" min="1">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Carboidrato</label>
                            <input type="number" id="carboidrato_edit" name="carboidrato_edit" class="form-control" min="0" step="0.01">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Proteína</label>
                            <input type="number" id="proteina_edit" name="proteina_edit" class="form-control" min="0" step="0.01">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Gordura</label>
                            <input type="number" id="gordura_edit"   name="gordura_edit" class="form-control" min="0" step="0.01">
                        </div>
                    </div>

                    <!--begin::Actions-->
                    <div class="text-center pt-15">
                        <button type="button" id="cancelar" class="btn btn-danger" data-bs-dismiss="modal">
                            <!--begin::Svg Icon | path: assets/media/icons/duotune/general/gen040.svg-->
                            <span class="svg-icon svg-icon-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="black" />
                                    <rect x="7" y="15.3137" width="12" height="2" rx="1" transform="rotate(-45 7 15.3137)" fill="black" />
                                    <rect x="8.41422" y="7" width="12" height="2" rx="1" transform="rotate(45 8.41422 7)" fill="black" />
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                            Cancelar
                        </button>
                        <button type="button" id="salvar" class="btn btn-primary" onClick="executarModalEditarTreinoProgresso()">
                            <!--begin::Svg Icon | path: assets/media/icons/duotune/general/gen043.svg-->
                            <span class="svg-icon svg-icon-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="black" />
                                    <path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="black" />
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                            Salvar
                        </button>
                    </div>
                    <!--end::Actions-->
                </form>
                <!--end::Form-->
            </div>
            <!--end::Modal body-->
        </div>
        <!--end::Modal content-->
    </div>
    <!--end::Modal dialog-->
</div>
<!--end::Modal - Progresso-->
