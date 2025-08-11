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

        .content {
            margin: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        table, th, td {
            border: 1px solid #cccccc;
        }

        th {
            background-color: #00738C;
            color: white;
        }

        td {
            text-align: center;
            padding: 8px;
        }

        .acciones a {
            margin: 0 5px;
            text-decoration: none;
            font-weight: bold;
        }

        .editar {
            color: #007bff;
        }

        .eliminar {
            color: red;
        }
    </style>
</head>
<body>
    <?php include "includes/header.php"; ?>

    <section id="container">
        <h1><i class="fas fa-qrcode"></i> Escáner de productos</h1>

        <div class="scanner">
            <h4>Escáner activado</h4>
            <div id="reader" style="width: 300px; margin: auto;"></div>
        </div>

        <div class="content">
            <label for="codigo">Código detectado:</label>
            <input type="text" id="codigo" name="codigo"><br><br>

            <h3>Información del producto</h3>
            <table id="tabla-producto">
                <tr>
                    <th>Código</th>
                    <th>Descripción</th>
                    <th>Existencia</th>
                    <th>Costo</th>
                    <th>Proveedor</th>
                    <th>Imagen</th>
                    <th>Acciones</th>
                </tr>
            </table>
        </div>
    </section>

    <?php include "includes/footer.php"; ?>

    <script>
        function onScanSuccess(decodedText, decodedResult) {
            document.getElementById('codigo').value = decodedText;

            fetch('buscar_producto.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'codigo=' + encodeURIComponent(decodedText)
            })
            .then(response => response.json())
            .then(data => {
                const tabla = document.getElementById('tabla-producto');
                tabla.innerHTML = `
                    <tr>
                        <th>Código</th>
                        <th>Descripción</th>
                        <th>Existencia</th>
                        <th>Costo</th>
                        <th>Proveedor</th>
                        <th>Imagen</th>
                        <th>Acciones</th>
                    </tr>`;

                if (data.codproducto) {
                    tabla.innerHTML += `
                        <tr>
                            <td>${data.codigo}</td>
                            <td>${data.descripcion}</td>
                            <td>${data.existencia}</td>
                            <td>$${data.costo}</td>
                            <td>${data.proveedor}</td>
                            <td><img src="factura/img/${data.foto}" width="60"></td>
                            <td class="acciones">
                                <a href="editar_producto.php?id=${data.codproducto}" class="editar">Editar</a>
                                <a href="eliminar_producto.php?id=${data.codproducto}" class="eliminar">Eliminar</a>
                            </td>
                        </tr>`;
                } else {
                    tabla.innerHTML += `
                        <tr>
                            <td colspan="7">Producto no encontrado</td>
                        </tr>`;
                }
            })
            .catch(error => {
                console.error('Error al buscar producto:', error);
            });

            html5QrcodeScanner.clear().then(() => {
                console.log("Escaneo detenido");
            }).catch(err => {
                console.error("Error al detener escáner:", err);
            });
        }

        const html5QrcodeScanner = new Html5QrcodeScanner(
            "reader", { fps: 10, qrbox: 250 });

        html5QrcodeScanner.render(onScanSuccess);
    </script>
</body>
</html>
