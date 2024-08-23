let todosLosArticulosCategorias
let articulosDb
let provedores
let categorias

function cargando(){
        document.getElementById("articulosTabla").innerHTML="<tr><td colspan='8'><h3 class='text-center'>Cargando...</h3></td></tr>"
}
async function listarArticulos() {
    let esta=JSON.parse(localStorage.getItem("user")).establecimiento
  await fetch('php/listarArticulos.php?establecimiento='+esta)
  .then(response => response.json())
  .then(async (data)=>{
    console.log(data)
      
    return articulosDb=data
  });
    
}
async function listarProveedores() {
  await fetch('php/listarProveedores.php')
  .then(response => response.json())
  .then(async (data)=>{
    console.log(data)
    provedores=data
    let option=`<option value="" selected disabled>Seleccionar proveedor</option>`
    data.forEach(element => {
      option+=`<option value="${element.idProveedor}">${element.nombreP}</option>`
    });
    document.getElementById("selectProvedorAumentar").innerHTML=option
  });
    
}

async function listarCategorias() {
  await fetch('php/listarCategorias.php')
  .then(response => response.json())
  .then(async (data)=>{
    console.log(data)
    categorias=data
    let option=`<option value="" selected disabled>Seleccionar Categoria</option>`
    data.forEach(element => {
      option+=`<option value="${element.idCategoria}">${element.nombreCategoria}</option>`
    });
    /* document.getElementById("selectLaboratorioAumentar").innerHTML=option */
    document.getElementById("selectLaboratorioAumentar").innerHTML=option
  });
    
}

async function subirPorcentajeEnPreciosProveedor() {
  let porcentaje=document.getElementById("porcentajeFiltro").value
  let proveedor=document.getElementById("selectProvedorAumentar").value
  if(proveedor&&porcentaje){
    await fetch("php/aumentarPrecio.php?porcentaje="+porcentaje+"&idPro="+proveedor)
          .then(respuesta => {
                $("#modalPorcentaje").modal("hide")
                listarArticulos().then(async()=>{
                  await traerPoductoGalpon(document.getElementById("establecimientos").value)
                })
             }
          );
  }else{
    if(!porcentaje){
      document.getElementById("porcentajeFiltro").style.borderColor="red"
    }
    if(!proveedor){
      document.getElementById("selectProvedorAumentar").style.borderColor="red"
    }
  }
  
}
document.getElementById("porcentajeFiltro").addEventListener("click",()=>{
  document.getElementById("porcentajeFiltro").style.borderColor=""
})
document.getElementById("selectProvedorAumentar").addEventListener("click",()=>{
  document.getElementById("selectProvedorAumentar").style.borderColor=""
})




/* console.log(todosLosArticulosCategorias) */


