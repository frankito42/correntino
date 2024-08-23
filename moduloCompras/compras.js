let divicion=0
function addNewProductFrom(id) {
    
    /* console.log((parseInt(id))) */
    
    fetch('traerArticulo.php?id='+id)
    .then(response => response.json())
    .then((data)=>{ 
      console.log(data)
        let tablaEscondida=document.getElementById("tablaEscondida").style.display="block"
        let tbody=document.getElementById("addProducto")
        let primerHijo=tbody.firstChild
        
        
 









        let tr=document.createElement('tr')
        
        for (let index = 0; index <= 6; index++) {
            let td=document.createElement('td')
            
            
            let nombre=document.createTextNode(data.nombre)
            if(index==0){
                /* let img=document.createElement('img')
                img.setAttribute("height", "80");
                img.setAttribute("width", "80")
                img.setAttribute("src", data.imagen.replace('../', ''))
                td.appendChild(img)
                tr.appendChild(td) */
            }else if(index==1){
                td.appendChild(nombre)
                tr.appendChild(td)
            }else if(index==2){
                /* CANTIDADDDDDDDDDDDDDDDDDDDDDDDDD */
                let inputCantidad=document.createElement('input')
                inputCantidad.className="form-control"
                inputCantidad.required=true
                inputCantidad.type="number"
                inputCantidad.step="0.01"
                inputCantidad.name="cantidad[]"
                td=document.createElement('td')
                td.appendChild(inputCantidad)
                tr.appendChild(td)
            }else if(index==3){
                /* COSTOOOOOOOOOOOOOOOOOOOOOO */
                let inputCosto=document.createElement('input')
                let inputFantasma=document.createElement('input')
                inputCosto.className="form-control"
                inputCosto.required=true
                inputCosto.type="number"
                inputCosto.step="0.01"
                inputCosto.name="costo[]"
                inputCosto.addEventListener("keyup",(e)=>{
                  sumaLocalIniciandoEnCosto(e.target)
                })
                inputCosto.value=data.costo
                inputFantasma.value=data.articulo
                inputFantasma.name="idArticulo[]"
                inputFantasma.style.display="none"
               
              
           

                tr.style.position="relative"
                td=document.createElement('td')
                td.appendChild(inputFantasma)
                td.appendChild(inputCosto)
                tr.appendChild(td)
                
            }else if(index==4){
              let diva=document.createElement("div")
              diva.className="input-group"
              let input2=document.createElement('input')
              input2.type = "text";
              input2.step="0.01"
              input2.style="text-align: center;"
              input2.name = "precioventa[]";
              input2.className = "form-control";
              input2.addEventListener("keyup",(e)=>{
                ponerPorcentajeMayorReversa(e.target)
              })
              
              let input=document.createElement('input')
                input.className="form-control"
                input.required=true
                input.name="meno[]"
                input.style.width="20%"
                input.type="number"
                input.step="0.01"
                input.style="text-align: center;"
                input.value=data.menorCentaje
                input.addEventListener("keyup",(e)=>{
                  sumaLocalIniciandoEnPorcentaje(e.target)
                })
                


                td=document.createElement('td')
                tr.appendChild(td)
                diva.appendChild(input)
                let p=document.createElement("h3")
                p.innerHTML="$"
                diva.appendChild(p)
                diva.appendChild(input2)
                td.appendChild(diva)
                let divGanancia=document.createElement("div")
                divGanancia.className="md-form"
                let inputGanancia=document.createElement("input")
                inputGanancia.className="form-control"
                inputGanancia.disabled=true
                inputGanancia.step="0.01" 
                inputGanancia.id="meno"+data.articulo
                let labelGanancia=document.createElement("label")
                labelGanancia.className="active"
                labelGanancia.innerHTML="Ganancia"

                divGanancia.appendChild(inputGanancia)
                divGanancia.appendChild(labelGanancia)
                td.appendChild(divGanancia)
                sumaLocalIniciandoEnPorcentaje(input)
               /*  let div=`
              
                <label style="max-width: max-content;" for="meno${data.articulo}" class="active">Ganancia</label>
                <span style="z-index: 9999;position: absolute;top: -200%;background: #5cd1ff99;padding: 2%;border-radius: 5px;color: #ff023d;">%</span>
                
                `
                td.innerHTML+=div */
                /* el primer input es el de porcentaje */
                /* diva.insertBefore(input,input2); */
            }else if(index==5){
                let vence = document.createElement("input");
                vence.type = "date";
                vence.name = "vence[]";
           
                td=document.createElement('td')
                tr.appendChild(td)
                td.appendChild(vence) 
            }else if(index==6){
              let boton=document.createElement('a')
              boton.className="btn btn-sm btn-primary borrar"
              boton.innerText="x"
              td.appendChild(boton)
              tr.appendChild(td)
          }

        }

        tbody.insertBefore(tr, primerHijo);
        
        let borrar=document.getElementsByClassName("borrar")

    
/* CAMBIAR ESTO POR UNA FUNCION CON THIS PARA ELIMINAR  */
        borrar.forEach(element => {
         
          element.addEventListener("click",(e)=>{
                console.log(e.target.parentNode.parentNode.parentNode)
                console.log(e.target.parentNode.parentNode)
                e.target.parentNode.parentNode.parentNode.removeChild(e.target.parentNode.parentNode)
                if (tbody.childElementCount==0) {
                    document.getElementById("tablaEscondida").style.display="none"
                }
            })
    });

   /*  sumarTodoTodito() */
    
    });



    
    




  
}


