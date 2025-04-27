<?php $carrito = $viewBag['carrito'] ?? []; ?>


<h2>Carrito de Compras</h2>

<?php if (empty($carrito)): ?>
    <p>Tu carrito está vacío.</p>
<?php else: ?>
    <table border="1" cellpadding="8">
        <tr>
            <th>Producto</th>
            <th>Precio</th>
            <th>Cantidad</th>
            <th>Subtotal</th>
        </tr>
        <?php $total = 0; ?>
        <?php foreach ($carrito as $item): ?>
            <tr>
                <td><?= htmlspecialchars($item['nombre_producto']) ?></td>
                <td>$<?= number_format($item['precio'], 2) ?></td>
                <td><?= $item['cantidad'] ?></td>
                <td>$<?= number_format($item['precio'] * $item['cantidad'], 2) ?></td>
            </tr>
            <?php $total += $item['precio'] * $item['cantidad']; ?>
        <?php endforeach; ?>
        <tr>
            <td colspan="3" align="right"><strong>Total:</strong></td>
            <td><strong>$<?= number_format($total, 2) ?></strong></td>
        </tr>
    </table>
    <br>
    <a href="/Desafio_2_lis/User/finalizarCompra">Finalizar compra</a>
<?php endif; ?>
