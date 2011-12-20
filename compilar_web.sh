#!/bin/bash

echo
echo "Generando la web del grupo de procesamiento de audio:::"
echo

FILELIST="index.html integrantes.html investigacion.html actividades.html blog.html publicaciones.php resultados.html seminario/2005.html seminario/2006.html seminario/2007.html seminario/2008.html seminario/2009.html seminario/2010.html"

for file in $FILELIST
do
	if [ ! -e "src/$file" ]
	then
		echo "Advertencia: no existe el archivo src/$file"; echo
		continue
	fi

	cat "src/header.html" "src/$file" "src/footer.html" > $file
	echo "Generado exitosamente: $file"; echo

done

echo "Finalizado"
