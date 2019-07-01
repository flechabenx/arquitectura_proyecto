Estructura 
==================================

Visión de Conjunto
------------------
.. image:: images/EstructuraOverview.jpg
    :scale: 70 %
    :align: center

El sistema se encuentra compuesto por tres componentes principales; Backend, Frontend Web, Aplicación Móvil, agregando otras dos partes adicionales; un motor de base de datos y una colección de sensores.

El **Frontend** web tiene **Componentes Visuales** que le permiten a los usuarios interactuar gráficamente con ellos, contienen vistas y controladores. Los **Ocultadores de Componentes Visuales** controlan la forma en la que ciertos componentes se despliegan al usuario.

La **Aplicación Móvil** se describe de una forma bastante similar, pero este al no tener un acceso a navegador por URL no requiere **Ocultadores de Componentes** para impedir el acceso a ciertos componentes de URL.

Los **Servicios** del **Frontend** y la **Aplicación Móvil** se comunican con el **Spring Servlet** del **Backend** utilizando el protocolo HTTP, por lo que aquí se encuentra presente un Estilo de Arquitectura Orientada a Servicios (SOA), específicamente REST. Las solicitudes pasan por varios filtros (Pipes and filters), uno de ellos es el filtro de **Autenticación** el cuál extrae credenciales a las peticiones de los usuarios.

Las peticiones que llegan al **Spring Servlet** son derivadas a los **Controladores**, los cuales conocen la intención de la solicitud y generan una respuesta dependiendo de la operación que se requiere. Para generar tal respuesta, los **Controladores** solicitan datos al componente **Repository**, el cuál contiene diversas interfaces que permiten gestionar la información de la **Base de Datos** (Estilo de Arquitectura Repository). Sin embargo, **Repository** no puede hacer esto directamente ya que no conoce exactamente cuál motor de base de datos se encuentra utilizando, por lo que deriva tal tarea al **Hibernate Entity Manager**, para generar los procedimientos de comunicación con la **Base de Datos**.

El **Sensor** es un componente técnico que puede comunicarse directamente con la **Base de Datos** para almacenar información respecto a las medidas que este obtiene.

Los **Modelos** tienen el propósito de dar a conocer la estructura de los datos que se deben almacenar en la **Base de Datos**, por lo que **Hibernate Entity Manager** los utiliza principalmente para conocer la forma de los datos.

Sección de Componentes
----------------------

En esta seccion se describe cada uno de los componentes pertenecientes a cada una de las las arquitectura que componen nuestro sistema.
                    
Componente Frontend Web  
-----------------------

+---------------------------+-----------------------------------------------------------------------------+
| **Componente**            | Frontend_Web                                                                |
+---------------------------+-----------------------------------------------------------------------------+
| **Responsabilidades**     | - Interactúa con el **usuario web** y el **usuario moderador**, a través    |
|                           |   de componentes visuales que permiten cierto acceso a componentes de URL.  |
|                           | - Es intermediario entre las operaciones de los usuarios y el **backend**.  |
|                           |                                                                             |
+---------------------------+-----------------------------------------------------------------------------+
| **Colaboradores**         | - **Componente:** Backend                                                   |
|                           |                                                                             |
+---------------------------+-----------------------------------------------------------------------------+
| **Notas**                 | El componente se crea una sola vez y persiste durante todo el tiempo.       |
|                           |                                                                             |
+---------------------------+-----------------------------------------------------------------------------+
| **Problemas**             |                                                                             |
+---------------------------+-----------------------------------------------------------------------------+

Componentes Visuales
~~~~~~~~~~~~~~~~~~~~
+---------------------------+----------------------------------------------------------------------------------+
| **SubComponente**         | Frontend_Web_Componentes_Visuales                                                |
+---------------------------+----------------------------------------------------------------------------------+
| **Responsabilidades**     | - Se encarga de contener los contenidos visuales y elementos que componen las    |
|                           |   vistas del frontend web del sistema.                                           |
|                           | - Interfaces provistas:                                                          |
|                           |    - Grafico_medidas: Provee los metodos para modificar los diferentes valores   |
|                           |      medidas para posteriormente graficar.                                       |
+---------------------------+----------------------------------------------------------------------------------+
| **Colaboradores**         | - **SubComponente:** Frontend_Web_Services                                       |
|                           | - **Interface:** Grafico_medidas                                                 |
+---------------------------+----------------------------------------------------------------------------------+
| **Notas**                 |  El sub-componente se crea una vez y persiste mientras el sistema esta en uso.   |
+---------------------------+----------------------------------------------------------------------------------+
| **Problemas**             |                                                                                  |
+---------------------------+----------------------------------------------------------------------------------+

