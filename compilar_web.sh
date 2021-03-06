#!/bin/bash

echo
echo "Generando la web del grupo de procesamiento de audio:::"
echo

FILELIST="index.html integrantes.html investigacion.html actividades.html blog.html publicaciones.php resultados.html cqt.html fcht.html vamp-plugin.html ismir2012.html"

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

FILELIST2="seminario/2003.html seminario/2005.html seminario/2006.html seminario/2007.html seminario/2008.html seminario/2009.html seminario/2010.html"

for file in $FILELIST2
do
	if [ ! -e "src/$file" ]
	then
		echo "Advertencia: no existe el archivo src/$file"; echo
		continue
	fi

	cat "src/header2.html" "src/$file" "src/footer2.html" > $file
	echo "Generado exitosamente: $file"; echo

done


# LIMPIAR TEMPORALES ------------------------------------------------
	rm *~ 
	rm src/*~ 
	rm seminario/*~ 
	rm src/seminario/*~ 
#--------------------------------------------------------------------

echo "Finalizado"
