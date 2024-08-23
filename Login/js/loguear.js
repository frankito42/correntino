document.getElementById("submitBtn").addEventListener("click",(e)=>{
    e.preventDefault()
    let user=document.getElementById("user").value
    let pass=document.getElementById("pass").value
    console.log(user)
    console.log(pass)
    fetch(`php/loguear.php?user=${user}&pass=${pass}`)
    .then(response => response.json())
    .then((data)=>{
        console.log(data)
        if(data=="mal"){
            document.getElementById("user").value=""
            document.getElementById("pass").value=""
            $("#error").modal("show")
        }else{
            localStorage.setItem("user", JSON.stringify(data));
            localStorage.setItem("inicioUser",obtenerFechaHora());
           /*  localStorage.getItem("user"); */
            /* console.log(localStorage.getItem("user")) */
            location.href="../index.php"

        }
    });
})

function obtenerFechaHora() {
    let fecha = new Date();
  
    let dia = fecha.getDate();
    dia = (dia < 10) ? '0' + dia : dia;
  
    let mes = fecha.getMonth() + 1; // Los meses en JavaScript van de 0 a 11
    mes = (mes < 10) ? '0' + mes : mes;
  
    let ano = fecha.getFullYear();
  
    let horas = fecha.getHours();
    horas = (horas < 10) ? '0' + horas : horas;
  
    let minutos = fecha.getMinutes();
    minutos = (minutos < 10) ? '0' + minutos : minutos;
  
    let segundos = fecha.getSeconds();
    segundos = (segundos < 10) ? '0' + segundos : segundos;
  
    return `${dia}-${mes}-${ano} ${horas}:${minutos}:${segundos}`;
  }