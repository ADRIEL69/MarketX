<?php
header('Content-Type: application/json; charset=utf-8');

// Evitar que errores PHP salgan mezclados con JSON
ini_set('display_errors', 0);
error_reporting(E_ALL);

include "../conexion.php";

// 1. Validar código recibido
if (empty($_POST['codigo'])) {
    echo json_encode(['error' => 'Código no proporcionado']);
    exit;
}

$codigo = trim($_POST['codigo']);

try {
    // 2. Consulta preparada
    $query = "
        SELECT 
            p.codproducto,
            p.codigo,
            p.descripcion,
            p.existencia,
            p.costo,
            p.foto,
            pr.proveedor AS nombre_proveedor
        FROM producto p
        LEFT JOIN proveedor pr ON p.proveedor = pr.codproveedor
        WHERE p.codigo = ? AND p.status = 1
        LIMIT 1
    ";

    if (!$stmt = mysqli_prepare($conection, $query)) {
        echo json_encode(['error' => 'Error preparando consulta']);
        exit;
    }

    mysqli_stmt_bind_param($stmt, "s", $codigo);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    // 3. Procesar resultado
    if ($row = mysqli_fetch_assoc($result)) {
        echo json_encode([
            'codproducto' => $row['codproducto'],
            'codigo' => $row['codigo'],
            'descripcion' => $row['descripcion'],
            'existencia' => (int) $row['existencia'],
            'costo' => (float) $row['costo'],
            'proveedor' => $row['nombre_proveedor'] ?: 'Sin proveedor',
            'foto' => $row['foto'] ?: 'default.png'
        ]);
    } else {
        echo json_encode(['error' => "Producto no encontrado con el código: {$codigo}"]);
    }

    mysqli_stmt_close($stmt);
} catch (Throwable $e) {
    echo json_encode(['error' => 'Error interno: ' . $e->getMessage()]);
}

mysqli_close($conection);
?>