$(document).ready(async function(){
    
    document.getElementById("codActForm").addEventListener("submit",(e)=>{
    e.preventDefault()
    
    let codigo=document.getElementById('codigoBAc').value

    let pro=articulosDb

    pro= pro.find((m) => m.codBarra == codigo);
    console.log(pro)
    
    if(pro!=undefined){
        let tablaEscondida=document.getElementById("tablaEscondida").style.display="block"
        let tbody=document.getElementById("addProducto")
        let primerHijo=tbody.firstChild
        
        
 
        let proveedor=``
              provedores.forEach(element => {
                proveedor+=`
                <option ${(element.idProveedor==pro.idProveedor)?"selected":""} value="${element.idProveedor}">${element.nombreP}</option>
                `
              });


    





        let tr=document.createElement('tr')
        
        for (let index = 0; index <= 6; index++) {
            let td=document.createElement('td')
            
            
            let nombre=document.createTextNode(pro.nombre)
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
                inputCantidad.type="number"
                inputCantidad.step="0.01"
                inputCantidad.name="cantidad[]"
                td=document.createElement('td')
                td.style.display="none"
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
                inputCosto.value=pro.costo
                inputFantasma.value=pro.articulo
                inputFantasma.name="idArticulo[]"
                inputFantasma.style.display="none"
               
              
              
              
              let select=document.createElement('select')
                select.innerHTML=proveedor
                select.name="prove[]"
                select.classList.add("form-control")
              
              
              
              
           

                tr.style.position="relative"
                td=document.createElement('td')
                td.appendChild(inputFantasma)
                td.appendChild(inputCosto)
                td.appendChild(select)
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
                input.value=pro.menorCentaje
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
                inputGanancia.id="meno"+pro.articulo
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
               /*  let input2 = document.createElement("input");
                input2.type = "number";
                input2.step="0.01"
                input2.name = "preciomayor[]";
                input2.onkeyup = sumarTodoTodito;
                input2.style.display = "none";
                
                
                
                let input3 = document.createElement("input");
                input3.className="form-control"
                input3.required=true
                input3.name="mayo[]"
                input3.type = "number";
                input3.step="0.01"
                input3.style.width="44%"
                input3.style.display="inline"
                input3.style.marginRight="2%"
                input3.value=data.mayorCentaje
                input3.onkeyup = sumarTodoTodito;
                td=document.createElement('td')
                
                tr.appendChild(td)

                let p = document.createElement("p");
                p.innerText = "$0";
                p.style.color = "rgb(0 206 84 / 97%)";
                p.style.fontSize = "130%";
                p.style.background = "#ffc4f2";
                p.style.borderRadius = "5px";
                p.style.padding = "1%";
                p.style.display = "inline";
                td.appendChild(p)
                let div=`
                <div class="md-form">
                <input type="number" step="0.01" disabled class="form-control" id="mayo${data.articulo}">
                <label style="max-width: max-content;" for="mayo${data.articulo}" class="active">Ganancia por mayor</label>
                <span style="position: absolute;top: -190%;background: #5cd1ff99;padding: 2%;border-radius: 5px;color: #ff023d;">%</span>
                </div>
                `
                td.innerHTML+=div
                td.insertBefore(input3,td.firstChild);
                td.appendChild(input2) */
            }else if(index==6){
              let boton=document.createElement('a')
              boton.className="btn btn-sm btn-primary borrar"
              boton.innerText="x"
              td.appendChild(boton)
              tr.appendChild(td)
          }

        }

        tbody.insertBefore(tr, primerHijo);
        
        document.getElementById('codActForm').reset()
        document.getElementById('codigoBAc').focus()
        
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
    }else{
        
        alert("El producto no existe")
        document.getElementById('codActForm').reset()
        document.getElementById('codigoBAc').focus()
    }
    
    
    
    
    
    
    
    
    
    
    
    
})
  $("#filtroProductos").keyup(function(){
  _this = this;
  // Show only matching TR, hide rest of them
  $.each($("#mytable tbody tr"), function() {
  if($(this).text().toLowerCase().indexOf($(_this).val().toLowerCase()) === -1)
  $(this).hide();
  else
  $(this).show();
  });
  });


  
 /*  console.log(document.getElementsByClassName("dropdown-content select-dropdown")) */
    cargando()
    await listarProveedores()
    await listarCategorias()
    await dibujarCategorias(categorias)
    await listarArticulos().then(async()=>{
    await dibujarTabla(articulosDb)
    dibujarSelectMdb(articulosDb)
    
    $('.mdb-select').materialSelect();
  })
  document.getElementsByClassName("dropdown-content select-dropdown").forEach((element)=>{
    console.log(element.parentElement.childNodes[1])
    element.parentElement.childNodes[1].addEventListener("click",()=>{
      element.children[0].children[0].children[0].focus()
      console.log("hola")
    })

  })
  
  

  
});


 async function abrirModalEdit(id) {
  let filtroArray= articulosDb.find((m) => parseInt(m.articulo) === parseInt(id));
  console.log("Es: " + filtroArray.nombre );
  
  /* creo el select de categorias en el modal editar */

    if(document.getElementById(`articulo${id}`)){
      /* borro el modal y vulevo a llamar a la funcion para crear uno nuevo */
      document.getElementById(`articulo${id}`).remove()
      abrirModalEdit(id)
    }else{
      let optionsCategoria=``
      categorias.forEach(element => {
        optionsCategoria+=`
        <option ${(element.idCategoria==filtroArray.categoria)?"selected":""} value="${element.idCategoria}">${element.nombreCategoria}</option>
        `
      });

      let proveedor=``
      provedores.forEach(element => {
        proveedor+=`
        <option ${(element.idProveedor==filtroArray.idProveedor)?"selected":""} value="${element.idProveedor}">${element.nombreP}</option>
        `
      });
     
      let descuento=""
      
      //aqui si el chec esta activado o no
      if(filtroArray.descuento=="si"){
          descuento="checked"
      }
      
      let modalEdit=`
                <div class="modal fade" id="articulo${id}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div style="background:#33b5e5;" class="modal-header text-white">
                          <h4 class="modal-title heading lead" id="myModalLabel">Editar un producto</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span style="color: white;" aria-hidden="true">&times;</span>
                      </button>
                            
                        </div>
                        <div class="modal-body">
                  <div class="container-fluid">
                  <form enctype="multipart/form-data">
                    <div class="row">
                        <div style="text-align: center;background: #ccfaff;padding: 1%;border-radius: 5px;color: #2093aa;font-weight: bold;" class="col-12">
                            <span>${(filtroArray.modifPrecio)?'ultima modificacion de precio '+filtroArray.modifPrecio: 'Sin fecha de ultima modificacion'}</span>
                        </div>
                      <div class="col">
                        <div class="md-form">
                            <input required type="text" id="nombreEdit${id}" value="${filtroArray.nombre}" name="nombreEdit" class="form-control">
                            <label for="nombreEdit${id}" class="active">Nombre del articulo</label>
                        </div>
                      </div>
                        <div class="col">
                          <div class="md-form">
                              <input type="text" id="codBarraEdit${id}" name="codBarraEdit" value="${filtroArray.codBarra}" class="form-control">
                              <label for="codBarraEdit${id}" class="active">Codigo de barra</label>
                          </div>
                        </div>
                    </div>
                    

                      <div class="row">
                        <div class="col">
                          <div class="md-form">
                            <input required type="number" id="stockminEdit${id}" value="${filtroArray.stockmin}" name="stockminEdit" class="form-control">
                            <label for="stockminEdit${id}" class="active">Stock minino</label>
                          </div>
                        </div>
                        <div class="col">
                          <div class="md-form">
                            <input type="number" id="cantidadEdit${id}" value="${filtroArray.cantidad}" name="cantidad" class="form-control">
                            <label for="cantidadEdit${id}" class="active">Cantidad</label>
                          </div>
                        </div>
                      </div>
                      


                      <div class="md-form">
                              <input required type="text" id="porcentaje${id}" onkeyup="ventaPorcentajeCosto(${id})" value="${(filtroArray.menorCentaje)?filtroArray.menorCentaje:0}" name="porcentaje" class="form-control">
                              <label for="porcentaje${id}" class="active">Porcentaje</label>
                        </div>


                    <div class="form-group">
                        <div class="row">
                          <div class="col">
                            <div class="md-form">
                              <input required type="text" id="costoArticuloEdit${id}" onkeyup="separatorthis(this)" value="${separator(filtroArray.costo)}" name="costoArticulo" class="form-control">
                              <label for="costoArticuloEdit${id}" class="active">Costo</label>
                            </div>
                          </div>
                          <div style="display:none;" class="col">
                            <div class="md-form">
                              <input type="text" id="precioArticuloEdit${id}" onkeyup="separatorthis(this)" value="${separator(filtroArray.precioVenta)}" name="precioArticulo" class="form-control">
                              <label for="precioArticuloEdit${id}" class="active">Peso</label>
                            </div>
                          </div>
                          <div class="col">
                            <div class="md-form">
                              <input type="text"  id="precioMayo${id}" onkeyup="separatorthis(this),ventaPorcentajeCosto(${id})" value="${separator(filtroArray.mayoritario)}" name="precioArticulo" class="form-control">
                              <label for="precioMayo${id}" class="active">Precio de venta</label>
                            </div>
                          </div>
                        </div>
                    </div>
                    
                    <div class="row">
                  
                    <div class="col">
                        <select id="selectCategoriaEdit${id}" required class="form-control">
                        <option value="">Categoria</option>
                        ${optionsCategoria}
                        
                        </select>
                    </div>
                    <div class="col">
                        <select id="selectProve${id}" required class="form-control">
                        <option value="">Proveedor</option>
                        ${proveedor}
                        
                        </select>
                    </div>
                    
                  
                    
                    </div>
                    <div class="row">
                        <div style="font-size: 150%;text-align: center;background: #ccfaff;margin-top: 2%;color: #2093aa;border-radius: 5px;" class="col">
                            <input type="checkbox" id="descuento${id}" name="descuento" value="si" ${descuento}>
                            <label for="descuento">Descuento </label>
                        </div>
                    </div>
                        </div> 
                  </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal"><span class="fa fa-close"></span> Cancelar</button>
                            <button onclick="guardarEditArticulo(${id})" name="add" class="btn btn-primary"><span class="fa fa-save"></span> Guardar</a>
                  </form>
                        </div>

                    </div>
                </div>
              </div>`
  
              $(modalEdit).modal("show")
    }
   
 }



 async function dibujarTabla(articulosStock) {
  let tablaArticulos=``
  let imagen=``
  console.log(articulosStock)
  document.getElementById("totalProductos").innerHTML=articulosStock.length
  articulosStock.forEach(element => {
    imagen=`<img style="width: 100%;" src="${element['imagen']}">`
    /* <td>${element['costo']}</td>
    <td>${element['descripcion']}</td>
    <td>${element['diasPaVencer']} Dias</td>
    <td>${element['nombreEsta']}</td>
    */
    /* if(element['diasPaVencer']<60){
      tablaArticulos+=`
      <tr style="background: #ff000030;">
      <td>${element['nombre']}</td>
      <td>${element['costo']}</td>
      <td>${element['precioVenta']}</td>
      <td>${element['mayoritario']}</td>
      <td>${element['cantidad']}</td>
      <td>${element['nombreCategoria']}</td>
      <td>${imagen}</td>
      
      
      
      <td style="display: inherit;">
      <button onclick="abrirModalEdit(${element['articulo']})" class="btn btn-blue"><i class="fas fa-pencil-alt fa-2x"></i></button>
      <button onclick="deleteProduct(${element['articulo']},this)" class="btn btn-danger"><i class="fas fa-trash-alt fa-2x"></i></button>
      </td>
      </tr>
      `
    }else{ */
      tablaArticulos+=`
      <tr id="tr${element['articulo']}" style="${(parseInt(element['cantidad'])<=parseInt(element['stockmin']))?"background:#ffaaaa;":""};">
      <td>${element['nombre']}</td>
      <td>${separator(element['costo'])}</td>
      <td>${separator(element['mayoritario'])}</td>
      <td>${element['cantidad']}</td>
      <td>${element['codBarra']}</td>
      
      <td style="display: inherit;">
      <button onclick="abrirModalEdit(${element['articulo']})" class="btn btn-blue"><i class="fas fa-pencil-alt fa-2x"></i></button>
      <button onclick="deleteProduct(${element['articulo']},this)" class="btn btn-danger"><i class="fas fa-trash-alt fa-2x"></i></button>
      </td>
      </tr>
      `
   /*  } */
   
  });
  document.getElementById("articulosTabla").innerHTML=tablaArticulos
 }

 async function dibujarSelect(options) {
  let dibujarOptions=`<option disabled value="" selected>Establecimiento</option>
                      <option value="">Todos los articulos</option>`
  options.forEach(element => {
    
  
    dibujarOptions+=`
    <option value="${element.idEsta}">${element.nombreEsta}</option>
    `
  });
  /* SELECT DE TODOS LOS ESTABLECIMIENTOS */
  document.getElementById("establecimientos").innerHTML=dibujarOptions

  /* SELECT DEL MODAL AÃ‘ADIR NUEVO PRODUCTO *//* SELECT DEL MODAL AÃ‘ADIR NUEVO PRODUCTO */
  document.getElementById("newArticuloEnEstablecimiento").innerHTML=dibujarOptions
  /* REMUEVO LA OPCION TODOS LOS ARTICULOS */
  document.getElementById("newArticuloEnEstablecimiento").children[1].remove()

  

  document.getElementById("establecimientos").addEventListener("change",()=>{
    traerPoductoGalpon(document.getElementById("establecimientos").value)
  })
 }
 async function dibujarCategorias(categorias) {
  let dibujarCategorias=`<option value="" disabled selected>Categorias</option>`
  categorias.forEach(element => {
    
  
    dibujarCategorias+=`
    <option value="${element.idCategoria}">${element.nombreCategoria}</option>
    `
  });
  document.getElementById("categoriaNew").innerHTML=dibujarCategorias
 }

 async function traerPoductoGalpon(id) {
     cargando()
  let esta=JSON.parse(localStorage.getItem("user")).establecimiento
  await fetch('php/listarArticulos.php?id='+id+'&establecimiento='+esta)
  .then(response => response.json())
  .then(async (data)=>{
    console.log(data)
    await dibujarTabla(data[1])

    return articulosDb=data
  });
   
 }

 /* //////////////////////////////////////////////////////////////////////////////////// */
 /* //////////////////////////////////////////////////////////////////////////////////// */
 document.getElementById("guardarEstablecimiento").addEventListener("click",()=>{
   let nombreEsta=document.getElementById("nombreEstablecimiento").value
   if(nombreEsta==""){
     console.log(nombreEsta)
     document.getElementById("nombreEstablecimiento").style.borderColor="red";
     document.getElementById("labelIdEstablecimineto").style.color="red";
     document.getElementById("errorEstablecimiento").classList.add("zoomIn")
     document.getElementById("errorEstablecimiento").style.display="block"
     $('#errorEstablecimiento').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', ()=>{
       document.getElementById("errorEstablecimiento").classList.remove("zoomIn")
    });
   }else{
     fetch('php/addEstablecimiento.php?nEstablecimineto='+nombreEsta)
      .then(response => response.json())
      .then(async (data)=>{
        if(data=="perfecto"){
          listarArticulos().then(async()=>{
            await dibujarSelect(todosLosArticulosCategorias[2])
            vaciarEstablecimiento()
            $("#modalNewEstablecimiento").modal("hide")
          })
        }
      });
   }
 })
 document.getElementById("nombreEstablecimiento").addEventListener("click",()=>{
   if(document.getElementById("nombreEstablecimiento").style.borderColor=="red"){
      document.getElementById("nombreEstablecimiento").style.borderColor="";
      document.getElementById("labelIdEstablecimineto").style.color="";
      document.getElementById("errorEstablecimiento").classList.add("zoomOut")
      $('#errorEstablecimiento').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', ()=>{
        document.getElementById("errorEstablecimiento").classList.remove("zoomOut")
        document.getElementById("errorEstablecimiento").style.display="none"
    });
  }
 })
  /* //////////////////////////////////////////////////////////////////////////////////// */
 /* //////////////////////////////////////////////////////////////////////////////////// */
 document.getElementById("form").addEventListener("submit",async(e)=>{
      e.preventDefault()
      $("#addnew").modal("hide")
      toastr.warning("Guardando nuevo articulo...")
      let form=new FormData(document.getElementById("form"))
      await fetch('php/comprobarcode.php',{
        body:form,
        method:"POST",
      })
  .then((response) => response.json())
  .then(async (data) => {
    console.log(data)
    

    if (data=="") {
        cargando()
      
      let formData = new FormData(document.getElementById("form"));
      await fetch("php/addNewProduct.php", {
          method: 'POST',
          body: formData,
      }).then(respuesta => respuesta.json())
          .then(decodificado => {
            console.log(decodificado)
              if (decodificado=="perfecto") {
                  toastr.success("Guardado!", "Nuevo articulo creado con exito")
                $("#addnew").modal("hide")
                document.getElementById("codeDiplicado").innerHTML=""
                vaciarFormularioNew()
                listarArticulos().then(async()=>{
                  await dibujarTabla(articulosDb)
                })
              }
          });
    }else{
      document.getElementById("codeDiplicado").innerHTML+=`<h4>Productos con el mismo codigo de barra</h4><hr>`
     data.forEach(element => {
      document.getElementById("codeDiplicado").innerHTML+=`<h6>${element.nombre}</h6>`
     });
      
    }
  
  
  
  
  
  
  
  
  });
    
  
 })
 function cambiarTrArticulo(param){
    let pro=articulosDb
        pro= pro.find((m) => parseInt(m.articulo) === parseInt(param));
        pro.nombre=document.getElementById("nombreEdit"+param).value
        pro.codBarra=document.getElementById("codBarraEdit"+param).value
        pro.stockmin=document.getElementById("stockminEdit"+param).value
        pro.cantidad=document.getElementById("cantidadEdit"+param).value
        pro.costo=document.getElementById("costoArticuloEdit"+param).value
        pro.mayoritario=document.getElementById("precioMayo"+param).value
        pro.categoria=document.getElementById("selectCategoriaEdit"+param).value
        pro.idProveedor=document.getElementById("selectProve"+param).value
        pro.menorCentaje=document.getElementById("porcentaje"+param).value
        console.log(document.getElementById("tr"+param))
        document.getElementById("tr"+param).innerHTML=`
          <td>${pro.nombre}</td>
          <td>${separator(pro.costo)}</td>
          <td>${separator(pro.mayoritario)}</td>
          <td>${pro.cantidad}</td>
          <td>${pro.codBarra}</td>
          
          <td style="display: inherit;">
          <button onclick="abrirModalEdit(${param})" class="btn btn-blue"><i class="fas fa-pencil-alt fa-2x"></i></button>
          <button onclick="deleteProduct(${param},this)" class="btn btn-danger"><i class="fas fa-trash-alt fa-2x"></i></button>
          </td>
        `
        
        
 }

 function guardarEditArticulo(id) {
     $("#articulo"+id).modal("hide")
    toastr.warning('Guardando Edicion...')
   let articuloEditado = {
    articulo:id,
    nombreEdit:document.getElementById("nombreEdit"+id).value,
    costoEdit:document.getElementById("costoArticuloEdit"+id).value.replace(/,/g, ""),
    precioEdit:document.getElementById("precioArticuloEdit"+id).value.replace(/,/g, ""),
    stockMinEdit:document.getElementById("stockminEdit"+id).value,
    cantidadEdit:document.getElementById("cantidadEdit"+id).value,
    categoriaEdit:document.getElementById("selectCategoriaEdit"+id).value,
    codBarraEdit:document.getElementById("codBarraEdit"+id).value,
    proveedor:document.getElementById("selectProve"+id).value,
    porcentaje:document.getElementById("porcentaje"+id).value,
    descuento:(document.getElementById("descuento"+id).checked)?document.getElementById("descuento"+id).value:"no",
    precioMayo:document.getElementById("precioMayo"+id).value.replace(/,/g, "")
  };

  let datosEnviar = new FormData();
  datosEnviar.append("articulo", JSON.stringify(articuloEditado));

  fetch("php/editarArticulo.php?id=", {
    method: 'POST',
    body: datosEnviar,
    }).then(respuesta => respuesta.json())
        .then(decodificado => {
          console.log(decodificado)
            if (decodificado=="perfecto") {
                 toastr.success('Edicion exitosa','Guardado!')
              
                cambiarTrArticulo(id)
            }
        });

  console.log(articuloEditado)
 }

 function subirPorcentajeEnPrecios() {
   let porcentaje=document.getElementById("porcentaje").value
   if(porcentaje){
    fetch("php/aumentarPrecio.php?porcentaje="+porcentaje)
          .then(respuesta => {
                $("#modalPorcentaje").modal("hide")
                listarArticulos().then(async()=>{
                  await traerPoductoGalpon(document.getElementById("establecimientos").value)
                })
            }
          );
    }else{
      document.getElementById("porcentaje").style.borderColor="red"
    }
 }
 document.getElementById("porcentaje").addEventListener("click",()=>{
  document.getElementById("porcentaje").style.borderColor=""
 })