// Material Select Initialization
$(document).ready(function() {
     document.getElementById("codActForm").addEventListener("submit",(e)=>{
    e.preventDefault()
    
    let codigo=document.getElementById('codigoBAc').value

     fetch('traerArticuloCodigo.php?cod='+codigo)
    .then(response => response.json())
    .then((data)=>{ 
      console.log(data)
        if(data==false){
            alert("El producto no extiste.")
            document.getElementById("codActForm").reset()
            document.getElementById('codigoBAc').focus()
        }else{
            
            let tablaEscondida=document.getElementById("tablaEscondida").style.display="block"
        let tbody=document.getElementById("addProducto")
        let primerHijo=tbody.firstChild
        
        
 









        let tr=document.createElement('tr')
        
        for (let index = 0; index <= 6; index++) {
            let td=document.createElement('td')
            
            
            let nombre=document.createTextNode(data.nombre)
            if(index==0){
                /* let img=document.createElement('img')
                img.setAttribute("height", "80");
                img.setAttribute("width", "80")
                img.setAttribute("src", data.imagen.replace('../', ''))
                td.appendChild(img)
                tr.appendChild(td) */
            }else if(index==1){
                td.appendChild(nombre)
                tr.appendChild(td)
            }else if(index==2){
                /* CANTIDADDDDDDDDDDDDDDDDDDDDDDDDD */
                let inputCantidad=document.createElement('input')
                inputCantidad.className="form-control"
                inputCantidad.required=true
                inputCantidad.type="number"
                inputCantidad.step="0.01"
                inputCantidad.name="cantidad[]"
                td=document.createElement('td')
                td.appendChild(inputCantidad)
                tr.appendChild(td)
            }else if(index==3){
                /* COSTOOOOOOOOOOOOOOOOOOOOOO */
                let inputCosto=document.createElement('input')
                let inputFantasma=document.createElement('input')
                inputCosto.className="form-control"
                inputCosto.required=true
                inputCosto.type="number"
                inputCosto.step="0.01"
                inputCosto.name="costo[]"
                inputCosto.addEventListener("keyup",(e)=>{
                  sumaLocalIniciandoEnCosto(e.target)
                })
                inputCosto.value=data.costo
                inputFantasma.value=data.articulo
                inputFantasma.name="idArticulo[]"
                inputFantasma.style.display="none"
               
              
           

                tr.style.position="relative"
                td=document.createElement('td')
                td.appendChild(inputFantasma)
                td.appendChild(inputCosto)
                tr.appendChild(td)
                
            }else if(index==4){
              let diva=document.createElement("div")
              diva.className="input-group"
              let input2=document.createElement('input')
              input2.type = "text";
              input2.step="0.01"
              input2.style="text-align: center;"
              input2.name = "precioventa[]";
              input2.className = "form-control";
              input2.addEventListener("keyup",(e)=>{
                ponerPorcentajeMayorReversa(e.target)
              })
              
              let input=document.createElement('input')
                input.className="form-control"
                input.required=true
                input.name="meno[]"
                input.style.width="20%"
                input.type="number"
                input.step="0.01"
                input.style="text-align: center;"
                input.value=data.menorCentaje
                input.addEventListener("keyup",(e)=>{
                  sumaLocalIniciandoEnPorcentaje(e.target)
                })
                


                td=document.createElement('td')
                tr.appendChild(td)
                diva.appendChild(input)
                let p=document.createElement("h3")
                p.innerHTML="$"
                diva.appendChild(p)
                diva.appendChild(input2)
                td.appendChild(diva)
                let divGanancia=document.createElement("div")
                divGanancia.className="md-form"
                let inputGanancia=document.createElement("input")
                inputGanancia.className="form-control"
                inputGanancia.disabled=true
                inputGanancia.step="0.01" 
                inputGanancia.id="meno"+data.articulo
                let labelGanancia=document.createElement("label")
                labelGanancia.className="active"
                labelGanancia.innerHTML="Ganancia"

                divGanancia.appendChild(inputGanancia)
                divGanancia.appendChild(labelGanancia)
                td.appendChild(divGanancia)
                sumaLocalIniciandoEnPorcentaje(input)
               /*  let div=`
              
                <label style="max-width: max-content;" for="meno${data.articulo}" class="active">Ganancia</label>
                <span style="z-index: 9999;position: absolute;top: -200%;background: #5cd1ff99;padding: 2%;border-radius: 5px;color: #ff023d;">%</span>
                
                `
                td.innerHTML+=div */
                /* el primer input es el de porcentaje */
                /* diva.insertBefore(input,input2); */
            }else if(index==5){
              let vence = document.createElement("input");
                vence.type = "date";
                vence.name = "vence[]";
           
                td=document.createElement('td')
                tr.appendChild(td)
                td.appendChild(vence) 
            }else if(index==6){
              let boton=document.createElement('a')
              boton.className="btn btn-sm btn-primary borrar"
              boton.innerText="x"
              td.appendChild(boton)
              tr.appendChild(td)
          }

        }

        tbody.insertBefore(tr, primerHijo);
        
        let borrar=document.getElementsByClassName("borrar")

    
/* CAMBIAR ESTO POR UNA FUNCION CON THIS PARA ELIMINAR  */
        borrar.forEach(element => {
         
          element.addEventListener("click",(e)=>{
                console.log(e.target.parentNode.parentNode.parentNode)
                console.log(e.target.parentNode.parentNode)
                e.target.parentNode.parentNode.parentNode.removeChild(e.target.parentNode.parentNode)
                if (tbody.childElementCount==0) {
                    document.getElementById("tablaEscondida").style.display="none"
                }
            })
    });
    
    document.getElementById("codActForm").reset()
            document.getElementById('codigoBAc').focus()
    
    
    
        }

   /*  sumarTodoTodito() */
    
    });
    
    
    
    
    
    
    
    
    
    
    
    
})
  $('.mdb-select').materialSelect();
  console.log($(this))
  /* SOY EL MEJOR LPM */
  document.getElementsByClassName("dropdown-content select-dropdown").forEach((element)=>{
    
    element.parentElement.childNodes[1].addEventListener("click",()=>{
      element.children[0].children[0].children[0].focus()
    })

  })
  

});