Servicios
~~~~~~~~~
+---------------------------+-----------------------------------------------------------------------------+
| **SubComponente**         | Frontend_Web_Servicios                                                      |
+---------------------------+-----------------------------------------------------------------------------+
| **Responsabilidades**     |- Contiene todos los servicios que son necesarios para interactuar con el    |
|                           |  backend.                                                                   |
|                           |- Es intermediario entre las operaciones de los usuarios y el **backend**.   |
|                           |- Interfaces previstas:                                                      |
|                           |   - Usuario_controller: Provee acciones para acceder a un usuario y         |
|                           |     registrar un usuario.                                                   |
|                           |   - Pregunta_controller: Provee las acciones para listar todas las preguntas|
|                           |     por diferentes criterios (no aprobadas, aprobadas o todas). Además le   |
|                           |     permite al moderador aprobar preguntas.                                 |
|                           |   - Respuesta_controller: Provee los metodos al moderador para aprobar      |
|                           |     respuestas, ademas de listar por respuestas aprobadas o no aprobadas.   |
|                           |   - Medida_controller: Provee los metodos para listar todas medidas         |
|                           |     registradas, como tambien por un rango de fechas                        |
+---------------------------+-----------------------------------------------------------------------------+
| **Colaboradores**         | - **SubComponente:** Backend_Spring_Servlet                                 |
|                           | - **Interface:** Usuario_controller                                         |
|                           | - **Interface:** Pregunta_controller                                        |
|                           | - **Interface:** Respuesta_controller                                       |
|                           | - **Interface:** Medida_controller                                          |
+---------------------------+-----------------------------------------------------------------------------+
| **Notas**                 | El sub-componente se crea se crea una sola vez y se inyecta en los          |
|                           | componentes visuales. Pueden existir distintas instancias del componente.   |
+---------------------------+-----------------------------------------------------------------------------+
| **Problemas**             |                                                                             |
+---------------------------+-----------------------------------------------------------------------------+

Ocultadores de componentes visuales
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
+---------------------------+-----------------------------------------------------------------------------+
| **SubComponente**         | Frontend_Web_Ocultadores_De_Componentes_Visuales                            |
+---------------------------+-----------------------------------------------------------------------------+
| **Responsabilidades**     | -  Se encarga de restringir el acceso de los elementos visuales para los    |
|                           |    distintos usuarios.                                                      |
+---------------------------+-----------------------------------------------------------------------------+
| **Colaboradores**         | - **SubComponente:** Frontend_Web_Componentes_Visuales                      |  
|                           |                                                                             |
+---------------------------+-----------------------------------------------------------------------------+
| **Notas**                 | El sub-componente se crea una vez y persiste mientras el sistema esta en    |
|                           | uso.                                                                        |
+---------------------------+-----------------------------------------------------------------------------+
| **Problemas**             |                                                                             |
+---------------------------+-----------------------------------------------------------------------------+


Componente Aplicación Móvil  
---------------------------

+---------------------------+-----------------------------------------------------------------------------+
| **Componente**            | Aplicación_Móvil                                                            |
+---------------------------+-----------------------------------------------------------------------------+
| **Responsabilidades**     | - Interactúa con el **usuario móvil**, permitiendole crear preguntas acerca |
|                           |   del clima.                                                                |
|                           | - Es el intermediario entre las operaciones de los usuarios móvil y el      |
|                           |   **backend**.                                                              |
+---------------------------+-----------------------------------------------------------------------------+
| **Colaboradores**         | - **Componente:** Backend                                                   |
+---------------------------+-----------------------------------------------------------------------------+
| **Notas**                 | El componente se crea una sola vez y persiste mientra el sistema está en    |
|                           | ejecución.                                                                  |
+---------------------------+-----------------------------------------------------------------------------+
| **Problemas**             |                                                                             |
+---------------------------+-----------------------------------------------------------------------------+