/* MODAL DONDE CAMBIO EL TIPO DE FILTRO PARA PONER UN PORCENTAJE GENERAL O ESPECIFICO */
 document.getElementById("botonAvanzadoPorcentaje").addEventListener("click",()=>{
  document.getElementById("modalBody").classList.add("fadeOutRight")
  document.getElementById("exampleModalPreviewLabel").innerHTML="Aumentar precio por proveedor"
  /* oculto un boton y muestro el otro en el modal  */
  document.getElementById("porcentajeNormal").style.display="none"
  document.getElementById("porcentajePorProveedor").style.display="block"
  /* oculto un boton y muestro el otro en el modal  */
  $('#modalBody').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', ()=>{
    document.getElementById("modalBody").classList.remove("fadeOutRight")
    document.getElementById("modalBody").style.display="none"
    document.getElementById("modalBody2").classList.add("fadeInRight")
    document.getElementById("modalBody2").style.display="block"
    
  });
 })
 /* MODAL DONDE CAMBIO EL TIPO DE FILTRO PARA PONER UN PORCENTAJE GENERAL O ESPECIFICO */
 document.getElementById("botonAvanzadoPorcentaje2").addEventListener("click",()=>{
  document.getElementById("exampleModalPreviewLabel").innerHTML="Aumentar precio general"
   document.getElementById("porcentajePorProveedor").style.display="none"
    document.getElementById("porcentajeNormal").style.display="block"
   document.getElementById("modalBody2").style.display="none"
   document.getElementById("modalBody").classList.add("fadeInRight")
   document.getElementById("modalBody").style.display="block"
   $('#modalBody').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', ()=>{
    document.getElementById("modalBody").classList.remove("fadeOutRight")
    
  });
 })

 function vaciarFormularioNew() {
  document.getElementById("form").reset()
 }

 function vaciarEstablecimiento() {
  document.getElementById("nombreEstablecimiento").value=""
  console.log("vacioEsta")
 }

 async function subirPorcentajeEnPreciosLaboratorio() {
  let porcentaje=document.getElementById("porcentajeFiltroLaboratorio").value
  let laboratorio=document.getElementById("selectLaboratorioAumentar").value
  if(laboratorio&&porcentaje){
    await fetch("php/aumentarPrecioLaboratorio.php?porcentaje="+porcentaje+"&idLab="+laboratorio)
          .then(respuesta => {
                console.log(respuesta)
                $("#modalPorcentajeLaboratorio").modal("hide")
                listarArticulos().then(async()=>{
                  await traerPoductoGalpon(document.getElementById("establecimientos").value)
                })
             }
          );
  }else{
    if(!porcentaje){
      document.getElementById("porcentajeFiltroLaboratorio").style.borderColor="red"
    }
    if(!laboratorio){
      document.getElementById("selectLaboratorioAumentar").style.borderColor="red"
    }
  }
  
}
async function deleteProduct(id,e) {
  let a=confirm("Desea eleminar el producto?")
  console.log(a)
  if(a){
      toastr.error("Borrando producto...","Borrando...")
    await fetch('php/deleteProducto.php?id='+id)
    .then(response => response.json())
    .then(async(data)=>{ 
      if(data=="exito"){
        console.log(data)
        toastr.success("Articulo borrado exitosamente","Exito!")
        document.getElementById("totalProductos").innerHTML=articulosDb.length-1
          e.parentElement.parentElement.remove()
        }
      })
  }
    
}
function separator(numb) {
    
    var str = numb.toString().split(".");
    str[0] = str[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    return str.join(".");
}
function separatorthis(numb) {
   
    let numeroSinComas=numb.value.replace(/,/g, "");
    console.log(numeroSinComas)
    var str = numeroSinComas.toString().split(".");
    str[0] = str[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    numb.value=str.join(".");
}


function pesosGuarani(e){
   
    let cambio=e.parentElement.children[0].value.replace(/,/g, "")
    let peso=e.parentElement.children[1].value.replace(/,/g, "")
    let conversion=peso*cambio
    console.log("total: "+conversion)
    e.parentElement.children[2].value=separator(conversion)
}




function ventaPorcentajeCosto(id){
    let precioDeVenta=parseFloat(document.getElementById("precioMayo"+id).value.replace(/,/g, ""))
    let porcentaje=parseFloat(document.getElementById("porcentaje"+id).value.replace(/,/g, ""))
    let costo=document.getElementById("costoArticuloEdit"+id)
    
    console.log(precioDeVenta)
    console.log(porcentaje)
    console.log(costo)
    costo.value=separator(precioDeVenta-((precioDeVenta*porcentaje)/100))
}






function addNewProductFrom(id) {
    
    /* console.log((parseInt(id))) */
   
        let pro=articulosDb
    
        pro= pro.find((m) => parseInt(m.articulo) === parseInt(id));
        console.log("Es: " + pro);
    
        let tablaEscondida=document.getElementById("tablaEscondida").style.display="block"
        let tbody=document.getElementById("addProducto")
        let primerHijo=tbody.firstChild
        
        
        let proveedor=`<option value="">SIN PROVEDOR</option>`
      provedores.forEach(element => {
        proveedor+=`
        <option ${(element.idProveedor==pro.idProveedor)?"selected":""} value="${element.idProveedor}">${element.nombreP}</option>
        `
      });
        
        
 









        let tr=document.createElement('tr')
        
        for (let index = 0; index <= 6; index++) {
            let td=document.createElement('td')
            
            
            let nombre=document.createTextNode(pro.nombre)
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
                inputCantidad.type="number"
                inputCantidad.step="0.01"
                inputCantidad.name="cantidad[]"
                td=document.createElement('td')
                td.style.display="none"
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
                inputCosto.value=pro.costo
                inputFantasma.value=pro.articulo
                inputFantasma.name="idArticulo[]"
                inputFantasma.style.display="none"
               
                let select=document.createElement('select')
                select.innerHTML=proveedor
                select.name="prove[]"
                select.classList.add("form-control")

                tr.style.position="relative"
                td=document.createElement('td')
                td.appendChild(inputFantasma)
                td.appendChild(inputCosto)
                td.appendChild(select)
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
                input.value=pro.menorCentaje
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
                inputGanancia.id="meno"+pro.articulo
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
               /*  let input2 = document.createElement("input");
                input2.type = "number";
                input2.step="0.01"
                input2.name = "preciomayor[]";
                input2.onkeyup = sumarTodoTodito;
                input2.style.display = "none";
                
                
                
                let input3 = document.createElement("input");
                input3.className="form-control"
                input3.required=true
                input3.name="mayo[]"
                input3.type = "number";
                input3.step="0.01"
                input3.style.width="44%"
                input3.style.display="inline"
                input3.style.marginRight="2%"
                input3.value=data.mayorCentaje
                input3.onkeyup = sumarTodoTodito;
                td=document.createElement('td')
                
                tr.appendChild(td)

                let p = document.createElement("p");
                p.innerText = "$0";
                p.style.color = "rgb(0 206 84 / 97%)";
                p.style.fontSize = "130%";
                p.style.background = "#ffc4f2";
                p.style.borderRadius = "5px";
                p.style.padding = "1%";
                p.style.display = "inline";
                td.appendChild(p)
                let div=`
                <div class="md-form">
                <input type="number" step="0.01" disabled class="form-control" id="mayo${data.articulo}">
                <label style="max-width: max-content;" for="mayo${data.articulo}" class="active">Ganancia por mayor</label>
                <span style="position: absolute;top: -190%;background: #5cd1ff99;padding: 2%;border-radius: 5px;color: #ff023d;">%</span>
                </div>
                `
                td.innerHTML+=div
                td.insertBefore(input3,td.firstChild);
                td.appendChild(input2) */
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

function dibujarSelectMdb(params){
    let options=``
    
    params.forEach(element => {
        options+=`<option value="${element.articulo}">${element.nombre}</option>`
    });
    document.getElementById("selectMdb").innerHTML=options
}

function calcularDias(f) {
  if(f){
    let vencimiento = new Date(f);
    let fechaActual = new Date();
    let milisegundosDiferencia = vencimiento - fechaActual;
    let diasDiferencia = Math.floor(milisegundosDiferencia / (1000 * 60 * 60 * 24));
    console.log(diasDiferencia);
    return "Dias "+diasDiferencia
  }else{
    return ""
  }

  // Cambiar el estilo del campo según la cantidad de días restantes (similar al ejemplo anterior)
}

