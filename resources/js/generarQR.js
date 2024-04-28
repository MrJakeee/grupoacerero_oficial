var generarBtns = document.querySelectorAll('.GenerarQR');
var descargaBtns = document.querySelectorAll('.DescargarQR');
var CodigoQRDIVs = document.querySelectorAll('.CodigoQR');
var textoQrInputs = document.querySelectorAll('.TextoQR');
var mensajeErrors = document.querySelectorAll('.mensajeError');

function generarQR(e) {
    e.preventDefault();

    // Obtener el índice del botón de generar QR que fue clickeado
    var index = Array.from(generarBtns).indexOf(this);
    var textoQr = textoQrInputs[index].value;
    var CodigoQRDIV = CodigoQRDIVs[index];
    var descargabtn = descargaBtns[index];
    var mensajeError = mensajeErrors[index];

    // Generar el nuevo codigo QR
    var codigp = new QRCode(CodigoQRDIV, {
        text: textoQr
    });

    validarCampoTexto(textoQr, CodigoQRDIV, descargabtn, mensajeError);
    BtonDescarga(CodigoQRDIV, descargabtn, textoQr);
}

// Mostrar boton Descarga si existe algún código QR
function BtonDescarga(CodigoQRDIV, descargabtn, nombreCodigo) {
    if (CodigoQRDIV.childNodes.length > 0) {
        descargabtn.style.display = 'block';
        descargabtn.addEventListener('click', () => {
            // Mandar a llamar función de descarga
            descargarQR(CodigoQRDIV, nombreCodigo);
        });
    } else {
        descargabtn.style.display = 'none';
    }
}

function validarCampoTexto(textoQr, CodigoQRDIV, descargabtn, mensajeError) {
    if (textoQr.trim() === '') {
        CodigoQRDIV.innerHTML = '';
        descargabtn.style.display = 'none';
        // Mostrar el mensaje de error
        mensajeError.innerText = 'Por favor, ingresa un texto antes de generar el código QR.';
        mensajeError.style.display = 'block'; // Mostrar el mensaje de error
        return; // Detener la ejecución si el campo de texto está vacío
    } else {
        mensajeError.style.display = 'none';
    }
}

// Función para descargar la imagen del código QR con el nombre
function descargarQR(CodigoQRDIV, nombreCodigo) {
    // Crear un nuevo canvas para el código QR y el texto
    var nuevoCanvas = document.createElement('canvas');
    nuevoCanvas.width = 250;
    nuevoCanvas.height = 300; // Ajustar la altura del canvas para acomodar el texto

    // Obtener el contexto del canvas
    var ctx = nuevoCanvas.getContext('2d');

    // Dibujar el código QR en el nuevo canvas
    ctx.drawImage(CodigoQRDIV.querySelector('canvas'), 0, 0);
    // Agregar el texto debajo del código QR
    ctx.font = '14px Arial black';
    ctx.fillStyle = '#000';
    ctx.textAlign = 'center';
    ctx.fillText(nombreCodigo, nuevoCanvas.width / 2, 270); // Colocar el texto debajo del código QR

    var enlace = document.createElement('a');
    enlace.href = nuevoCanvas.toDataURL('image/png');
    enlace.download = nombreCodigo + '.png';
    enlace.click();
    enlace.remove();
    location.reload();
}

// Asociar la función generarQR al evento click de cada botón "Generar QR"
generarBtns.forEach(function(generarBtn) {
    generarBtn.addEventListener('click', generarQR);
});