Componentes Visuales
~~~~~~~~~~~~~~~~~~~~
+---------------------------+-----------------------------------------------------------------------------+
| **SubComponente**         | Aplicación_Móvil_Componentes_Visuales                                       |
+---------------------------+-----------------------------------------------------------------------------+
| **Responsabilidades**     | - Se encarga de contener los contenidos visuales y elementos que componen   |
|                           |   las vistas de la aplicación movil.                                        |
|                           | - Es intermediario entre las operaciones de los usuarios móvil y el         |
|                           |   **backend**.                                                              |
+---------------------------+-----------------------------------------------------------------------------+
| **Colaboradores**         | - **SubComponente:** Aplicación_Móvil_Servicios                             |  
|                           |                                                                             |
+---------------------------+-----------------------------------------------------------------------------+
| **Notas**                 | El sub-componente se crea una vez y persiste mientras el sistema esta en    |
|                           | uso.                                                                        |
+---------------------------+-----------------------------------------------------------------------------+
| **Problemas**             |                                                                             |
+---------------------------+-----------------------------------------------------------------------------+

Servicios
~~~~~~~~~
+---------------------------+-----------------------------------------------------------------------------+
| **SubComponente**         | Aplicación_Móvil_Servicios                                                  |
+---------------------------+-----------------------------------------------------------------------------+
| **Responsabilidades**     | - Interactúa con el **usuario web** y el **usuario moderador**, a través    |
|                           |   de componentes visuales que permiten cierto acceso a componentes de URL.  |
|                           | - Es intermediario entre las operaciones de los usuarios y el **backend**.  |
|                           | - Interfaces provistas:                                                     |
|                           |    - Usuario_controller: Provee metodos para registrar y acceder a un       |
|                           |      usuario.                                                               |
|                           |    - Respuesta_controller: Provee metodos para crear preguntas y listar por |
|                           |      criterio de preguntas aprobadas y no aprobadas.                        |
+---------------------------+-----------------------------------------------------------------------------+
| **Colaboradores**         | - **Componente:** Backend_Spring_Servlet                                    |
|                           | - **Interface:** Usuario_controller                                         |
|                           | - **Interface:** Pregunta_controller                                        |
+---------------------------+-----------------------------------------------------------------------------+
| **Notas**                 | El sub-componente se crea se crea una sola vez y se inyecta en los          |
|                           | componentes visuales. Pueden existir distintas instancias del componente.   |
+---------------------------+-----------------------------------------------------------------------------+
| **Problemas**             |                                                                             |
+---------------------------+-----------------------------------------------------------------------------+


Componente Backend
------------------------

+---------------------------+-----------------------------------------------------------------------------+
| **Componente**            | Backend                                                                     |
+---------------------------+-----------------------------------------------------------------------------+
| **Responsabilidades**     | Se encargar de recicibir todas las peticiones del componen                  |
+---------------------------+-----------------------------------------------------------------------------+
| **Colaboradores**         | - **Componente**: Frontend_Web                                              | 
|                           | - **Componente**: Aplicación_Móvil                                          |
|                           | - **Componente**: Base_de_datos                                             |
+---------------------------+-----------------------------------------------------------------------------+
| **Notas**                 | El componente se crea una vez y persiste todo el tiempo para el sistema.    |
|                           | Existe solo una instancia del componente en la arquitectura.                |
+---------------------------+-----------------------------------------------------------------------------+
| **Problemas**             |                                                                             |
+---------------------------+-----------------------------------------------------------------------------+

Spring Servlet
~~~~~~~~~~~~~~
+---------------------------+-----------------------------------------------------------------------------+
| **SubComponente**         | Backend_Spring_Servlet                                                      |
+---------------------------+-----------------------------------------------------------------------------+
| **Responsabilidades**     | - Se encarga de recicibir todas las peticiones y derivarlas a los           |
|                           |   respectivos controladores.                                                |
+---------------------------+-----------------------------------------------------------------------------+
| **Colaboradores**         | - **SubComponente:** Backend_Controladores                                  |
|                           | - **SubComponente:** Backend_Autenticación                                  |
+---------------------------+-----------------------------------------------------------------------------+
| **Notas**                 | El sub-componente se encuentra disponible (persiste) durante todo el tiempo |
|                           | para el sistema. Existe solo una instancia del sub-componente.              |
+---------------------------+-----------------------------------------------------------------------------+
| **Problemas**             |                                                                             |
+---------------------------+-----------------------------------------------------------------------------+

