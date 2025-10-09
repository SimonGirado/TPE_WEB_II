<!-- formulario de alta de pelicula -->
<form action="anadir" method="POST" class="my-4" enctype="multipart/form-data">
    <div class="row">
        <div class="col-9">
            <div class="form-group">
                <label>Título</label>
                <input required name="titulo" type="text" class="form-control">
            </div>
        </div>

        <div class="col-3">
            <div class="form-group">
                <label>Genero</label>
                <select required name="genero" class="form-control">
                    <option value="1">Accion</option>
                    <option value="2">Comedia</option>
                    <option value="3">Drama</option>
                    <option value="4">Ciencia Ficcion</option>
                    <option value="5">Terror</option>
                </select>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label>Sinopsis</label>
        <textarea name="sinopsis" class="form-control" rows="2"></textarea>
    </div>

    <div class="form-group">
        <label>Duracion</label>
        <textarea name="duracion" class="form-control" rows="2"></textarea>
    </div>

    <div class="form-group">
        <label>Puntaje</label>
        <textarea name="puntaje" class="form-control" rows="2"></textarea>
    </div>

    <input type="file" name="img" accept="image/*">

    <button type="submit" class="btn btn-primary mt-2">Guardar</button>
</form>