<html lang="es">
<head>
    <title>Chat en Vivo</title>

</head>
<body>

<h1>Chat Negocios Web</h1>

<input type="text" id="mensaje">
<button id="enviar">Enviar Mensaje</button>

<div id="mensaje-enviado">
    <p id="texto"></p>
</div>

<script>
    const mensaje = document.getElementById('mensaje').value;

    document.getElementById('enviar').addEventListener('click', function (e) {
        e.preventDefault();
        let ws = new WebSocket('ws://localhost:8000/echo');
        ws.onmessage = function (event) {console.log(event.data);};
        ws.onopen = function (e) {ws.send(mensaje)};
    });
</script>
</body>
</html>