Autenticación
~~~~~~~~~~~~~
+---------------------------+-----------------------------------------------------------------------------+
| **SubComponente**         | Backend_Autenticacion                                                       |
+---------------------------+-----------------------------------------------------------------------------+
| **Responsabilidades**     | -  Realiza operaciones para comprobar una solicitud de autentificacion      |
+---------------------------+-----------------------------------------------------------------------------+
| **Colaboradores**         |                                                                             |
+---------------------------+-----------------------------------------------------------------------------+
| **Notas**                 | El sub-componente se crea una sola vez y persiste por siempre para el       |
|                           | sistema. Existe solo una instancia del componente en la arquitectura.       |
+---------------------------+-----------------------------------------------------------------------------+
| **Problemas**             |                                                                             |
+---------------------------+-----------------------------------------------------------------------------+

Controladores
~~~~~~~~~~~~~
+---------------------------+-----------------------------------------------------------------------------+
| **SubComponente**         | Backend_Controladores                                                       |
+---------------------------+-----------------------------------------------------------------------------+
| **Responsabilidades**     | - Reciben solicitudes y generan una respuesta, dependiendo de la            |
|                           |   operación que se requiere.                                                |
|                           |                                                                             |
+---------------------------+-----------------------------------------------------------------------------+
| **Colaboradores**         | - **SubComponente:** Backend_Repository                                     |
|                           |                                                                             |
+---------------------------+-----------------------------------------------------------------------------+
| **Notas**                 | El sub-componente controladores se crea una sola vez y es persistente       |
|                           | la ejecución del sistema. Se instancia una sola vez en la arquitectura.     |
+---------------------------+-----------------------------------------------------------------------------+
| **Problemas**             | Las referencias ciclicas en los modelos generan conflictos al generar el    |
|                           | JSON.                                                                       |
+---------------------------+-----------------------------------------------------------------------------+

Repository
~~~~~~~~~~
+---------------------------+-----------------------------------------------------------------------------+
| **SubComponente**         | Backend_Repository                                                          |
+---------------------------+-----------------------------------------------------------------------------+
| **Responsabilidades**     | - Se encarga de gestionar la informacion de la base de datos.               |
|                           | - Informa al sub-componente Entity Manager para que realize las operaciones |
|                           |   CRUD a la base de datos                                                   |
+---------------------------+-----------------------------------------------------------------------------+
| **Colaboradores**         | - **SubComponente:** Backend_Entity_Manager                                 |  
|                           |                                                                             |
+---------------------------+-----------------------------------------------------------------------------+
| **Notas**                 | Este sub-componente es persistente y se crea una sola vez durante la        |
|                           | ajecución del sistema. Solo existe una sola instancia de este componente en |
|                           | la arquitectura.
+---------------------------+-----------------------------------------------------------------------------+
| **Problemas**             |                                                                             |
+---------------------------+-----------------------------------------------------------------------------+

Entity Manager
~~~~~~~~~~~~~~
+---------------------------+-----------------------------------------------------------------------------+
| **SubComponente**         | Backend_Entity_Manager                                                      |
+---------------------------+-----------------------------------------------------------------------------+
| **Responsabilidades**     | - Se encarga de realizar los procedeimientos de comunicacion para conectar  |
|                           |   con la base de datos.                                                     |
|                           | - Realiza las operaciones CRUD a las tablas de la base de datos.            |
+---------------------------+-----------------------------------------------------------------------------+
| **Colaboradores**         | - **SubComponente:** Backend_Modelos                                        |  
|                           |                                                                             |
+---------------------------+-----------------------------------------------------------------------------+
| **Notas**                 | El sub-componente Entity Manager se crea una sola vez, y esta instancia     |
|                           | persiste para todo el sistema mientras esta funcionando.                    |
+---------------------------+-----------------------------------------------------------------------------+
| **Problemas**             |                                                                             |
+---------------------------+-----------------------------------------------------------------------------+

Modelos
~~~~~~~
+---------------------------+-----------------------------------------------------------------------------+
| **SubComponente**         | Backend_Modelos                                                             |
+---------------------------+-----------------------------------------------------------------------------+
| **Responsabilidades**     | - Dan a conocer la estructura de los datos que se deben almacenar en la base|
|                           |   de datos.                                                                 |
|                           |                                                                             |
+---------------------------+-----------------------------------------------------------------------------+
| **Colaboradores**         |                                                                             |
+---------------------------+-----------------------------------------------------------------------------+
| **Notas**                 | El sub-componente es creado a medida que es necesitado por el Entity Manager|
|                           | y es destruido una vez ya no se necesita. Existen muchas instancias del     |
|                           | componente en la arquitectura.                                              |
+---------------------------+-----------------------------------------------------------------------------+
| **Problemas**             |                                                                             |
+---------------------------+-----------------------------------------------------------------------------+


