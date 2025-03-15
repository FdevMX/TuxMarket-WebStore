document.addEventListener('DOMContentLoaded', function(){
    var divLoading = document.querySelector("#divLoading");
    
    if(document.querySelector("#formRegistro")){
        let formRegistro = document.querySelector("#formRegistro");
        formRegistro.onsubmit = function(e) {
            e.preventDefault();
            console.log("Formulario enviado");
            
            let strNombre = document.querySelector('#txtNombre').value;
            let strApellido = document.querySelector('#txtApellido').value;
            let strEmail = document.querySelector('#txtEmail').value;
            let strPassword = document.querySelector('#txtPassword').value;

            if(strNombre == '' || strApellido == '' || strEmail == '' || strPassword == '')
            {
                swal("Atención", "Todos los campos son obligatorios.", "error");
                return false;
            }

            if(strPassword.length < 5){
                swal("Atención", "La contraseña debe tener al menos 5 caracteres.", "info");
                return false;
            }

            divLoading.style.display = "flex";
            let request = (window.XMLHttpRequest) ? 
                        new XMLHttpRequest() : 
                        new ActiveXObject('Microsoft.XMLHTTP');
            let ajaxUrl = base_url+'/Login/registro'; 
            let formData = new FormData(formRegistro);
            request.open("POST",ajaxUrl,true);
            request.send(formData);
            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status == 200){
                    console.log("Respuesta recibida:", request.responseText);
                    try {
                        let objData = JSON.parse(request.responseText);
                        if(objData.status)
                        {
                            swal({
                                title: "Registro exitoso",
                                text: objData.msg,
                                type: "success",
                                confirmButtonText: "Iniciar sesión",
                                closeOnConfirm: false,
                            }, function(isConfirm) {
                                if (isConfirm) {
                                    window.location = base_url+'/login';
                                }
                            });
                        }else{
                            swal("Error", objData.msg, "error");
                        }
                    } catch(e) {
                        console.error("Error al procesar respuesta:", e);
                        console.log("Respuesta recibida:", request.responseText);
                        swal("Error", "Ha ocurrido un problema en el proceso", "error");
                    }
                }
                divLoading.style.display = "none";
            }
        }
    }
}, false);