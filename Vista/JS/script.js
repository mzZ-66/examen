document.addEventListener("DOMContentLoaded", () => {
    obtenerCategorias();
    comprobarDevoluciones();
});

function obtenerCategorias() {
    let containerVariable = document.querySelector('.containerVariable');
    containerVariable.innerHTML = '<h2>Categorías disponibles</h2>'
    let requestOptions = {
        method: 'POST'
    };
    fetch('../Controlador/obtenerCategorias.php', requestOptions)
        .then(response => {
            if (!response.ok) {
                throw new Error('La solicitud no fue exitosa');
            }
            return response.json();
        })
        .then(data => {
            if (data.categorias) {
                // console.log(data.categorias);
                for (let categoria of data.categorias) {
                    let categoriaDiv = document.createElement('div');
                    categoriaDiv.id = 'categoria';

                    let categoriaNombre = document.createElement('p');
                    categoriaNombre.textContent = categoria;

                    let categoriaBoton = document.createElement('button');
                    categoriaBoton.textContent = 'Seleccionar';
                    categoriaBoton.value = categoria;
                    categoriaBoton.addEventListener('click', function() {
                        mostrarLibros(categoria);
                    });

                    categoriaDiv.appendChild(categoriaNombre);
                    categoriaDiv.appendChild(categoriaBoton);
                    containerVariable.appendChild(categoriaDiv);
                }
            } else {
                console.log(data.error);
            }
        })
        .catch(error => {
            console.log('Error en la solicitud:', error.message);
        });
}

function mostrarLibros(categoriaSeleccionada) {
    // console.log('Categoría seleccionada: ' + categoriaSeleccionada);
    let containerVariable = document.querySelector('.containerVariable');
    containerVariable.innerHTML = '';
    let data = { categoriaSeleccionada: categoriaSeleccionada };
    let requestOptions = {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    };
    fetch('../Controlador/obtenerLibrosPorCategoria.php', requestOptions)
        .then(response => {
            if (!response.ok) {
                throw new Error('La solicitud no fue exitosa');
            }
            return response.json();
        })
        .then(data => {
            if (data.libros) {
                // console.log(data.libros);
                for (let libro of data.libros) {
                    let libroDiv = document.createElement('div');
                    libroDiv.id = 'libro';

                    let libroTitulo = document.createElement('p');
                    libroTitulo.textContent = libro.titulo;

                    let data = { isbn: libro.isbn };
                    let requestOptions = {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify(data)
                    };
                    fetch('../Controlador/comprobarEjemplares.php', requestOptions)
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('La solicitud no fue exitosa');
                            }
                            return response.json();
                        })
                        .then(data => {
                            if (data.hayEjemplares) {
                                    let solicitarLibroBoton = document.createElement('button');
                                    solicitarLibroBoton.textContent = 'SOLICITAR PRÉSTAMO';
                                    solicitarLibroBoton.value = libro.isbn;
                                    solicitarLibroBoton.addEventListener('click', function() {
                                        solicitarLibro(libro.isbn);
                                    });
                                    libroDiv.appendChild(solicitarLibroBoton);
                            } else {
                                console.log(data.error);
                                let noDisponibleTexto = document.createElement('p');
                                noDisponibleTexto.textContent = 'TÍTULO NO DISPONIBLE';
                                libroDiv.appendChild(noDisponibleTexto);
                            }
                        })
                        .catch(error => {
                            console.log('Error en la solicitud:', error.message);
                        });

                    libroDiv.appendChild(libroTitulo);
                    containerVariable.appendChild(libroDiv);
                }
            } else {
                console.log(data.error);
            }
        })
        .catch(error => {
            console.log('Error en la solicitud:', error.message);
        });
}