/* console.log(document.getElementsByClassName('search w-100').autofocus) */
 


function abrirModalBorrar(id,fecha,factura,observacion) {


  if (document.getElementById("modal"+id)) {
    $("#modal"+id).modal("show")
  }else{
    let modal=`<div id="modal${id}" class="modal fade right" id="exampleModalPreview" tabindex="-1" role="dialog" aria-labelledby="exampleModalPreviewLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div style="background: #dee2e6;" class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalPreviewLabel">Compra ${fecha} N° factura ${factura}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Si elimina la factura, se restaran la cantidad de todos los articulos ingresados.<br>
          ${observacion}
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-blue" data-dismiss="modal">Cerrar</button>
          <button type="button" onclick="borrar(${id})" class="btn btn-danger">Confirmar borrado</button>
        </div>
      </div>
    </div>
  </div>
  `;
  $(modal).modal("show")
}
console.log(id)
    
    
}

function borrar(id) {
  $("#modal"+id).modal('hide')
   
  fetch('borrarEntradaCompleta.php?idEntrada='+id)
  .then(response => response.json())
  .then((data) => {
    /* console.log(data) */
    
    
    if(data=="ok"){

      $('#entrada'+id).addClass('animated bounceOutLeft');

      $('#entrada'+id).one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', ()=>{
        document.getElementById("entrada"+id).remove()
      });
    }else{
      alert("Error comunicar a pancho.")
    }
  });    
}


