<h1>PORTADA DE JUEGOS</h1>
<table border=1>
    <tr>
        <td>
            Nombre del juego
        </td>
        <td>
            Descripción
        </td>
        <td>
            Precio
        </td>
        <td>
            ID Género
        </td>
    </tr>
    <?php foreach($juegos as $juego): ?>
    <tr>
        <td>
            <?php echo $juego['tituloJuego']; ?>
        </td>
        <td>
            <?php echo $juego['descripcion']; ?>
        </td>
        <td>
            <?php echo $juego['precio']; ?>
        </td>
        <td>
            <?php echo $juego['idGenero']; ?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>