function solicitarLibro(isbn) {
    let containerVariable = document.querySelector('.containerVariable');
    containerVariable.innerHTML = `
        <h2>Solicitud de préstamo</h2>
        <form class="formulario">
            <p><strong>Introduce tu DNI:</strong></p>
            <input type="text" name="dniSocio" class="inputTexto">
        </form>
        <button id="dniSocioBtn" class="boton">Enviar</button>
    `;
    let dniSocioBtn = document.getElementById('dniSocioBtn');
    dniSocioBtn.addEventListener('click', function() {
        let formulario = document.querySelector('.formulario');
        let datosFormulario = new FormData(formulario);
        
        let requestOptions = {
            method: 'POST',
            body: datosFormulario
        };
        fetch('../Controlador/comprobarSocio.php', requestOptions)
            .then(response => {
                if (!response.ok) {
                    throw new Error('La solicitud no fue exitosa');
                }
                return response.json();
            })
            .then(data => {
                if (data.dniSocioExiste) {
                    console.log('El socio existe. Se puede dar el alta del préstamo.');
                    let jsonData = { dniSocio: data.dniSocioExiste, isbn: isbn};
                    let requestOptions = {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify(jsonData)
                    };
                    fetch('../Controlador/darDeAltaPrestamo.php', requestOptions)
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('La solicitud no fue exitosa');
                            }
                            return response.json();
                        })
                        .then(data => {
                            if (data.error == null) {
                                console.log('Préstamo dado de alta');
                                containerVariable.innerHTML = `
                                    <h2>Solicitud de préstamo</h2>
                                    <p>Préstamo dado de alta.</p>
                                    <a href="index.html"><button>Volver</button></a>
                                `;
                            } else {
                                console.log(data.error);
                                containerVariable.innerHTML = `
                                    <h2>Solicitud de préstamo</h2>
                                    <p>${data.error}</p>
                                    <a href="index.html"><button>Volver</button></a>
                                `;
                            }
                        })
                        .catch(error => {
                            console.log('Error en la solicitud:', error.message);
                        });
                } else {
                    console.log(data.error);
                    containerVariable.innerHTML = `
                        <h2>Solicitud de préstamo</h2>
                        <p>No estás registrado. Házlo ahora:</p>
                        <form class="formulario">
                            <p><strong>Introduce tu DNI:</strong></p>
                            <input type="text" name="dniSocio" class="inputTexto" required>

                            <p><strong>Introduce tu nombre:</strong></p>
                            <input type="text" name="nombreSocio" class="inputTexto" required>

                            <p><strong>Introduce tu dirección:</strong></p>
                            <input type="text" name="direccionSocio" class="inputTexto" required>

                            <p><strong>Introduce tu email:</strong></p>
                            <input type="email" name="emailSocio" class="inputTexto" required>
                        </form>
                        <button id="registroSocioBtn" class="boton">Registrarse</button>
                    `;
                    let registroSocioBtn = document.getElementById('registroSocioBtn');
                    registroSocioBtn.addEventListener('click', function() {
                        let formulario = document.querySelector('.formulario');
                        let datosFormulario = new FormData(formulario);
                        let requestOptions = {
                            method: 'POST',
                            body: datosFormulario
                        };
                        fetch('../Controlador/registrarSocio.php', requestOptions)
                            .then(response => {
                                if (!response.ok) {
                                    throw new Error('La solicitud no fue exitosa');
                                }
                                return response.json();
                            })
                            .then(data => {
                                if (data.error == null) {
                                    console.log('Socio registrado');
                                    containerVariable.innerHTML = `
                                        <h2>Solicitud de préstamo</h2>
                                        <p>Te has dado de alta. Vuelve a hacer la solicitud.</p>
                                        <a href="index.html"><button>Volver</button></a>
                                    `;
                                } else {
                                    console.log(data.error);
                                }
                            })
                            .catch(error => {
                                console.log('Error en la solicitud:', error.message);
                            });
                    });
                }
            })
            .catch(error => {
                console.log('Error en la solicitud:', error.message);
            });
        });
    
}

function comprobarDevoluciones() {
    let requestOptions = {
        method: 'POST'
    };
    fetch('../Controlador/comprobarDevoluciones.php', requestOptions)
        .then(response => {
            if (!response.ok) {
                throw new Error('La solicitud no fue exitosa');
            }
            return response.json();
        })
        .then(data => {
            if (data.devolucionesComprobadas) {
                console.log(dara.devolucionesComprobadas);
            }
            if (data.error) {
                console.log(data.error);
            }
        })
        .catch(error => {
            console.log('Error en la solicitud:', error.message);
        });
}