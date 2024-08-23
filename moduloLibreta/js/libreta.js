let clientes
document.addEventListener("DOMContentLoaded",async  function(event) {
  await traerFamilias()
  /* await traerLibreta() */
    /*  FILTRO DE LA TABLA FAMILIAS */
    $("#tableSearch").on("keyup", function() {
      var value = $(this).val().toLowerCase();
      $("#myTable tr").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
      });
    });
    /*  FILTRO DE LA TABLA FAMILIAS */
});
async function traerLibreta(id) {
  $("#modalMostrarLaLibreta").modal("show")
  await fetch('php/listarLibretas.php?id='+id)
  .then((response) => response.json())
  .then(async (data) => {
    console.log(data) 
    await dibujarCards(data)
  }); 
}
async function traerFamilias() {
  await fetch('php/listarClientes.php')
  .then((response) => response.json())
  .then(async (data) => {
    console.log(data)
    clientes=data
    dibujarFamilias(data)
  });
}

async function dibujarFamilias(params) {
  let tr=``
  params.forEach(element => {
    tr+=`
      <tr>
        <td>${element.nombreCliente}</td>
        <td>
          <button class="btn btn-blue" onclick="traerLibreta(${element.id})">Ver</button>
          <button class="btn btn-blue" onclick="verHistorial(${element.id})">Ver historial</button>
        </td>
      </tr>
    `
  });
  document.getElementById("listarFamiliasAllTabla").innerHTML=tr
}


async function dibujarCards(params) {
  let card=``
  let total=0
  let lista=``
  let lista2=``


if (params.length>=1) {
  params.forEach(element => {
    total+=element.cantidad*element.mayoritario
    lista+=`
    <h5 class="bold">${element.nombre}<span> x${element.cantidad}</span> <span style="color:#4caf50;">$${separator(element.cantidad*element.mayoritario)}</span></h5>
    <p style="color: #b3b3b3;"><span>${element.nombreCliente}</span> ${element.fechaHora}</p>
    `
    lista2+=`*${element.nombre}*%0A
    *Cantidad x${parseInt(element.cantidad)} $${separator(element.cantidad*element.mayoritario)}*%0A
    ${element.nombre} ${element.fechaHora}%0A________________________________%0A`
});
lista2+=`*TOTAL: $${separator(total)}*%0A*ENTREGADO: $${separator(parseInt(params[0].credito))}*%0A*FALTA PAGAR: $${separator(total-params[0].credito)}*`
card=`
  <div class="col-12 mb-4 mt-2">

<!-- Card -->
<div class="card card-cascade wider">

<!-- Card image -->
<div class="view view-cascade gradient-card-header peach-gradient">

    <!-- Title -->
    <h2 class="card-header-title mb-3">Familia: ${params[0].nombreCliente}</h2>
    <!-- Text -->

</div>

<!-- Card content -->
<div class="card-body card-body-cascade text-center">
<!-- Text -->
    <div class="row">
      <div class="col">
        <h4 class="bold">CREDITO <span style="color:#4caf50;">$${separator(params[0].credito)}</span></h4>
      </div>
      <div class="col">
      <h4 class="bold">Falta pagar <span style="color:#4caf50;">$${separator(total-params[0].credito)}</span></h4>
      <h4 class="bold">TOTAL <span style="color:#4caf50;">$${separator(total)}</span></h4>
      </div>
    </div>
    
    <!-- Link -->
    <div class="row">
      <div class="col">
        <a data-dismiss="modal" class="red-text d-flex flex-row p-2">
          <h5 class="waves-effect waves-light"><i class="fas fa-angle-double-left ml-2"></i>Cerrar</h5>
        </a> 
      </div>
      <div class="col">
       <a href="imprimir.php" class="btn btn-success" target="_blank">PDF</a>
       <a class="btn btn-blue" target="_blank" href="https://wa.me//?text=${lista2}">WSAP</a>
      </div>
      <div class="col">
        <a onclick="abrirModalPagar('${params[0].nombreCliente}',${params[0].idCliente},'${separator(total-params[0].credito)}',${params[0].idLibreta})" class="green-text d-flex flex-row-reverse p-2">
          <h5 class="waves-effect waves-light">Pagar<i class="fas fa-angle-double-right ml-2"></i></h5>
        </a>
      </div>
    </div>
    
    <hr>
    ${lista}

    
    

</div>
<!-- Card content -->

</div>
<!-- Card -->

</div>
  `
}else{
  card=`
  <div class="col-12 text-center">
      <h4 style="background: #3183ba;color: white;border-radius: 5px;padding: 3%;box-shadow: 0px 0px 20px 0px #0000007a;">Todo esta al dia.</h4>
        <a data-dismiss="modal" class="red-text d-flex flex-row-reverse p-2">
          <h5 class="waves-effect waves-light">Cerrar<i class="fas fa-angle-double-right ml-2"></i></h5>
        </a>
  </div>
  `
}








  document.getElementById("libreta").innerHTML=card

}


