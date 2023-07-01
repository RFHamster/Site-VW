//abrir modal $('#meuModal').modal();

var verificacao = true;
var selectCarro;
window.onload = function () {
    $(".cnh-inp").hide();
    $("#sim").change(function () {
        $(".cnh-inp").show();
    });
    $("#nao").change(function () {
        $(".cnh-inp").hide();
    });

    $(".carro-inp").hide();
    selectCarro = document.getElementById("tipo");
    selectCarro.addEventListener("change", function () {
        if (selectCarro.value === "troca") {
            $(".carro-inp").show();
        } else {
            $(".carro-inp").hide();
        }
    });


    $("#submit").click(function () {
        verificacao = true;
    });
    document.forms.formCompraVenda.addEventListener("submit", function (e) {
        if (verificacao) {
            e.preventDefault();
            validaForm(e);
        }
    });

    $("#clear").click(function () {
        $(document).ready(function () {
            // Recarrega a página
            location.reload();
        });
    });
};

function validaForm(e) {
    var form = e.target;
    let formValido = true;
    let mensagem = "";
    let spanText = form.nome.nextElementSibling;
    spanText.textContent = "";
    if (form.nome.value == "") {
        spanText.textContent = "Nome Vazio";
        formValido = false;
    } else {
        if (form.nome.value[0] == " ") {
            spanText.textContent = "Nome não pode começar com espaço";
            form.nome.style.border = "2px solid red";
            formValido = false;
        } else {
            let index = form.nome.value.indexOf(" ");
            if (index == -1) {
                spanText.textContent = "Escreva nome e sobrenome";
                form.nome.style.border = "2px solid red";
                formValido = false;
            } else if (form.nome.value.charAt(index + 1) == "") {
                spanText.textContent = "Escreva nome e sobrenome";
                form.nome.style.border = "2px solid red";
                formValido = false;
            }
        }
    }
    if (formValido) {
        mensagem += "Nome: " + form.nome.value + " <br>     ";
    }

    spanText = form.cpf.nextElementSibling;
    spanText.textContent = "";

    if (form.cpf.value == " ") {
        spanText.textContent = "CPF Vazio";
        form.cpf.style.border = "2px solid red";
        formValido = false;
    } else if (form.cpf.value.length != 11) {
        spanText.textContent = "CPF precisa conter 11 digitos, sem ponto nem traço";
        form.cpf.style.border = "2px solid red";
        formValido = false;
    }
    if (formValido) {
        mensagem += "CPF: " + form.cpf.value + " <br>   ";
    }


    spanText = form.email.nextElementSibling;
    spanText.textContent = "";

    let index = form.email.value.indexOf("@");

    if (index < 1) {
        spanText.textContent = "Email inexistente";
        form.email.style.border = "2px solid red";
        formValido = false;
    } else if (form.email.value.indexOf(".", index) <= index + 3) {
        spanText.textContent = "Dominio de email inexistente";
        form.email.style.border = "2px solid red";
        formValido = false;
    }

    if (formValido) {
        mensagem += "Email: " + form.email.value + " <br>   ";
        mensagem += "Data Nascimento: " + form.dataNasc.value + " <br>  ";
        mensagem += "Telefone: " + form.telefone.value + " <br>     ";
    }

    spanText = form.cnh.nextElementSibling;
    spanText.textContent = "";

    if (form.resposta.value == "sim") {
        if (form.cnh.value == " ") {
            spanText.textContent = "CNH Vazio";
            form.cnh.style.border = "2px solid red";
            formValido = false;
        }
        if (formValido) {
            mensagem += "CNH: " + form.cnh.value + " <br>   ";
        }
    }

    if (selectCarro.value === "troca") {
        spanText = form.marca.nextElementSibling;
        spanText.textContent = "";

        if (form.marca.value == " ") {
            spanText.textContent = "Marca Vazia";
            form.marca.style.border = "2px solid red";
            formValido = false;
        }

        if (formValido) {
            mensagem += "Marca: " + form.marca.value + " <br>   ";
        }

        spanText = form.modelo.nextElementSibling;
        spanText.textContent = "";

        if (form.modelo.value == " ") {
            spanText.textContent = "Modelo Vazio";
            form.modelo.style.border = "2px solid red";
            formValido = false;
        }

        if (formValido) {
            mensagem += "Modelo: " + form.modelo.value + " <br>     ";
        }

        spanText = form.anoFab.nextElementSibling;
        spanText.textContent = "";

        if (form.anoFab.value == " ") {
            spanText.textContent = "Ano Vazio";
            form.anoFab.style.border = "2px solid red";
            formValido = false;
        } else if (form.anoFab.value.length != 4) {
            spanText.textContent = "Digite um ano válido (4 números)";
            form.anoFab.style.border = "2px solid red";
            formValido = false;
        }
        if (formValido) {
            mensagem += "Ano de Fabricação: " + form.anoFab.value + " <br>  ";
        }

        spanText = form.anoMod.nextElementSibling;
        spanText.textContent = "";

        if (form.anoMod.value == " ") {
            spanText.textContent = "Ano Vazio";
            form.anoMod.style.border = "2px solid red";
            formValido = false;
        } else if (form.anoMod.value.length != 4) {
            spanText.textContent = "Digite um ano válido (4 números)";
            form.anoMod.style.border = "2px solid red";
            formValido = false;
        }

        if (formValido) {
            mensagem += "Ano de Modelo: " + form.anoMod.value + " <br>  ";
        }

        spanText = form.placa.nextElementSibling;
        spanText.textContent = "";

        if (form.placa.value == " ") {
            spanText.textContent = "Placa Vazia";
            form.placa.style.border = "2px solid red";
            formValido = false;
        } else if (form.placa.value.length != 7) {
            spanText.textContent = "Digite uma placa válido (sem traço)";
            form.placa.style.border = "2px solid red";
            formValido = false;
        }

        if (formValido) {
            mensagem += "Placa: " + form.placa.value + " <br>   ";
        }
    }

    if (formValido) {
        $('.modal-body-text').html(mensagem);
        $('#meuModal').modal();
        verificacao = false;
    }
}