Base de Datos
-------------
+---------------------------+-----------------------------------------------------------------------------+
| **Componente**            | Base_de_datos                                                               |
+---------------------------+-----------------------------------------------------------------------------+
| **Responsabilidades**     | - Almacenar  y gestionar la información de mediciones, sensores, usuario,   |
|                           |   preguntas y respuestas.                                                   |
+---------------------------+-----------------------------------------------------------------------------+
| **Colaboradores**         |                                                                             |
+---------------------------+-----------------------------------------------------------------------------+
| **Notas**                 | El componente se crea una sola vez, y existe solo una instancia de este en  |
|                           | sistema la cual persiste durante todo el tiempo.                            |
+---------------------------+-----------------------------------------------------------------------------+
| **Problemas**             |                                                                             |
+---------------------------+-----------------------------------------------------------------------------+

Sensor
------
+---------------------------+-----------------------------------------------------------------------------+
| **Componente**            | Sensor                                                                      |
+---------------------------+-----------------------------------------------------------------------------+
| **Responsabilidades**     | - Registrar medidas medioambientales y almacenarlas en el componente        |
|                           |   Base_de_datos.                                                            |
+---------------------------+-----------------------------------------------------------------------------+
| **Colaboradores**         | - **Componente:** Base_de_datos                                             |
+---------------------------+-----------------------------------------------------------------------------+
| **Notas**                 | Existen muchas instancias del componente sensor, sin embargo, cada una de   |
|                           | persiste una vez es creada.                                                 |
+---------------------------+-----------------------------------------------------------------------------+
| **Problemas**             |                                                                             |
+---------------------------+-----------------------------------------------------------------------------+

Sección de Interfaces
---------------------
En esta sección se describen y especifican los servicios o interfaces que provee el sistema.

Usuario
~~~~~~~~
+---------------------------+-----------------------------------------------------------------------------+
| **Interface**             | Usuario_controller                                                          |
+---------------------------+-----------------------------------------------------------------------------+
| **Descripción**           | Permite acceder, eliminar, crear y actualizar un usuario.                   |
+---------------------------+-----------------------------------------------------------------------------+
| **Operaciones**           | - **Operación:** usuario_index()                                            |
|                           | - **Ruta:** usuario                                                         |
|                           | - **Metodo:** GET                                                           |
|                           | - **Descripción:** Lista cada usuario con sus datos (nombre, correo)        |
+                           +-----------------------------------------------------------------------------+
|                           | - **Operación:** usuario_store( usuario_data )                              |
|                           | - **Ruta:** usuario                                                         |
|                           | - **Metodo:** POST                                                          |
|                           | - **Descripción:** Guarda todos los datos de un nuevo usuario               |
+                           +-----------------------------------------------------------------------------+
|                           | - **Operación:** usuario_show ( usuario id )                                |
|                           | - **Ruta:** usuario/{id}                                                    |
|                           | - **Metodo:** GET                                                           |
|                           | - **Descripción:** Muestra todos los datos del usuario especificado en el   |
|                           |   id                                                                        |
+                           +-----------------------------------------------------------------------------+
|                           | - **Operación:** usuario_destroy ( usuario id )                             |
|                           | - **Ruta:** usuario/{id}                                                    |
|                           | - **Metodo:** DELETE                                                        |
|                           | - **Descripción:** Elimina al usuario correspondiente al id                 |
+                           +-----------------------------------------------------------------------------+
|                           | - **Operación:** usuario_update ( usuario id, usuario new_data)             |
|                           | - **Ruta:** usuario                                                         |
|                           | - **Metodo:** PUT                                                           |
|                           | - **Descripción:** Actualiza los datos del usuario especificado en el id    |
+---------------------------+-----------------------------------------------------------------------------+
| **Protocolo**             | No existen restricciones en el orden de las operaciones                     |
+---------------------------+-----------------------------------------------------------------------------+
| **Notas**                 | Esta interface es provista en el componente servicios del frontend y el     |
|                           | componente servicios de la aplicación movil                                 |
+---------------------------+-----------------------------------------------------------------------------+
| **Problemas**             |                                                                             |
+---------------------------+-----------------------------------------------------------------------------+