function abrirModalPagar(nombreCliente,idCliente,totalApagar,idLibreta) {
  console.log(idCliente)
  document.getElementById("titulo").innerHTML=nombreCliente
  document.getElementById("idFamiliaLibreta").value=idCliente
  document.getElementById("idLibretaTabla").value=idLibreta
  document.getElementById("total").innerHTML=totalApagar
  $("#pagarLibreta").modal("show")
}
document.getElementById("formPagarLibreta").addEventListener("submit",async (e)=>{
  e.preventDefault()
  $("#pagarLibreta").modal("hide")
  let form=new FormData(document.getElementById("formPagarLibreta"))
  let usu=JSON.parse(localStorage.getItem("user"))
  document.getElementById("pagoCon").disabled=true
  document.getElementById("pagarLibre").disabled=true
  form.append("establecimiento",usu.establecimiento)
  form.append("idUsuario",usu.id)
  await fetch('php/pagarLibreta.php',{
    method:"POST",
    body:form,
  })
  .then((response) => response.json())
  .then(async (data) => {
    console.log(data)
    if (data=="perfecto") {
      guardarEnLocalStorage(document.getElementById("pagoCon").value)
      await traerLibreta(document.getElementById("idFamiliaLibreta").value)
      document.getElementById("pagoCon").disabled=false
      document.getElementById("pagarLibre").disabled=false
      document.getElementById("formPagarLibreta").reset()
      toastr.success('Libreta', 'Pago exitoso.')
    }else{
      alert(data)
    }
  });
})


async function verHistorial(id) {
  $("#historialModal").modal("show")
  await fetch('php/listarHistorial.php?id='+id)
  .then((response) => response.json())
  .then(async (data) => {
    console.log(data)
    await dibujarHistorial(data)
  });
}
async function dibujarHistorial(params) {
  let h4=``
  if (params.length<=0) {
    h4=`<h4>Sin historial</h4>`
  }else{
    params.forEach(element => {
      h4+=`<div class="${element.estado}">
            <div><span>${element.idLibreta}</span></div>
            <div style="display:flex;width: 90%;justify-content: space-between;">
              <div><span>${element.fecha}</span></div>
              <div><span>${element.estado}</span></div>
            </div>
          </div>`
    });
  }
  document.getElementById("listarHistorial").innerHTML=h4
}
function separator(numb) {
    
  var str = numb.toString().split(".");
  str[0] = str[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
  return str.join(".");
}
function guardarEnLocalStorage(numero) {
  // Obtén el valor actual de "pagoLibreta"
  let valorActual = localStorage.getItem("pagoLibreta");

  // Si "pagoLibreta" no existe en localStorage, lo inicializamos con el número
  if (valorActual === null) {
    localStorage.setItem("pagoLibreta", numero);
  } else {
    // Si "pagoLibreta" ya existe, sumamos el número al valor actual
    let nuevoValor = parseFloat(valorActual) + parseFloat(numero);
    localStorage.setItem("pagoLibreta", nuevoValor);
  }
}