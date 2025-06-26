<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Sistema de Ventas</title>
    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
        }
        header {
            background-color: #11476d;
            color: white;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
        }
        nav {
            background-color: #1bb3a0;
            display: flex;
            gap: 20px;
            padding: 10px 20px;
        }
        nav a {
            color: white;
            text-decoration: none;
            font-weight: bold;
        }
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
    <header>
        <div><strong>Sistema De Ventas</strong></div>
        <div>28 de Enero de 2025 | CLIENTE-2</div>
    </header>

    <nav>
        <a href="#">Inicio</a>
        <a href="#">Clientes</a>
        <a href="#">Proveedores</a>
        <a href="#">Productos</a>
        <a href="#">Ventas</a>
        <a href="#">+ Otros</a>
    </nav>

    <div class="scanner">
        <h4>Escáner activado</h4>
        <div id="reader" style="width: 300px; margin: auto;"></div>
    </div>

    <div class="content">
        <label for="codigo">Código detectado:</label>
        <input type="text" id="codigo" name="codigo"><br><br>

        <h3>Información del producto</h3>
        <table>
            <tr>
                <th>Código</th>
                <th>Descripción</th>
                <th>Existencia</th>
                <th>Costo</th>
                <th>Proveedor</th>
                <th>Imagen</th>
                <th>Acciones</th>
            </tr>
            <tr>
                <td>HK45</td>
                <td>-</td>
                <td>5</td>
                <td>$655</td>
                <td>Mercado</td>
                <td><img src="https://via.placeholder.com/60" alt="Producto" width="60"></td>
                <td class="acciones">
                    <a href="#" class="editar">Editar</a>
                    <a href="#" class="eliminar">Eliminar</a>
                </td>
            </tr>
        </table>
    </div>

    <script>
        function onScanSuccess(decodedText, decodedResult) {
            document.getElementById('codigo').value = decodedText;
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