Pregunta
~~~~~~~~
+---------------------------+-----------------------------------------------------------------------------+
| **Interface**             | Pregunta_controller                                                         |
+---------------------------+-----------------------------------------------------------------------------+
| **Descripción**           | Permite acceder, eliminar, crear, actualizar y listar por preguntas         |
|                           | aprobadas y no aprobadas.                                                   |
+---------------------------+-----------------------------------------------------------------------------+
| **Operaciones**           | - **Operación:** pregunta_index()                                           |
|                           | - **Ruta:** pregunta                                                        |
|                           | - **Metodo:** GET                                                           |
|                           | - **Descripción:** Lista cada pregunta con sus datos, ademas extrae las     |
|                           |   respuestas de cada pregunta                                               |
+                           +-----------------------------------------------------------------------------+
|                           | - **Operación:** pregunta_indexAprobados()                                  |
|                           | - **Ruta:** pregunta/aprobados                                              |
|                           | - **Metodo:** GET                                                           |
|                           | - **Descripción:** Lista cada pregunta *aprobada* con sus datos, además     |
|                           |   respuestas de cada pregunta                                               |
+                           +-----------------------------------------------------------------------------+
|                           | - **Operación:** pregunta_indexNoAprobados()                                |
|                           | - **Ruta:** pregunta/noaprobados                                            |
|                           | - **Metodo:** GET                                                           |
|                           | - **Descripción:** Lista cada pregunta *no aprobada* con sus datos.         |
+                           +-----------------------------------------------------------------------------+
|                           | - **Operación:** pregunta_store( pregunta_data )                            |
|                           | - **Ruta:** pregunta                                                        |
|                           | - **Metodo:** POST                                                          |
|                           | - **Descripción:** Guarda todos los datos de una nueva pregunta             |
+                           +-----------------------------------------------------------------------------+
|                           | - **Operación:** pregunta_show ( pregunta id )                              |
|                           | - **Ruta:** pregunta/{id}                                                   |
|                           | - **Metodo:** GET                                                           |
|                           | - **Descripción:** Muestra todos los datos de una pregunta especificada en  |
|                           |   el id                                                                     |
+                           +-----------------------------------------------------------------------------+
|                           | - **Operación:** pregunta_destroy ( pregunta id )                           |
|                           | - **Ruta:** pregunta/{id}                                                   |
|                           | - **Metodo:** DELETE                                                        |
|                           | - **Descripción:** Elimina la pregunta correspondiente al id                |
+                           +-----------------------------------------------------------------------------+
|                           | - **Operación:** usuario_update ( usuario id )                              |
|                           | -  **Ruta:** pregunta/aprobar/{id}                                          |
|                           | - **Metodo:** GET                                                           |
|                           | - **Descripción:** Cambia el estado de una pregunta *no aprobada* a         |
|                           |   *aprobada*.                                                               |
+---------------------------+-----------------------------------------------------------------------------+
| **Protocolo**             | No existen restricciones en el orden de las operaciones                     |
+---------------------------+-----------------------------------------------------------------------------+
| **Notas**                 | Esta interface es provista en el componente servicios del frontend y el     |
|                           | componente servicios de la aplicación movil                                 |
+---------------------------+-----------------------------------------------------------------------------+
| **Problemas**             |                                                                             |
+---------------------------+-----------------------------------------------------------------------------+


