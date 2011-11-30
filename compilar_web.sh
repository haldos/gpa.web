#!/bin/bash

echo
echo "Generando la web del grupo de procesamiento de audio:::"
echo

FILELIST="index.html integrantes.html investigacion.html contacto.html blog.html publicaciones.html"

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