function abrirModalBorrarDetalle(id,cantidad,idArticulo,nombre) {
  /* console.log(id)
  console.log(idEntrada)
  console.log(cantidad)
  console.log(idArticulo) */

  if (document.getElementById("modalDetalle"+id)) {
    $("#modalDetalle"+id).modal("show")
  }else{
    let modal=`<div id="modalDetalle${id}" class="modal fade right" id="exampleModalPreview" tabindex="-1" role="dialog" aria-labelledby="exampleModalPreviewLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div style="background: #dee2e6;" class="modal-content">
      <div style="background: #ff3547;color: white;" class="modal-header">
        <h5 class="modal-title" id="exampleModalPreviewLabel">${nombre}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Al elminar el producto de la factura, se descontara la cantidad de ${cantidad} unidades automaticamnete.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-blue" data-dismiss="modal">Cerrar</button>
        <button type="button" onclick="borrarDetalle(${id},${cantidad},${idArticulo})" class="btn btn-danger">Confirmar borrado</button>
      </div>
    </div>
  </div>
</div>
`;
$(modal).modal("show")
  }
  
/* console.log(id) */
  
}

function borrarDetalle(id,cantidad,idArticulo) {
  $("#modalDetalle"+id).modal('hide')
   
  fetch('borrarEntradaProducto.php?id='+id+'&cantidad='+cantidad+'&idArticulo='+idArticulo)
  .then(response => response.json())
  .then((data) => {
    /* console.log(data) */
    
    
    if(data=="ok"){

      $('#entradaDetalle'+id).addClass('animated bounceOutLeft');

      $('#entradaDetalle'+id).one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', ()=>{
        document.getElementById("entradaDetalle"+id).remove()
      });
    }else{
      alert("Error comunicar a pancho.")
    }
  });    
}

function tomarId(id,idForm,canti) {
  /* console.log(id) */
  document.getElementById("formularioId"+idForm).value=id
  alert("Al cambiar el producto se inabilita la cantidad y toma la cantidad de "+canti+" para descontar y sumar al nuevo articulo seleccionado.")
  document.getElementById("cantidadNo"+idForm).style.display="none"
}
function tomarId2(id) {
  console.log(id)
  document.getElementById("idDelArticuloSelect").value=id
  
}



function sumarTodoTodito() {
  let todosLosTrProductos=document.querySelectorAll("#addProducto")
  let costoBruto=0
  let minoriTotal=0
  let mayoriTotal=0
  let p1
  let p2
  let input1=0
  let input2=0
  let transpo
  todosLosTrProductos[0].children.forEach(element => {
    /* costo mas el porcentaje de minoritario */

    transpo=parseFloat((element.children[2].children[2].value=="")?0:element.children[2].children[2].value)
    costoBruto=parseFloat((element.children[2].children[1].value=="")?0:element.children[2].children[1].value)+transpo
    minoriTotal=costoBruto*parseFloat((element.children[3].children[0].value=="")?0:element.children[3].children[0].value)/100+costoBruto
    /* mayoriTotal=costoBruto*parseFloat((element.children[4].children[0].value=="")?0:element.children[4].children[0].value)/100+costoBruto */
    /* costo mas el porcentaje de mayoritario */
    /* costo2=element.children[2].children[1].value* */
    /* console.log(element.children[2].children[1]) */
    p1=element.children[3].children[1].innerHTML="$"+separator(minoriTotal.toFixed(2))
    /* p2=element.children[4].children[1].innerHTML="$"+(mayoriTotal.toFixed(2)) */
    input1=element.children[3].children[2].children[0].value=separator((minoriTotal-costoBruto).toFixed(2))
   /*  input2=element.children[4].children[2].children[0].value=(mayoriTotal-costoBruto).toFixed(2) */

    /* PRECIO DE VENTA MINORITARIO TOTAL */
    element.children[3].children[3].value = separator(minoriTotal.toFixed(2));
    /* PRECIO DE VENTA mayoritario TOTAL */
    /* element.children[4].children[3].value = mayoriTotal.toFixed(2); */

    /* console.log(element.children[2].children[2].value) */
  /*   console.log(element.children[4].children[3])
    console.log(costoBruto)
    console.log(minoriTotal)
    console.log(mayoriTotal) */

  });
}


