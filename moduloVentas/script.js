document.addEventListener("DOMContentLoaded", () => {
	const $btnEscanear = document.querySelector("#btnEscanear"),
	$input = document.querySelector("#codigoDeBarra");
	$btnEscanear.addEventListener("click", ()=>{
		window.open("leer.html");
	});

	window.onCodigoLeido =async datosCodigo => {
		console.log("Oh sí, código leído: ")
		console.log(datosCodigo)
		/* $input.nextElementSibling.classList.add("active")
		$input.value = datosCodigo.codeResult.code;
		$input.focus() */
		await cargarProductoTablaVenta(datosCodigo.codeResult.code)

		
		/* var event = new KeyboardEvent("keydown", {which:32,  key:' ', code:'Enter',keyCode:13, charCode:13});
		document.dispatchEvent(event); */
	}
});