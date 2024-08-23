document.addEventListener("DOMContentLoaded",async function(event) {
    // Your code to run since DOM is loaded and ready
    await traerEstablecimientos()
    await verificar()
    document.getElementById("seleccionEstaForm").addEventListener("submit",async (e)=>{
        e.preventDefault()
        let formData=new FormData(document.getElementById("seleccionEstaForm"))
        await fetch('php/seleccionarEsta.php?selectEsta='+document.getElementById("selectEsta").value)
      .then(response => response.json())
      .then(async (data) => { 
        console.log(data)
        if (data=="okey") {
            $("#estaModal").modal("hide")
            let esta=JSON.parse(localStorage.getItem("user"))
            esta.establecimiento=document.getElementById("selectEsta").value
            esta.nombreDeEstablecimiento=document.getElementById("selectEsta").textContent
            localStorage.setItem("user",JSON.stringify(esta))
            await verificar() 
            console.log(localStorage.getItem("user"))
        }
    });
    })
    
});

async function traerEstablecimientos (){
   await fetch('php/traerEstablecimientos.php')
  .then(response => response.json())
  .then((data) => {
    console.log(data)
    let establecimientos=`<option selected value="">Establecimiento</option>`
    data.forEach(element => {
       establecimientos+=`
       <option value="${element.idEsta}">${element.nombreEsta}</option>
       
       ` 
    });
    document.getElementById("selectEsta").innerHTML=establecimientos
});
}

 

async function verificar() {

    local=JSON.parse(localStorage.getItem("user"))

        console.log(local.establecimiento)
        if (local.establecimiento==undefined) {
            $('#estaModal').modal({backdrop: 'static', keyboard: false})
            $("#estaModal").modal("show")
    
        }else{
            document.getElementById("EstablecimientoMostrar").innerHTML=`<span style="font-size: 140%;">`+local.nombreDeEstablecimiento+`</span>`
           
        }
    

   
    

}
