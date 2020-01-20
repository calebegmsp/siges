




    $(document).ready(function(){
        $('#input-cpf').mask('000.000.000-00', {reverse: true});
        $('#input-tel').mask('(00) 00000-0000');
        $('#input-phone').mask('(00) 0000-0000');
        $('#input-cpf_spouse').mask('000.000.000-00', {reverse: true});
        $('#input-cep').mask('00000-000');
        $('#input-value').mask('000.000.000,00', {reverse: true});
        $('#input-valueAss').mask('000.000.000,00', {reverse: true});
        $('#input-year').mask('0000');
        
        
        
    });

    function ValidatorTypePerson(){
        if (type_person_1.checked){
            document.getElementById("input-birth_date").required = true;
            document.getElementById("label-birth_date").innerHTML = "Data de nascimento *";
            document.getElementById("input-tel").required = true;
            document.getElementById("label-tel").innerHTML = "Telefone celular *";
            document.getElementById("input-marital_status").required = true;
            document.getElementById("label-marital_status").innerHTML = "Estado civil *";
            document.getElementById("label-spouse").innerHTML = "Nome cônjuge *";
            document.getElementById("label-cpf_spouse").innerHTML = "CPF cônjuge *";
            document.getElementById("label-birth_date_spouse").innerHTML = "Data de nascimento *";
            document.getElementById("input-mother_name").required = true;
            document.getElementById("label-mother_name").innerHTML = "Nome da mãe *";
            document.getElementById("div-affiliation-date").style.visibility = "visible";
            document.getElementById("div-affiliation-date").style.opacity = "1";
            document.getElementById("input-affiliation_date").required = true;
        } else {
            document.getElementById("input-birth_date").required = false;
            document.getElementById("label-birth_date").innerHTML = "Data de nascimento";
            document.getElementById("input-tel").required = false;
            document.getElementById("label-tel").innerHTML = "Telefone celular";
            document.getElementById("input-marital_status").required = false;
            document.getElementById("label-marital_status").innerHTML = "Estado civil";
            document.getElementById("input-spouse").required = false;
            document.getElementById("label-spouse").innerHTML = "Nome cônjuge";
            document.getElementById("input-cpf_spouse").required = false;
            document.getElementById("label-cpf_spouse").innerHTML = "CPF cônjuge";
            document.getElementById("input-birth_date_spouse").required = false;
            document.getElementById("label-birth_date_spouse").innerHTML = "Data de nascimento";
            document.getElementById("input-mother_name").required = false;
            document.getElementById("label-mother_name").innerHTML = "Nome da mãe";
            document.getElementById("div-affiliation-date").style.visibility = "hidden";
            document.getElementById("div-affiliation-date").style.opacity = "0";
            document.getElementById("input-affiliation_date").required = false;
        }
    }

    function validatorAffiliationDate() {
        input= document.getElementById("input-affiliation_date").value;
        label = document.getElementById("label-affiliation_date");
        if (input != ""){
            div_input = document.getElementById("div-input-affiliation_date")
            partsDate = input.split("-");
            label.innerHTML = "Data de filiação *";
            input.className = "form-control is-valid";
            div_input.className = "input-group input-group-alternative has-success";
        } else {
            label.innerHTML = "Data de filiação *";
            input.className = "form-control";
        }
    }



    function ValidateCpf(cpf)
      {
        cpf = cpf.value.replace(/[^\d]+/g,'');
        var number, digits, sum, i, result, equal_digits;
        equal_digits = 1;
        if (cpf.length < 11)
              return false;
        for (i = 0; i < cpf.length - 1; i++)
              if (cpf.charAt(i) != cpf.charAt(i + 1))
                    {
                    equal_digits = 0;
                    break;
                    }
        if (!equal_digits)
              {
              number = cpf.substring(0,9);
              digits = cpf.substring(9);
              sum = 0;
              for (i = 10; i > 1; i--)
                    sum += number.charAt(10 - i) * i;
              result = sum % 11 < 2 ? 0 : 11 - sum % 11;
              if (result != digits.charAt(0))
                    return false;
              number = cpf.substring(0,10);
              sum = 0;
              for (i = 11; i > 1; i--)
                    sum += number.charAt(11 - i) * i;
              result = sum % 11 < 2 ? 0 : 11 - sum % 11;
              if (result != digits.charAt(1))
                    return false;
              return true;
              }
        else
            return false;
      }


    function validatorCpf(e) {
        input_cpf = document.getElementById("input-cpf");
        div_input_cpf = document.getElementById("div-input-cpf");
        label = document.getElementById("label-cpf");
        if (e == '1') {
            label.innerHTML = "CPF <span style=\"color: red;\"> já cadastrado</span>";
            input_cpf.className = "form-control is-invalid";
            div_input_cpf.className = "has-danger";
        } else {
            if (input_cpf.value != ""){
                if (!ValidateCpf(input_cpf)) {
                    label.innerHTML = "CPF <span style=\"color: red;\"> inválido</span>";
                    input_cpf.className = "form-control is-invalid";
                    div_input_cpf.className = "has-danger";
                } else {
                        label.innerHTML = "CPF *";
                        input_cpf.className = "form-control is-valid";
                        div_input_cpf.className = "has-success"; 
                }
            } else {
                label.innerHTML = "CPF *";
                input_cpf.className = "form-control";
                div_input_cpf.className = "";
            }    
        }
    }



   function validatorRg() {
        input_rg = document.getElementById("input-rg");
        div_input_rg = document.getElementById("div-input-rg");
        label = document.getElementById("label-rg");
        if (input_rg.value != ""){
            if (input_rg.value.length > 5){
                label.innerHTML = "RG";
                input_rg.className = "form-control is-valid";
                div_input_rg.className = "has-success";
            } else {
                label.innerHTML = "RG <span style=\"color: red;\"> inválido</span>";
                input_rg.className = "form-control is-invalid";
                div_input_rg.className = "has-danger";
            }
        } else {
            label.innerHTML = "RG";
            input_rg.className = "form-control";
            div_input_rg.className = "";
        }
    }

   function validatorName() {
        input_name = document.getElementById("input-name");
        div_input_name = document.getElementById("div-input-name");
        label = document.getElementById("label-name");
        filter_nome = /^([a-zA-Zà-úÀ-Ú]|\s+)+$/;
        if (input_name.value != ""){
            if (input_name.value.length > 4 && filter_nome.test(input_name.value)){
                label.innerHTML = "Nome completo *";
                input_name.className = "form-control is-valid";
                div_input_name.className = "has-success";
            } else {
                label.innerHTML = "Nome completo <span style=\"color: red;\"> inválido</span>";
                input_name.className = "form-control is-invalid";
                div_input_name.className = "has-danger";
            }
        } else {
            label.innerHTML = "Nome completo *";
            input_name.className = "form-control";
            div_input_name.className = "";
        }
    }

    function validateEmail(field) {
        user = field.value.substring(0, field.value.indexOf("@"));
        domain = field.value.substring(field.value.indexOf("@")+ 1, field.value.length);
         
        if ((user.length >=1) &&
            (domain.length >=3) && 
            (user.search("@")==-1) && 
            (domain.search("@")==-1) &&
            (user.search(" ")==-1) && 
            (domain.search(" ")==-1) &&
            (domain.search(".")!=-1) &&      
            (domain.indexOf(".") >=1)&& 
            (domain.lastIndexOf(".") < domain.length - 1)) {
            return 1;
        }
        else{
            return 0;
        }
    }



    function validatorEmail() {
        input_email = document.getElementById("input-email");
        div_input_email = document.getElementById("div-input-email");
        label = document.getElementById("label-email");
        if (input_email.value != ""){
            if (input_email.value.length > 5 && validateEmail(input_email)){
                label.innerHTML = "Email";
                input_email.className = "form-control is-valid";
                div_input_email.className = "has-success";
            } else {
                label.innerHTML = "Email <span style=\"color: red;\"> inválido</span>";
                input_email.className = "form-control is-invalid";
                div_input_email.className = "has-danger";
            }
        } else {
            label.innerHTML = "Email";
            input_email.className = "form-control";
            div_input_email.className = "";
        }
    }        


    function ages(day, month, year) {
        now = new Date;
        age = now.getFullYear() - year;
        if (month  > (now.getMonth() + 1) || (month  == (now.getMonth() + 1) && day > now.getDate())){
            age--;
        }
        return age;
    }

    function validatorDate() {
        input_birth_date = document.getElementById("input-birth_date").value;
        label = document.getElementById("label-birth_date");
        if (input_birth_date != ""){
            div_input_birth_date = document.getElementById("div-input-birth_date")
            btn_alert_date = document.getElementById("btn-alert-date")
            partsDate = input_birth_date.split("-");
            if (ages(partsDate[2], partsDate[1], partsDate[0]) < 16){
                label.innerHTML = "Data de nascimento <span style=\"color: red;\"> inválida</span>";
                input_birth_date.className = "form-control is-invalid";
                div_input_birth_date.className = "input-group has-danger";
                btn_alert_date.style.color = "Tomato";
            } else {
                label.innerHTML = "Data de nascimento *";
                input_birth_date.className = "form-control is-valid";
                div_input_birth_date.className = "input-group has-success";
                btn_alert_date.style.color = "Dodgerblue";
            }
        } else {
            label.innerHTML = "Data de nascimento *";
            input_birth_date.className = "form-control";
        }
    }

   function validatorSex() {
        input_sex = document.getElementById("customRadio5");
            if (input_sex.checked == true){
                document.getElementById('m_s-AM').innerHTML = "AMASIADO";
                document.getElementById('m_s-SO').innerHTML = "SOLTEIRO";
                document.getElementById('m_s-CA').innerHTML = "CASADO";
                document.getElementById('m_s-SE').innerHTML = "SEPARADO";
                document.getElementById('m_s-DI').innerHTML = "DIVORCIADO";
                document.getElementById('m_s-VI').innerHTML = "VIÚVO";
                document.getElementById('n-BR').innerHTML = "BRASILEIRO";
                document.getElementById('n-ST').innerHTML = "ESTRANGEIRO";
                document.getElementById('label-legal_aspect_1').innerHTML = "PROPRIETÁRIO";
                document.getElementById('label-legal_aspect_2').innerHTML = "COMODATÁRIO";
                document.getElementById('label-type_person_1').innerHTML = "ASSOCIADO";
                document.getElementById('label-type_person_2').innerHTML = "DOADOR";
            } else {
                document.getElementById('m_s-AM').innerHTML = "AMASIADA";
                document.getElementById('m_s-SO').innerHTML = "SOLTEIRA";
                document.getElementById('m_s-CA').innerHTML = "CASADA";
                document.getElementById('m_s-SE').innerHTML = "SEPARADA";
                document.getElementById('m_s-DI').innerHTML = "DIVORCIADA";
                document.getElementById('m_s-VI').innerHTML = "VIÚVA";
                document.getElementById('n-BR').innerHTML = "BRASILEIRA";
                document.getElementById('n-ST').innerHTML = "ESTRANGEIRA";
                document.getElementById('label-legal_aspect_1').innerHTML = "PROPRIETÁRIA";
                document.getElementById('label-legal_aspect_2').innerHTML = "COMODATÁRIA";
                document.getElementById('label-type_person_1').innerHTML = "ASSOCIADA";
                document.getElementById('label-type_person_2').innerHTML = "DOADORA";
            }
    } 

   function validatorTel() {
        input_tel = document.getElementById("input-tel");
        div_input_tel = document.getElementById("div-input-tel");
        label = document.getElementById("label-tel");
        if (input_tel.value != ""){
            if (input_tel.value.length == 15){
                label.innerHTML = "Telefone celular *";
                input_tel.className = "form-control is-valid";
                div_input_tel.className = "has-success";
            } else {
                label.innerHTML = "Telefone celular <span style=\"color: red;\"> inválido</span>";
                input_tel.className = "form-control is-invalid";
                div_input_tel.className = "has-danger";
            }
        } else {
            label.innerHTML = "Telefone celular *";
            input_tel.className = "form-control";
            div_input_tel.className = "";
        }
    }

    function validatorPhone() {
        input_phone = document.getElementById("input-phone");
        div_input_phone = document.getElementById("div-input-phone");
        label = document.getElementById("label-phone");
        if (input_phone.value != ""){
            if (input_phone.value.length == 14){
                label.innerHTML = "Telefone fixo";
                input_phone.className = "form-control is-valid";
                div_input_phone.className = "has-success";
            } else {
                label.innerHTML = "Telefone fixo <span style=\"color: red;\"> inválido</span>";
                input_phone.className = "form-control is-invalid";
                div_input_phone.className = "has-danger";
            }
        } else {
            label.innerHTML = "Telefone fixo";
            input_phone.className = "form-control";
            div_input_phone.className = "";
        }
    }

    function validatorNationality() {
        input_nationality = document.getElementById("input-nationality");
        div_input_nationality = document.getElementById("div-input-nationality");
        label = document.getElementById("label-nationality");
        if (input_nationality.value != ""){
            label.innerHTML = "Nacionalidade *";
            input_nationality.className = "form-control is-valid";
            div_input_nationality.className = "has-success";
        } else {
            label.innerHTML = "Nacionalidade *";
            input_nationality.className = "form-control";
            div_input_nationality.className = "";
        }
    }

    function selectNationality(value) {
        document.getElementById("input-nationality").value = value;
    }


    function validatorNaturalness() {
        input_naturalness = document.getElementById("input-naturalness");
        div_input_naturalness = document.getElementById("div-input-naturalness");
        filter_nome = /^([a-zA-Zà-úÀ-Ú-]|\s+)+$/;
        label = document.getElementById("label-naturalness");
        if (input_naturalness.value != ""){
            if (input_naturalness.value.length > 2 && filter_nome.test(input_naturalness.value)){
                label.innerHTML = "Naturalidade *";
                input_naturalness.className = "form-control is-valid";
                div_input_naturalness.className = "has-success";
            } else {
                label.innerHTML = "Naturalidade <span style=\"color: red;\"> inválida</span>";
                input_naturalness.className = "form-control is-invalid";
                div_input_naturalness.className = "has-danger";
            }
        } else {
            label.innerHTML = "Naturalidade *";
            input_naturalness.className = "form-control";
            div_input_naturalness.className = "";
        }
    }

   function validatorMaritalStatus() {
        input_marital_status = document.getElementById("input-marital_status");
        div_input_marital_status = document.getElementById("div-input-marital_status");
        label = document.getElementById("label-marital_status");
        if (input_marital_status.value != ""){
            if (input_marital_status.value.length > 0){
                if (type_person_1.checked) label.innerHTML = "Estado civil *"; else label.innerHTML = "Estado civil";
                input_marital_status.className = "form-control is-valid";
                div_input_marital_status.className = "has-success";
                if (input_marital_status.value == "CASAD" || input_marital_status.value == "AMASIAD"){
                    document.getElementById("div-spouse").style.visibility = "visible";
                    document.getElementById("div-spouse").style.height = "15em";
                    document.getElementById("input-spouse").required = true;
                    document.getElementById("input-cpf_spouse").required = true;
                    document.getElementById("input-birth_date_spouse").required = true;
                    document.getElementById("input-spouse_mother_name").required = true;
                } else {
                    document.getElementById("div-spouse").style.visibility = "hidden";
                    document.getElementById("div-spouse").style.height = "0";
                    document.getElementById("input-spouse").required = false;
                    document.getElementById("input-cpf_spouse").required = false;
                    document.getElementById("input-birth_date_spouse").required = false;
                    document.getElementById("input-spouse_mother_name").required = false;
                }
            } else {
                label.innerHTML = "Estado civil <span style=\"color: red;\"> inválido</span>";
                input_marital_status.className = "form-control is-invalid";
                div_input_marital_status.className = "has-danger";
            }
        } else {
            if (type_person_1.checked) label.innerHTML = "Estado civil *"; else label.innerHTML = "Estado civil";
            input_marital_status.className = "form-control";
            div_input_marital_status.className = "";
        }
    }

    function selectMaritalStatus(value) {
        document.getElementById("input-marital_status").value = value;
    }


   function validatorSpouse() {
        input = document.getElementById("input-spouse");
        div_input = document.getElementById("div-input-spouse");
        label = document.getElementById("label-spouse");
        filter_nome = /^([a-zA-Zà-úÀ-Ú]|\s+)+$/;
        if (input.value != ""){
            if (input.value.length > 4 && filter_nome.test(input.value)){
                label.innerHTML = "Nome cônjuge *";
                input.className = "form-control is-valid";
                div_input.className = "has-success";
            } else {
                label.innerHTML = "Nome cônjuge <span style=\"color: red;\"> inválido</span>";
                input.className = "form-control is-invalid";
                div_input.className = "has-danger";
            }
        } else {
            label.innerHTML = "Nome cônjuge *";
            input.className = "form-control";
            div_input.className = "";
        }
    }

    function validatorCpfSpouse() {
        input = document.getElementById("input-cpf_spouse");
        div_input = document.getElementById("div-input-cpf_spouse");
        label = document.getElementById("label-cpf_spouse");
        if (input.value != ""){
            if (!ValidateCpf(input)) {
                label.innerHTML = "CPF cônjuge <span style=\"color: red;\"> inválido</span>";
                input.className = "form-control is-invalid";
                div_input.className = "has-danger";
            } else {
                label.innerHTML = "CPF cônjuge *";
                input.className = "form-control is-valid";
                div_input.className = "has-success";
            }
        } else {
            label.innerHTML = "CPF cônjuge *";
            input.className = "form-control";
            div_input.className = "";
        }
    }

    function validatorDateSpouse() {
        input = document.getElementById("input-birth_date_spouse").value;
        label = document.getElementById("label-birth_date_spouse");
        if (input != ""){
            div_input = document.getElementById("div-input-birth_date_spouse")
            btn_alert_date = document.getElementById("btn-alert-date_spouse")
            partsDate = input.split("-");
            if (ages(partsDate[2], partsDate[1], partsDate[0]) < 16){
                label.innerHTML = "Data de nascimento <span style=\"color: red;\"> inválida</span>";
                input.className = "form-control is-invalid";
                div_input.className = "input-group has-danger";
                btn_alert_date.style.color = "Tomato";
            } else {
                label.innerHTML = "Data de nascimento *";
                input.className = "form-control is-valid";
                div_input.className = "input-group has-success";
                btn_alert_date.style.color = "Dodgerblue";
            }
        } else {
            label.innerHTML = "Data de nascimento *";
            input.className = "form-control";
        }
    }

    function validatorSpouseMotherName() {
        input = document.getElementById("input-spouse_mother_name");
        div_input = document.getElementById("div-input-spouse_mother_name");
        label = document.getElementById("label-spouse_mother_name");
        filter_nome = /^([a-zA-Zà-úÀ-Ú]|\s+)+$/;
        if (input.value != ""){
            if (input.value.length > 4 && filter_nome.test(input.value)){
                label.innerHTML = "Nome da mãe *";
                input.className = "form-control is-valid";
                div_input.className = "has-success";
            } else {
                label.innerHTML = "Nome da mãe <span style=\"color: red;\"> inválido</span>";
                input.className = "form-control is-invalid";
                div_input.className = "has-danger";
            }
        } else {
            label.innerHTML = "Nome da mãe *";
            input.className = "form-control";
            div_input.className = "";
        }
    }


    function validatorMotherName() {
        input_mother_name = document.getElementById("input-mother_name");
        div_input_mother_name = document.getElementById("div-mother_name");
        label = document.getElementById("label-mother_name");
        if (input_mother_name.value != ""){
            if (input_mother_name.value.length > 2){
                label.innerHTML = "Nome da mãe *";
                input_mother_name.className = "form-control is-valid";
                div_input_mother_name.className = "has-success";
            } else {
                label.innerHTML = "Nome da mãe <span style=\"color: red;\"> inválido</span>";
                input_mother_name.className = "form-control is-invalid";
                div_input_mother_name.className = "has-danger";
            }
        } else {
            label.innerHTML = "Nome da mãe *";
            input_mother_name.className = "form-control";
            div_input_mother_name.className = "";
        }
    }



    function validatorDadName() {
        input_dad_name = document.getElementById("input-dad_name");
        div_input_dad_name = document.getElementById("div-dad_name");
        label = document.getElementById("label-dad_name");
        if (input_dad_name.value != ""){
            if (input_dad_name.value.length > 2){
                label.innerHTML = "Nome do pai";
                input_dad_name.className = "form-control is-valid";
                div_input_dad_name.className = "has-success";
            } else {
                label.innerHTML = "Nome do pai <span style=\"color: red;\"> inválido</span>";
                input_dad_name.className = "form-control is-invalid";
                div_input_dad_name.className = "has-danger";
            }
        } else {
            label.innerHTML = "Nome do pai";
            input_dad_name.className = "form-control";
            div_input_dad_name.className = "";
        }
    }

    function my_callback(received) {
        if (!("erro" in received)) {
            //Atualiza os campos com os valores.
            document.getElementById('input-placestrict').value=(received.logradouro);
            document.getElementById('input-district').value=(received.bairro);
            document.getElementById('input-city').value=(received.localidade);
            if (received.uf != "") {
                document.getElementById('input-uf').value=(received.uf);
            }
            //Atualiza campo para válido
            document.getElementById('label-cep').innerHTML = "CEP *";
            document.getElementById('input-cep').className = "form-control is-valid";
            document.getElementById('div-input-cep').className = "has-success";

        } //end if.
        else {
            document.getElementById('label-cep').innerHTML = "CEP <span style=\"color: red;\"> inválido</span>";
            document.getElementById('input-cep').className = "form-control is-invalid";
            document.getElementById('div-input-cep').className = "has-danger";
        }
    }
        
    function searchCep() {
        cep = document.getElementById('input-cep').value.replace(/[^0-9]/g,'');;
        label_cep = document.getElementById('label-cep');
        input_cep = document.getElementById('input-cep');
        div_input_cep = document.getElementById('div-input-cep');
        //Verifica se campo cep possui valor informado.
        if (cep != "") {
            if (input_cep.value.length == 9){
                //Expressão regular para validar o CEP.
                var authenticateCep = /^[0-9]{8}$/;
                //Valida o formato do CEP.
                if(authenticateCep.test(cep)) {
                    //Preenche os campos com "..." enquanto consulta webservice.
                    document.getElementById('input-placestrict').value="...";
                    document.getElementById('input-district').value="...";
                    document.getElementById('input-city').value="...";
                    //Cria um elemento javascript.
                    var script = document.createElement('script');
                    //Sincroniza com o callback.
                    script.src = 'https://viacep.com.br/ws/'+ cep + '/json/?callback=my_callback';
                    //Insere script no documento e carrega o conteúdo.
                    document.body.appendChild(script);
                } //end if.
            } else {
                label_cep.innerHTML = "CEP <span style=\"color: red;\"> inválido</span>";
                input_cep.className = "form-control is-invalid";
                div_input_cep.className = "has-danger";
            }
        } else {
            label_cep.innerHTML = "CEP *";
            input_cep.className = "form-control";
            div_input_cep.className = "";
        }
    }


    function validatorUf() {
        input_uf = document.getElementById("input-uf");
        div_input_uf = document.getElementById("div-input-uf");
        label = document.getElementById("label-uf");
        if (input_uf.value != ""){
            label.innerHTML = "UF *";
            input_uf.className = "form-control is-valid";
            div_input_uf.className = "has-success";
        } else {
            label.innerHTML = "UF *";
            input_uf.className = "form-control";
            div_input_uf.className = "";
        }
    }

    function selectUf(value) {
            document.getElementById("input-uf").value = value;
        }


    function validatorCity() {
        input_city = document.getElementById("input-city");
        div_input_city = document.getElementById("div-input-city");
        label = document.getElementById("label-city");
        if (input_city.value != ""){
            if (input_city.value.length > 2){
                label.innerHTML = "Cidade *";
                input_city.className = "form-control is-valid";
                div_input_city.className = "has-success";
            } else {
                label.innerHTML = "Cidade <span style=\"color: red;\"> inválido</span>";
                input_city.className = "form-control is-invalid";
                div_input_city.className = "has-danger";
            }
        } else {
            label.innerHTML = "Cidade *";
            input_city.className = "form-control";
            div_input_city.className = "";
        }
    } 

    function validatorDistrict() {
        input_district = document.getElementById("input-district");
        div_input_district = document.getElementById("div-input-district");
        label = document.getElementById("label-district");
        if (input_district.value != ""){
            if (input_district.value.length > 2){
                label.innerHTML = "Bairro ou distrito *";
                input_district.className = "form-control is-valid";
                div_input_district.className = "has-success";
            } else {
                label.innerHTML = "Bairro ou distrito <span style=\"color: red;\"> inválido</span>";
                input_district.className = "form-control is-invalid";
                div_input_district.className = "has-danger";
            }
        } else {
            label.innerHTML = "Bairro ou distrito *";
            input_district.className = "form-control";
            div_input_district.className = "";
        }
    }



    function validatorComplement() {
        input_complement = document.getElementById("input-complement");
        div_input_complement = document.getElementById("div-input-complement");
        label = document.getElementById("label-complement");
        if (input_complement.value != ""){
            if (input_complement.value.length > 0){
                label.innerHTML = "Complemento";
                input_complement.className = "form-control is-valid";
                div_input_complement.className = "has-success";
            } else {
                label.innerHTML = "Complemento <span style=\"color: red;\"> inválido</span>";
                input_complement.className = "form-control is-invalid";
                div_input_complement.className = "has-danger";
            }
        } else {
            label.innerHTML = "Complemento";
            input_complement.className = "form-control";
            div_input_complement.className = "";
        }
    }

    function validatorPlacestrict() {
        input_placestrict = document.getElementById("input-placestrict");
        div_input_placestrict = document.getElementById("div-input-placestrict");
        label = document.getElementById("label-placestrict");
        if (input_placestrict.value != ""){
            if (input_placestrict.value.length > 2){
                label.innerHTML = "Logradouro ou rua *";
                input_placestrict.className = "form-control is-valid";
                div_input_placestrict.className = "has-success";
            } else {
                label.innerHTML = "Logradouro ou rua <span style=\"color: red;\"> inválido</span>";
                input_placestrict.className = "form-control is-invalid";
                div_input_placestrict.className = "has-danger";
            }
        } else {
            label.innerHTML = "Logradouro ou rua *";
            input_placestrict.className = "form-control";
            div_input_placestrict.className = "";
        }
    }


    function validatorNumberHome() {
        input_number_home = document.getElementById("input-number_home");
        div_input_number_home = document.getElementById("div-input-number_home");
        label = document.getElementById("label-number_home");
        if (input_number_home.value != ""){
            if (input_number_home.value.length > 0){
                label.innerHTML = "Número da casa *";
                input_number_home.className = "form-control is-valid";
                div_input_number_home.className = "has-success";
            } else {
                label.innerHTML = "Número da casa <span style=\"color: red;\"> inválido</span>";
                input_number_home.className = "form-control is-invalid";
                div_input_number_home.className = "has-danger";
            }
        } else {
            label.innerHTML = "Número da casa *";
            input_number_home.className = "form-control";
            div_input_number_home.className = "";
        }
    }

    function validatorElectionTitle() {
        input_election_title = document.getElementById("input-election_title");
        div_input_election_title = document.getElementById("div-input-election_title");
        label = document.getElementById("label-election_title");
        validate = /[^0-9.]/;
        validate.lastIndex = 0;
        if (input_election_title.value != ""){
            if (input_election_title.value.length > 5 && !validate.test(input_election_title.value)){
                label.innerHTML = "Número de inscrição";
                input_election_title.className = "form-control is-valid";
                div_input_election_title.className = "has-success";
            } else {
                label.innerHTML = "Número de inscrição <span style=\"color: red;\"> inválido</span>";
                input_election_title.className = "form-control is-invalid";
                div_input_election_title.className = "has-danger";
            }
        } else {
            label.innerHTML = "Número de inscrição";
            input_election_title.className = "form-control";
            div_input_election_title.className = "";
        }
    }

    function validatorElectoralZone() {
        input_electoral_zone = document.getElementById("input-electoral_zone");
        div_input_electoral_zone = document.getElementById("div-input-electoral_zone");
        label = document.getElementById("label-electoral_zone");
        validate = /[^0-9.]/;
        validate.lastIndex = 0;
        if (input_electoral_zone.value != ""){
            if (input_electoral_zone.value.length > 0 && !validate.test(input_electoral_zone.value)){
                label.innerHTML = "Zona eleitoral";
                input_electoral_zone.className = "form-control is-valid";
                div_input_electoral_zone.className = "has-success";
            } else {
                label.innerHTML = "Zona eleitoral <span style=\"color: red;\"> inválida</span>";
                input_electoral_zone.className = "form-control is-invalid";
                div_input_electoral_zone.className = "has-danger";
            }
        } else {
            label.innerHTML = "Zona eleitoral";
            input_electoral_zone.className = "form-control";
            div_input_electoral_zone.className = "";
        }
    }

    function validatorElectionSection() {
        input_election_section = document.getElementById("input-election_section");
        div_input_election_section = document.getElementById("div-input-election_section");
        label = document.getElementById("label-election_section");
        validate = /[^0-9.]/;
        validate.lastIndex = 0;
        if (input_election_section.value != ""){
            if (input_election_section.value.length > 0 && !validate.test(input_election_section.value)){
                label.innerHTML = "Seção eleitoral";
                input_election_section.className = "form-control is-valid";
                div_input_election_section.className = "has-success";
            } else {
                label.innerHTML = "Seção eleitoral <span style=\"color: red;\"> inválida</span>";
                input_election_section.className = "form-control is-invalid";
                div_input_election_section.className = "has-danger";
            }
        } else {
            label.innerHTML = "Seção eleitoral";
            input_election_section.className = "form-control";
            div_input_election_section.className = "";
        }
    }

    function validatorActivityArea() {
        input = document.getElementById("input-activity_area");
        div_input = document.getElementById("div-input-activity_area");
        label = document.getElementById("label-activity_area");
        validate = /[^0-9.]/;
        validate.lastIndex = 0;
        if (input.value != ""){
            if (input.value.length > 0 && !validate.test(input_election_section.value)){
                label.innerHTML = "Área em hectares";
                input.className = "form-control is-valid";
                div_input.className = "has-success";
            } else {
                label.innerHTML = "Área <span style=\"color: red;\"> inválida</span>";
                input.className = "form-control is-invalid";
                div_input.className = "has-danger";
            }
        } else {
            label.innerHTML = "Área em hectares";
            input.className = "form-control";
            div_input.className = "";
        }
    }

    function GetId(id, name){
        document.getElementById("form-destroy").action = document.getElementById("id_url").value + '/' + id + '/destroy';
        document.getElementById("name-people").innerHTML = name;
    }


    function logArrayElements(element, index, array) {
        element.className = "form-control";
    }

    function addListNamePeople(){
        if (document.getElementById('input-namePeople').value != '') {
            var date = new Date();
            var id = date.valueOf()
            var code = '<td id="' + id + '"><input type="hidden" value="' + document.getElementById('input-namePeople').value + '" name="namePeople[]">' + document.getElementById('input-namePeople').value + '<button type="button" class="close" aria-label="Close" onclick="javascript: removeListItem(' + id + ')"> <span aria-hidden="true" style="color: #801109;">×</span></button></td>';
            document.getElementById('tbodyListPeoples').innerHTML =
            document.getElementById('tbodyListPeoples').innerHTML + code;
            document.getElementById('input-namePeople').value = '';
        }
    }

    function clearInputs(){
        validatorCpf();
        validatorRg();
        validatorName();
        validatorEmail();
        validatorDate();
        validatorSex();
        validatorTel();
        validatorPhone();
        validatorNationality();
        validatorNaturalness();
        validatorMaritalStatus();
        validatorSpouse();
        validatorCpfSpouse();
        validatorDateSpouse();
        validatorMotherName();
        validatorDadName();
        searchCep();
        validatorUf();
        validatorCity();
        validatorDistrict();
        validatorComplement();
        validatorPlacestrict();
        validatorNumberHome();
        validatorElectionTitle();
        validatorElectoralZone();
        validatorElectionSection();
        document.getElementById('m_s-AM').innerHTML = "Amasiado (a)";
        document.getElementById('m_s-SO').innerHTML = "Solteiro (a)";
        document.getElementById('m_s-CA').innerHTML = "Casado (a)";
        document.getElementById('m_s-SE').innerHTML = "Separado (a)";
        document.getElementById('m_s-DI').innerHTML = "Divorciado (a)";
        document.getElementById('m_s-VI').innerHTML = "Viúva (a)";
        document.getElementById('n-BR').innerHTML = "Brasileiro (a)";
        document.getElementById("div-spouse").style.height = "0";
        document.getElementById('label-legal_aspect_1').innerHTML = "Proprietário (a)";
        document.getElementById('label-legal_aspect_2').innerHTML = "Comodatária (a)";
        document.getElementById('label-type_person_1').innerHTML = "Associado (a)";
        document.getElementById('label-type_person_2').innerHTML = "Doador (a)";
        document.getElementById("div-spouse").style.visibility = "hidden";
        document.getElementById("div-spouse").style.height = "0";
        document.getElementById("input-spouse").required = false;
        document.getElementById("input-cpf_spouse").required = false;
        document.getElementById("input-birth_date_spouse").required = false;
    }

    function clearFuction() {
        document.getElementById('input-placestrict').disabled = false;
        document.getElementById('input-district').disabled = false;
        document.getElementById('input-city').disabled = false;
        document.getElementById('input-uf').disabled = false;
        form.reset();
        setTimeout(clearInputs(), 1000);
    }

    function returnAge() {
        input = document.getElementById("age_").value;
        partsDate = input.split("-");
        document.getElementById("age").innerHTML = ages(partsDate[2], partsDate[1], partsDate[0]) + ' ANOS';
    }
    
    $('#form').on('keyup', 'input', function(event) {
      if (event.which == 13) {
        var generico = $("#form").find('input');
        var indice = generico.index(event.target) + 1;
        var seletor = $(generico[indice]).focus();

        if (seletor.length == 0) {
          event.target.focus();
        }
      }
    });

    $(document).ready(function() {
      $(window).keydown(function(event){
        if(event.keyCode == 13) {
          event.preventDefault();
          return false;
        }
      });
    });

    function newCat() {
        input = document.getElementById("input-cat");
        if (input.value == 'newCat') {
            document.getElementById("newCat-div").style.visibility = 'visible';
            document.getElementById("newCat-div").style.height = 'auto';     
        }else {
            document.getElementById("newCat-div").style.visibility = 'hidden';
            document.getElementById("newCat-div").style.height = '0em';  
        } 
    }


