Hay un usuario "webadmin" con clave "admin" que permite logearse a la pagina para usar los servicios de Alta Baja y Modificacion
En lo que respecta a las partes del trabajo fue dividido por Simon Girado: parte (A) del trabajo y Camila Makx la parte (B)
El sitio se puede correr como cualquier otro, no tiene complicaciones, dejo la db actualizada.

La imagen no se subia debido al peso, se podia hacer un if imagen>limite showError o cambiar el limite desde los archivos de apache
Oculte los botones y el addMovie si no estabas logeado. Al poner una img de mayor tamanio a 1MB, se rompe.
Oculte el deploy, ya que al cargar imagenes en BLOB, la cadena de caracteres es tan larga que no entra en el archivo y genera errores, la otra opcion era subir una tabla sin imagenes. El ayudante de catedra me sugirio ocultar la funcion deploy si yo estaba seguro de que la database proporcionada funcionaba al ser importada.
Acomode los templates para movies