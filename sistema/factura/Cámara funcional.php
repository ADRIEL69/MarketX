<?php
session_start();
include "../conexion.php";
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Escáner de Productos</title>
    <?php include "includes/scripts.php"; ?>
    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
    <style>
        .scanner {
            background-color: #f2f2f2;
            margin: 20px;
            padding: 10px;
            text-align: center;
            border: 1px solid #ccc;
        }
        .content { margin: 20px; }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        table, th, td {
            border: 1px solid #05817D; /* Color del borde de la tabla */
        }
        th {
            background-color: #05817D; /* Color del encabezado de la tabla */
            color: white;
        }
        td {
            text-align: center;
            padding: 8px;
        }
        .test-button {
            background-color: #05817D; /* Color de fondo del botón */
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            margin: 5px;
            font-family: ;
        }
        .test-button:hover {
            background-color: #035b5a; /* Color al pasar el mouse por encima del botón */
        }
        .restart-button-container {
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <?php include "includes/header.php"; ?>

    <section id="container">
        <h1><i class="fas fa-qrcode"></i> Escáner de productos</h1>

        <div class="scanner">
            <h4 id="scanner-status">Escáner activado</h4>
            <div id="reader" style="width: 300px; margin: auto;"></div>
            <div id="restart-button-container" class="restart-button-container" style="display: none;">
                <button class="test-button" onclick="reiniciarScanner()">🔄 Reiniciar Escáner</button>
            </div>
        </div>

        <div class="content">
            <label for="codigo">Código detectado:</label>
            <input type="text" id="codigo" name="codigo">
<div style="text-align: center;">
    <button class="test-button" onclick="buscarProductoManual()" style="font-family: 'Roboto Mono'">Buscar Manual</button>
</div>
            <table id="tabla-producto">
                <tr>
                    <th>Código</th>
                    <th>Descripción</th>
                    <th>Existencia</th>
                    <th>Costo</th>
                    <th>Proveedor</th>
                </tr>
            </table>
        </div>
    </section>

    <?php include "includes/footer.php"; ?>

    <script>
        const API_URL = 'buscar_productos.php';

        const html5QrcodeScanner = new Html5QrcodeScanner(
            "reader", { fps: 10, qrbox: 250 }
        );

        function onScanSuccess(decodedText, decodedResult) {
            document.getElementById('codigo').value = decodedText;
            buscarProducto(decodedText, 'scanner');
            
            document.getElementById('scanner-status').textContent = "Escaneo completado";
            document.getElementById('reader').style.display = 'none';
            document.getElementById('restart-button-container').style.display = 'block';
            
            html5QrcodeScanner.clear();
        }

        function onScanFailure(error) {
            // Manejar errores de escaneo si es necesario
        }

        function reiniciarScanner() {
            document.getElementById('scanner-status').textContent = "Escáner activado";
            document.getElementById('reader').style.display = 'block';
            document.getElementById('restart-button-container').style.display = 'none';

            html5QrcodeScanner.render(onScanSuccess, onScanFailure);
        }

        function buscarProducto(codigo, origen='scanner') {
            fetch(API_URL, {
                method: 'POST',
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                body: 'codigo='+encodeURIComponent(codigo)
            })
            .then(r => r.json())
            .then(data => {
                mostrarResultado(data);
            })
            .catch(e => {
                console.error('Error de red:', e);
            });
        }

        function buscarProductoManual() {
            const code = document.getElementById('codigo').value.trim();
            if(code){ buscarProducto(code, 'manual'); }
        }

        function mostrarResultado(data) {
            const tabla = document.getElementById('tabla-producto');
            tabla.innerHTML = `
                <tr>
                    <th>Código</th>
                    <th>Descripción</th>
                    <th>Existencia</th>
                    <th>Costo</th>
                    <th>Proveedor</th>
                </tr>`;

            if (data.error) {
                tabla.innerHTML += `
                    <tr>
                        <td colspan="5" style="color: orange;">⚠️ ${data.error}</td>
                    </tr>`;
            } else if (data.codproducto) {
                tabla.innerHTML += `
                    <tr>
                        <td>${data.codigo || 'N/A'}</td>
                        <td>${data.descripcion || 'N/A'}</td>
                        <td>${data.existencia ?? '0'}</td>
                        <td>$${parseFloat(data.costo || 0).toFixed(2)}</td>
                        <td>${data.proveedor || 'Sin proveedor'}</td>
                    </tr>`;
            } else {
                tabla.innerHTML += `
                    <tr>
                        <td colspan="5" style="color: gray;">❓ Respuesta inesperada del servidor</td>
                    </tr>`;
            }
        }
        
        html5QrcodeScanner.render(onScanSuccess, onScanFailure);
    </script>
</body>
</html>
