#!/bin/bash

echo
echo "Generando la web del grupo de procesamiento de audio:::"
echo

FILELIST="index.html historia.html integrantes.html investigacion.html links.html contacto.html blog.html"

for file in $FILELIST
do
	if [ ! -e "src/$file" ]
	then
		echo "Advertencia: no existe el archivo src/$file"; echo
		continue
	fi

	cat "src/header.html" "src/$file" "src/footer.html" > $file

done
