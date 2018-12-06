# gecodica

Generador de código para catalogación simplificada

La idea es tener un generador de código para títulos de noticias, de manera tal que puedan funcionar como ID para la catalogación de material (imágenes, textos).

Inicialmente tiene que generar 4 letras:

Reglas
======

* Tomando como base las iniciales de las palabras.
* Omitiendo los artículos inciales.
* Completando con letras de la última palabra.
* Si coincide con otro código entonces busca las siguientes palabras o la siguientes letras.
* Si no hay más palabras o letras, entonces agrega un número.

Por ejemplo:

* Gran Apertura De Centro ------> GADC
* la Gran Apertura HOy ---------> GAHO
* Gran APErtura ----------------> GAPE
* Gran Abertura HoY ------------> GAHY
* Gran Apertura Hoy Martes -----> GAHM
* la Gran Apertura hoy MArtes --> GAMA
* la Gran Abertura hoy MArtes --> GAM0

A su vez el generador debe armar el título en formato "web amigable", quitando caracteres especiales y agregando guiones

Ej: 

* la-gran-abertura-hoy-martes


