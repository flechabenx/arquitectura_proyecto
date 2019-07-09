Comportamiento Dinámico
==============

Escenarios
------------
El siguiente diagrama de casos de usos nos permite especificar como actua la arquitectura en diferentes escenarios. De igual manera, es el item central usado en al modelo de vistas 4+1.


Especificación de Escenarios
-------------
A continuación se detalla cada caso de uso.

1. Visualizar Datos Atmosfericos
~~~~~~~~~~~~

+------------------+--------------------------------------------------------------------------------------------------------+
| **Caso de Uso**  | Visualizar Datos Atmosfericos                                                                          |
+------------------+--------------------------------------------------------------------------------------------------------+
| **Descripción**  | Muestra temperatura y humedad en forma de graficas                                                     |
+------------------+--------------------------------------------------------------------------------------------------------+
| **Actores**      | Usuario Web, Usuario Móvil                                                                             |
+------------------+--------------------------------------------------------------------------------------------------------+
| **Pasos**        | 1. El Usuario ingresa al sitio web.                                                                    |
|                  | 2. El Usuario selecciona la fecha que desea visualizar.                                                |
|                  | 3. El Usuario presiona el botón "Consultar"                                                            |
|                  | 4. El sistema accede a la base de datos para obtener los datos atmosfericos del periodo seleccionado.  |
|                  | 5. Se despliegan los graficos correspondientes.                                                        |
+------------------+--------------------------------------------------------------------------------------------------------+