Respuesta
~~~~~~~~~
+---------------------------+-----------------------------------------------------------------------------+
| **Interface**             | Respuesta_controller                                                        |
+---------------------------+-----------------------------------------------------------------------------+
| **Descripción**           | Permite acceder, aprobar, eliminar, ademas de listar por respuestas no      |
|                           | aprobadas.                                                                  |
+---------------------------+-----------------------------------------------------------------------------+
| **Operaciones**           | - **Operación:** respuesta_indexNoAprobado()                                |
|                           | - **Ruta:** respuesta/noaprobados                                           |
|                           | - **Metodo:** GET                                                           |
|                           | - **Descripción:** Lista las respuestas no aprobadas con sus datos.         |
+                           +-----------------------------------------------------------------------------+
|                           | - **Operación:** respuesta_store( respuesta_data )                          |
|                           | - **Ruta:** respuesta                                                       |
|                           | - **Metodo:** POST                                                          |
|                           | - **Descripción:** Guarda todos los datos de una nueva respuesta            |
+                           +-----------------------------------------------------------------------------+
|                           | - **Operación:** respuesta_aprobar ( respuesta id )                         |
|                           | - **Ruta:** respuesta/aprobar/{id}                                          |
|                           | - **Metodo:** GET                                                           |
|                           | - **Descripción:** Permita aprobar una respuesta con la id especificada     |
+                           +-----------------------------------------------------------------------------+
|                           | - **Operación:** respuesta_destroy ( respuesta id )                         |
|                           | - **Ruta:** respuesta/{id}                                                  |
|                           | - **Metodo:** DELETE                                                        |
|                           | - **Descripción:** Elimina la respuesta correspondiente al id               |
+---------------------------+-----------------------------------------------------------------------------+
| **Protocolo**             | No existen restricciones en el orden de las operaciones                     |
+---------------------------+-----------------------------------------------------------------------------+
| **Notas**                 | Esta interface es provista en el componente servicios del frontend y el     |
|                           | componente servicios de la aplicación movil                                 |
+---------------------------+-----------------------------------------------------------------------------+
| **Problemas**             |                                                                             |
+---------------------------+-----------------------------------------------------------------------------+

Medida
~~~~~~
+---------------------------+-----------------------------------------------------------------------------+
| **Interface**             | Medida_controller                                                           |
+---------------------------+-----------------------------------------------------------------------------+
| **Descripción**           | Permite acceder, guardar, listar y encontrar medidas entre un rango de      |
|                           | fechas.                                                                     |
+---------------------------+-----------------------------------------------------------------------------+
| **Operaciones**           | - **Operación:** medida_index()                                             |
|                           | - **Ruta:** medida                                                          |
|                           | - **Metodo:** GET                                                           |
|                           | - **Descripción:** Lista todas las mediciones registradas.                  |
+                           +-----------------------------------------------------------------------------+
|                           | - **Operación:** medida_indexOf( Rango rango_fecha )                        |
|                           | - **Ruta:** medida/range                                                    |
|                           | - **Metodo:** POST                                                          |
|                           | - **Descripción:** Lista todas las medidas encontradas en el rango de       |
|                           |   fechas establecido.                                                       |
+                           +-----------------------------------------------------------------------------+
|                           | - **Operación:** medida_store( medida_data )                                |
|                           | - **Ruta:** medida                                                          |
|                           | - **Metodo:** POST                                                          |
|                           | - **Descripción:** Guarda todos los datos de una nueva medida               |
+                           +-----------------------------------------------------------------------------+
|                           | - **Operación:** medida_show ( medida id )                                  |
|                           | - **Ruta:** medida/{id}                                                     |
|                           | - **Metodo:** GET                                                           |
|                           | - **Descripción:** permite obtener la medida correspondiente al id          |
+---------------------------+-----------------------------------------------------------------------------+
| **Protocolo**             | No existen restricciones en el orden de las operaciones                     |
+---------------------------+-----------------------------------------------------------------------------+
| **Notas**                 | Esta interface es provista en el componente servicios del frontend y el     |
|                           | componente servicios de la aplicación movil                                 |
+---------------------------+-----------------------------------------------------------------------------+
| **Problemas**             |                                                                             |
+---------------------------+-----------------------------------------------------------------------------+


Grafico
~~~~~~~
+---------------------------+-----------------------------------------------------------------------------+
| **Interface**             | Grafico_medidas                                                             |
+---------------------------+-----------------------------------------------------------------------------+
| **Descripción**           | Permite graficar las medidas registradas, cambiar el rango de fechas a      |
|                           | a partir de una lista de medidas                                            |
+---------------------------+-----------------------------------------------------------------------------+
| **Operaciones**           | - **Operación:** grafico_setMedidas()                                       |
|                           | - **Descripción:** Permite modificar las medidas que se mostrarán en el     |
|                           |   gráfico.                                                                  |
+---------------------------+-----------------------------------------------------------------------------+
| **Protocolo**             | No existen restricciones en el orden de las operaciones                     |
+---------------------------+-----------------------------------------------------------------------------+
| **Notas**                 | Esta interface es provista en el componente de Forntend, especificamente en |
|                           | el sub-componente *componentes visuales*.                                   |
+---------------------------+-----------------------------------------------------------------------------+
| **Problemas**             |                                                                             |
+---------------------------+-----------------------------------------------------------------------------+