function separator(numb) {
  console.log(numb)
  var str = numb.toString().split(".");
  str[0] = str[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
  return str.join(".");
}
function separatorthis(numb) {
  console.log(numb.value)
  let numeroSinComas=numb.value.replace(/,/g, "");
  console.log(numeroSinComas)
  var str = numeroSinComas.toString().split(".");
  str[0] = str[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
  numb.value=str.join(".");
}
function sumaLocalIniciandoEnCosto(e) { 
  console.log(e.parentElement.parentElement.children[3].children[1].children[0])
  let costo=parseFloat(e.value)
  let porcentajeCapo=e.parentElement.parentElement.children[3].children[0].children[0].value
  /* let precioVenta=e.parentElement.parentElement.children[3].children[0].children[2].value */
 
  
  let precioVenta=((costo*parseFloat(porcentajeCapo))/100)+parseFloat(costo)
  /* PRECIO DE VENTA */
  e.parentElement.parentElement.children[3].children[0].children[2].value=(isNaN(precioVenta))?0:Math.ceil(precioVenta/10)*10
  /* GANANCIA */
  e.parentElement.parentElement.children[3].children[1].children[0].value=(isNaN((precioVenta-parseFloat(costo)).toFixed(2)))?0:((Math.ceil(precioVenta/10)*10)-parseFloat(costo)).toFixed(2)
  console.log("precio venta "+precioVenta)
}


 

function sumaLocalIniciandoEnPorcentaje(e) { 
  console.log(e.parentElement.parentElement.parentElement.children[2].children[1].value)
  let costo=parseFloat(e.parentElement.parentElement.parentElement.children[2].children[1].value)
  let porcentajeCapo=e.value
  /* let precioVenta=e.parentElement.parentElement.children[3].children[0].children[2].value */

  let precioVenta=((costo*parseFloat(porcentajeCapo))/100)+parseFloat(costo)
  /* PRECIO DE VENTA */
  e.parentElement.parentElement.parentElement.children[3].children[0].children[2].value=(isNaN(precioVenta))?0:Math.ceil(precioVenta/10)*10
  /* GANANCIA */
  e.parentElement.parentElement.parentElement.children[3].children[1].children[0].value=(isNaN((precioVenta-parseFloat(costo)).toFixed(2)))?0:((Math.ceil(precioVenta/10)*10)-parseFloat(costo)).toFixed(2)
  console.log("precio venta "+precioVenta)
}

function ponerPorcentajeMayorReversa(e){
  let precioMayor=parseFloat(e.value)
  let porcentaje=e.parentElement.parentElement.children[0].children[0]
  let costo=parseFloat(e.parentElement.parentElement.parentElement.children[2].children[1].value)
  let ganancia=e.parentElement.parentElement.children[1].children[0]
  /* console.log(precioMayor)
  console.log(porcentaje) */
  let ecuacion=(((precioMayor-costo)*100)/costo).toFixed(2)
  porcentaje.value=ecuacion
  ganancia.value=(isNaN((precioMayor-costo).toFixed(2)))?0:(precioMayor-costo).toFixed(2)
}

document.getElementById("pagarFactura").addEventListener("submit",(e)=>{
  e.preventDefault()
  let formdata=new FormData(document.getElementById("pagarFactura"))
  formdata.append("eg",localStorage.getItem("totalFacturaP"))
  fetch('pagarFactura.php',{
    method:"post",
    body:formdata
  })
  .then(response => response.json())
  .then((data) => {
    console.log(data)
    location.reload()
  });
})
function abrirModalPagarFactura(idFactura,total) {
  console.log(idFactura)
  document.getElementById("idFactura").value=idFactura
  localStorage.setItem("totalFacturaP",total)
  document.getElementById("TOTALaPagar").innerHTML="Tota a pagar: $"+total
  $("#centralModalSuccess").modal("show")
}