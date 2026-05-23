    <script>
        function workoutAlert(icon, title, text) {
            Swal.fire({
                icon: icon
                , title: title
                , text: text
            });
        }

        function renderWorkoutCharts() {
            if (typeof ApexCharts === 'undefined') {
                return;
            }

            var chartData = {!! $workoutChartJson !!};
            var emptyLabel = ['Sem dados'];

            var divisionElement = document.getElementById('workout_division_chart');
            if (divisionElement) {
                new ApexCharts(divisionElement, {
                    chart: {
                        type: 'bar'
                        , height: 300
                        , toolbar: {
                            show: false
                        }
                    }
                    , series: [{
                        name: 'Exercícios'
                        , data: chartData.divisionSeries.length ? chartData.divisionSeries : [0]
                    }]
                    , xaxis: {
                        categories: chartData.divisionLabels.length ? chartData.divisionLabels : emptyLabel
                        , labels: {
                            rotate: -20
                        }
                    }
                    , colors: ['#009ef7']
                    , plotOptions: {
                        bar: {
                            borderRadius: 4
                            , columnWidth: '48%'
                        }
                    }
                    , dataLabels: {
                        enabled: false
                    }
                    , yaxis: {
                        min: 0
                        , forceNiceScale: true
                    }
                }).render();
            }

            var muscleElement = document.getElementById('workout_muscle_chart');
            if (muscleElement) {
                new ApexCharts(muscleElement, {
                    chart: {
                        type: 'donut'
                        , height: 300
                    }
                    , series: chartData.muscleSeries.length ? chartData.muscleSeries : [1]
                    , labels: chartData.muscleLabels.length ? chartData.muscleLabels : emptyLabel
                    , colors: ['#50cd89', '#f1416c', '#ffc700', '#7239ea', '#009ef7', '#7e8299', '#181c32']
                    , legend: {
                        position: 'bottom'
                    }
                    , dataLabels: {
                        enabled: false
                    }
                }).render();
            }

            var progressElement = document.getElementById('workout_progress_chart');
            if (progressElement) {
                new ApexCharts(progressElement, {
                    chart: {
                        type: 'line'
                        , height: 300
                        , toolbar: {
                            show: false
                        }
                    }
                    , series: [{
                            name: 'Peso'
                            , data: chartData.weightSeries.length ? chartData.weightSeries : [0]
                        }
                        , {
                            name: 'Meta kcal'
                            , data: chartData.kcalSeries.length ? chartData.kcalSeries : [0]
                        }
                    ]
                    , xaxis: {
                        categories: chartData.progressLabels.length ? chartData.progressLabels : emptyLabel
                    }
                    , colors: ['#f1416c', '#009ef7']
                    , stroke: {
                        curve: 'smooth'
                        , width: 3
                    }
                    , markers: {
                        size: 4
                    }
                    , dataLabels: {
                        enabled: false
                    }
                    , yaxis: [{
                            title: {
                                text: 'Peso'
                            }
                            , forceNiceScale: true
                        }
                        , {
                            opposite: true
                            , title: {
                                text: 'Kcal'
                            }
                            , forceNiceScale: true
                        }
                    ]
                }).render();
            }
        }

        function setWorkoutFormValues(form, data) {
            Object.keys(data || {}).forEach(function(key) {
                var field = form.querySelector('[name="' + key + '"]');

                if (!field) {
                    return;
                }

                var value = data[key] || '';

                if (field.type === 'date' && String(value).indexOf('T') !== -1) {
                    value = String(value).split('T')[0];
                }

                field.value = value;
            });
        }

        function openWorkoutEditModal(formId, modalId, id, data) {
            var form = document.getElementById(formId);
            var modalElement = document.getElementById(modalId);

            if (!form || !modalElement) {
                return;
            }

            form.action = form.getAttribute('data-action-template').replace('__ID__', id);
            setWorkoutFormValues(form, data);

            if (window.bootstrap) {
                new bootstrap.Modal(modalElement).show();
            }
        }

        function updateExerciseCategoryPreview(select) {
            var selectedOption = select.options[select.selectedIndex];
            var form = select.closest('form');
            var preview = form ? form.querySelector('.js-exercise-category-preview') : null;
            var nameField = form ? form.querySelector('[name="nome"]') : null;
            var observationField = form ? form.querySelector('[name="observacao"]') : null;

            if (!selectedOption || !selectedOption.value || !preview) {
                if (preview) {
                    preview.classList.add('d-none');
                }

                return;
            }

            if (nameField && selectedOption.dataset.name && !String(nameField.value || '').trim()) {
                nameField.value = selectedOption.dataset.name;
            }

            if (observationField && selectedOption.dataset.description && !String(observationField.value || '').trim()) {
                observationField.value = selectedOption.dataset.description;
            }

            var image = preview.querySelector('.js-exercise-category-image');
            var name = preview.querySelector('.js-exercise-category-name');
            var group = preview.querySelector('.js-exercise-category-group');
            var description = preview.querySelector('.js-exercise-category-description');

            if (name) {
                name.textContent = selectedOption.dataset.name || '';
            }

            if (group) {
                group.textContent = selectedOption.dataset.group || '';
            }

            if (description) {
                description.textContent = selectedOption.dataset.description || '';
            }

            if (image) {
                if (selectedOption.dataset.image) {
                    image.src = selectedOption.dataset.image;
                    image.alt = selectedOption.dataset.name || '';
                    image.classList.remove('d-none');
                } else {
                    image.removeAttribute('src');
                    image.classList.add('d-none');
                }
            }

            preview.classList.remove('d-none');
        }

        document.addEventListener('DOMContentLoaded', function() {
            renderWorkoutCharts();

            document.querySelectorAll('.js-workout-form').forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    var requiredField = Array.from(form.querySelectorAll('[data-label]')).find(function(field) {
                        return String(field.value || '').trim() === '';
                    });

                    if (!requiredField) {
                        return;
                    }

                    event.preventDefault();
                    requiredField.focus();
                    workoutAlert('warning', 'Campo obrigatório', 'Preencha o campo ' + requiredField.getAttribute('data-label') + '.');
                });
            });

            document.querySelectorAll('.js-exercise-category-select').forEach(function(select) {
                select.addEventListener('change', function() {
                    updateExerciseCategoryPreview(select);
                });

                updateExerciseCategoryPreview(select);
            });

            document.querySelectorAll('.js-delete-form').forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    event.preventDefault();

                    Swal.fire({
                        title: 'Tem certeza que deseja excluir?'
                        , text: form.getAttribute('data-message') || 'Não será possível reverter essa ação.'
                        , icon: 'warning'
                        , showCancelButton: true
                        , confirmButtonColor: '#f1416c'
                        , cancelButtonColor: '#7e8299'
                        , confirmButtonText: 'Sim, excluir'
                        , cancelButtonText: 'Cancelar'
                    }).then(function(result) {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });

            document.querySelectorAll('.js-edit-workout').forEach(function(button) {
                button.addEventListener('click', function() {
                    var data = JSON.parse(button.getAttribute('data-workout'));
                    openWorkoutEditModal('form_editar_workout', 'modal_editar_workout', data.id, data);
                });
            });

            document.querySelectorAll('.js-edit-division').forEach(function(button) {
                button.addEventListener('click', function() {
                    var data = JSON.parse(button.getAttribute('data-division'));
                    openWorkoutEditModal('form_editar_division', 'modal_editar_division', data.id, data);
                });
            });

            document.querySelectorAll('.js-edit-exercise').forEach(function(button) {
                button.addEventListener('click', function() {
                    var data = JSON.parse(button.getAttribute('data-exercise'));
                    openWorkoutEditModal('form_editar_exercise', 'modal_editar_exercise', data.id, data);
                    var form = document.getElementById('form_editar_exercise');
                    var categorySelect = form ? form.querySelector('.js-exercise-category-select') : null;

                    if (categorySelect) {
                        updateExerciseCategoryPreview(categorySelect);
                    }
                });
            });

            document.querySelectorAll('.js-edit-routine').forEach(function(button) {
                button.addEventListener('click', function() {
                    var data = JSON.parse(button.getAttribute('data-routine'));
                    openWorkoutEditModal('form_editar_routine', 'modal_editar_routine', data.id, data);
                });
            });

            document.querySelectorAll('.js-edit-progress').forEach(function(button) {
                button.addEventListener('click', function(event) {
                    event.preventDefault();
                    var data = JSON.parse(button.getAttribute('data-progress'));
                    abrirModalEditarTreinoProgresso(data);
                });
            });
        });

    </script>

    @if (session('status'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            workoutAlert('success', 'Sucesso!', @json(session('status')));
        });

    </script>
    @endif

    @if (session('workout_modal') || $errors->workout->any())
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var modalElement = document.getElementById(@json(session('workout_modal', 'modal_adicionar_workout')));
            var firstError = @json($errors->workout->first());

            if (modalElement && window.bootstrap) {
                new bootstrap.Modal(modalElement).show();
            }

            workoutAlert('warning', 'Verifique os campos', firstError || 'Preencha os campos obrigatórios para continuar.');
        });

    </script>
    @endif
