"use strict";

var KTSignupGeneral = function () {
    var form;
    var cpfInput;
    var submitButton;

    return {
        init: function () {
            form = document.querySelector("#kt_sign_up_form");
            cpfInput = form ? form.querySelector('[name="cpf"]') : null;
            submitButton = document.querySelector("#kt_sign_up_submit");

            if (!form || !submitButton) {
                return;
            }

            if (cpfInput) {
                cpfInput.addEventListener("input", function () {
                    var value = cpfInput.value.replace(/\D/g, "").slice(0, 11);

                    value = value.replace(/(\d{3})(\d)/, "$1.$2");
                    value = value.replace(/(\d{3})(\d)/, "$1.$2");
                    value = value.replace(/(\d{3})(\d{1,2})$/, "$1-$2");

                    cpfInput.value = value;
                });
            }

            form.addEventListener("submit", function () {
                submitButton.setAttribute("data-kt-indicator", "on");
                submitButton.disabled = true;
            });
        }
    };
}();

KTUtil.onDOMContentLoaded(function () {
    KTSignupGeneral.init();
});
