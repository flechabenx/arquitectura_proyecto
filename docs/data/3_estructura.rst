Estructura
=================================

Visión general
--------------

.. image:: images/vision_general.jpg
    :scale: 60%
    :align: center

El sistema se divide en 2 componentes, un backend y un Frontend. Además de trabajar en conjunto con un motor de base de datos y un plugin comercial para el manejo de las preguntas

El backend es una API que recibe y maneja peticiones HTTP considerándose un servicio RESTful con una arquitectura orientada a servicios. Cuenta con un manejador de rutas que asigna las peticiones a los controladores correspondientes, aparte de asignarlo por controlador la asignación se realiza según el verbo de la petición (GET, PUT) a las diferentes funciones dentro de cada controlador. El backend accede a los registros de la base de datos a través de un ORM que sigue el patrón arquitectural de registro activo, el uso del ORM permite la independencia del backend en relación al motor de la base de datos.

los modelos permiten relacionar la estructura de la base de datos para que el ORM pueda detectar automáticamente las tablas y sus atributos. Las consultas a la base de datos se efectúan a través de un constructor de consultas, este constructor de consultas utiliza el enlace de parámetros PDO (PHP Data Objects) para proteger su aplicación contra ataques de inyección de SQL.

El Frontend es una aplicación web de página única (SPA por sus siglas en ingles) esto quiere decir que cada componente se carga una vez, ya sea los códigos HTML, JavaScript o CSS. el resto de recursos se carga dinámicamente según la pagina lo requiera 


Descripcion de componentes
--------------

a continuacion se describen los componentes de la arquitectura

Componentes Backend
--------------

+---------------------------+-----------------------------------------------------------------------------+
| **Componente**            | Backend                                                                     |
+---------------------------+-----------------------------------------------------------------------------+
| **Responsabilidades**     | - recibe y maneja las peticiones enviadas desde el frontend                 |
|                           |                                                                             |
+---------------------------+-----------------------------------------------------------------------------+
| **Colaboradores**         | - **Componente:** frontend                                                  |
|                           | - **Componente:** Base_de_Datos                                             |
+---------------------------+-----------------------------------------------------------------------------+
| **Notas**                 | El componente se crea una sola vez y persiste durante todo el tiempo.       |
|                           |                                                                             |
+---------------------------+-----------------------------------------------------------------------------+
| **Problemas**             |                                                                             |
+---------------------------+-----------------------------------------------------------------------------+


+---------------------------+-----------------------------------------------------------------------------+
| **Componente**            | Backend_Router                                                              |
+---------------------------+-----------------------------------------------------------------------------+
| **Responsabilidades**     | - recibe y reparte hacia los controladores las peticiones enviadas desde el |
|                           |   frontend                                                                  |
+---------------------------+-----------------------------------------------------------------------------+
| **Colaboradores**         | - **Componente:** Cliente_HTTP                                              |
|                           | - **Componente:** Controladores                                             |
+---------------------------+-----------------------------------------------------------------------------+
| **Notas**                 | El componente se crea una sola vez y persiste durante todo el tiempo.       |
|                           |                                                                             |
+---------------------------+-----------------------------------------------------------------------------+
| **Problemas**             |                                                                             |
+---------------------------+-----------------------------------------------------------------------------+

+---------------------------+-----------------------------------------------------------------------------+
| **Componente**            | Backend_Controladores                                                       |
+---------------------------+-----------------------------------------------------------------------------+
| **Responsabilidades**     | - reciben solicitudes y en base a eso generar una respuesta dependiendo     |
|                           |   del tipo de solicitud                                                     |
+---------------------------+-----------------------------------------------------------------------------+
| **Colaboradores**         | - **Componente:** Cliente_HTTP                                              |
|                           | - **Componente:** Controladores                                             |
+---------------------------+-----------------------------------------------------------------------------+
| **Notas**                 | El componente se crea una sola vez y persiste durante todo el tiempo.       |
|                           |                                                                             |
+---------------------------+-----------------------------------------------------------------------------+
| **Problemas**             |                                                                             |
+---------------------------+-----------------------------------------------------------------------------+

+---------------------------+-----------------------------------------------------------------------------+
| **Componente**            | Backend_Eloquent                                                            |
+---------------------------+-----------------------------------------------------------------------------+
| **Responsabilidades**     | - servir como interfaz entre la base de datos y los controladores,          |
|                           |   ayuda a mantener la consitencia de los datos                              |
+---------------------------+-----------------------------------------------------------------------------+
| **Colaboradores**         | - **Componente:** Cliente_HTTP                                              |
|                           | - **Componente:** Controladores                                             |
+---------------------------+-----------------------------------------------------------------------------+
| **Notas**                 | El componente se crea una sola vez y persiste durante todo el tiempo.       |
|                           |                                                                             |
+---------------------------+-----------------------------------------------------------------------------+
| **Problemas**             |                                                                             |
+---------------------------+-----------------------------------------------------------------------------+


+---------------------------+-----------------------------------------------------------------------------+
| **Componente**            | Backend_Modelos                                                             |
+---------------------------+-----------------------------------------------------------------------------+
| **Responsabilidades**     | - facilitar la comprension de la estructura y forma de lo datos a obtener   |
|                           |   u almacenar en la base de datos                                           |
+---------------------------+-----------------------------------------------------------------------------+
| **Colaboradores**         | - **Componente:** Eloquent                                                  |
|                           |                                                                             |
+---------------------------+-----------------------------------------------------------------------------+
| **Notas**                 | El componente se crea una sola vez y persiste durante todo el tiempo.       |
|                           |                                                                             |
+---------------------------+-----------------------------------------------------------------------------+
| **Problemas**             |                                                                             |
+---------------------------+-----------------------------------------------------------------------------+

Componente Base de Datos
--------------

+---------------------------+-----------------------------------------------------------------------------+
| **Componente**            | Backend_Base_de_Datos                                                       |
+---------------------------+-----------------------------------------------------------------------------+
| **Responsabilidades**     | - almacenar todos los registros a los que el usuario puede acceder          |
+---------------------------+-----------------------------------------------------------------------------+
| **Colaboradores**         | - **Componente:** Eloquent                                                  |
|                           |                                                                             |
+---------------------------+-----------------------------------------------------------------------------+
| **Notas**                 | El componente se crea unicamente una vez y la instancia se mantiene durante |
|                           | todo el tiempo.                                                             |
+---------------------------+-----------------------------------------------------------------------------+
| **Problemas**             |                                                                             |
+---------------------------+-----------------------------------------------------------------------------+

Componentes Frontend
--------------

+---------------------------+-----------------------------------------------------------------------------+
| **Componente**            | Frontend                                                                    |
+---------------------------+-----------------------------------------------------------------------------+
| **Responsabilidades**     | - despliega informacion al usuario y responde a sus entradas                |
|                           |                                                                             |
+---------------------------+-----------------------------------------------------------------------------+
| **Colaboradores**         | - **Componente:** Backend                                                   |
|                           | - **Componente:** Plugin_comentarios                                        |
+---------------------------+-----------------------------------------------------------------------------+
| **Notas**                 | El componente se crea cada una solo vez y persiste durante el tiempo        |
|                           |                                                                             |
+---------------------------+-----------------------------------------------------------------------------+
| **Problemas**             |                                                                             |
+---------------------------+-----------------------------------------------------------------------------+

+---------------------------+-----------------------------------------------------------------------------+
| **Componente**            | Frontend_Cliente_HTPP                                                       |
+---------------------------+-----------------------------------------------------------------------------+
| **Responsabilidades**     | - realizar peticiones HTTP hacia el backend                                 |
|                           |                                                                             |
+---------------------------+-----------------------------------------------------------------------------+
| **Colaboradores**         | - **Componente:** Backend_Router                                            |
|                           |                                                                             |
+---------------------------+-----------------------------------------------------------------------------+
| **Notas**                 | El componente se crea una vez y persiste mientras el frontend se encuentre  |
|                           | instanceado                                                                 |
+---------------------------+-----------------------------------------------------------------------------+
| **Problemas**             |                                                                             |
+---------------------------+-----------------------------------------------------------------------------+

+---------------------------+-----------------------------------------------------------------------------+
| **Componente**            | Frontend_Componentes_visuales                                               |
+---------------------------+-----------------------------------------------------------------------------+
| **Responsabilidades**     | - despliega toda la informacion al usuario, contienen y encapsulan lo que   |
|                           |   el usuario ve y con lo que interactua                                     |
+---------------------------+-----------------------------------------------------------------------------+
| **Colaboradores**         | - **Componente:** Backend_Router                                            |
|                           |                                                                             |
+---------------------------+-----------------------------------------------------------------------------+
| **Notas**                 | El componente se crea se crea una vez y persiste durante la ejecucion del   |
|                           | sistema                                                                     |
+---------------------------+-----------------------------------------------------------------------------+
| **Problemas**             |                                                                             |
+---------------------------+-----------------------------------------------------------------------------+

Componentes Comentarios
--------------

+---------------------------+-----------------------------------------------------------------------------+
| **Componente**            | Comentarios                                                                 |
+---------------------------+-----------------------------------------------------------------------------+
| **Responsabilidades**     | - permite realizar preguntas y contestar las que otros usuaros han hecho    |
|                           |                                                                             |
+---------------------------+-----------------------------------------------------------------------------+
| **Colaboradores**         | - **Componente:** Frontend_Componentes_visuales                             |
|                           |                                                                             |
+---------------------------+-----------------------------------------------------------------------------+
| **Notas**                 | El componente se crea se crea una vez y persiste durante la ejecucion del   |
|                           | sistema                                                                     |
+---------------------------+-----------------------------------------------------------------------------+
| **Problemas**             |                                                                             |
+---------------------------+-----------------------------------------------------------------------------+

+---------------------------+-----------------------------------------------------------------------------+
| **Componente**            | Comentarios_Plugin_Comentarios                                              |
+---------------------------+-----------------------------------------------------------------------------+
| **Responsabilidades**     | - permite implementar e integrar el plugin en los componentes visuales      |
|                           |                                                                             |
+---------------------------+-----------------------------------------------------------------------------+
| **Colaboradores**         | - **Componente:** Frontend_Componentes_visuales                             |
|                           |                                                                             |
+---------------------------+-----------------------------------------------------------------------------+
| **Notas**                 | El componente se crea se crea una vez y persiste durante la ejecucion del   |
|                           | sistema                                                                     |
+---------------------------+-----------------------------------------------------------------------------+
| **Problemas**             |                                                                             |
+---------------------------+-----------------------------------------------------------------------------+

+---------------------------+-----------------------------------------------------------------------------+
| **Componente**            | Comentarios_Autentificacion                                                 |
+---------------------------+-----------------------------------------------------------------------------+
| **Responsabilidades**     | - permite autenticarse en la pagina para poder interactuar con las preguntas|
|                           |   y respuestas                                                              |
+---------------------------+-----------------------------------------------------------------------------+
| **Colaboradores**         | - **Componente:** Frontend_Componentes_visuales                             |
|                           |                                                                             |
+---------------------------+-----------------------------------------------------------------------------+
| **Notas**                 | El componente se crea se crea una vez y persiste durante la ejecucion del   |
|                           | sistema                                                                     |
+---------------------------+-----------------------------------------------------------------------------+
| **Problemas**             |                                                                             |
+---------------------------+-----------------------------------------------------------------------------+

+---------------------------+-----------------------------------------------------------------------------+
| **Componente**            | Comentarios_Administracion_Comentarios                                      |
+---------------------------+-----------------------------------------------------------------------------+
| **Responsabilidades**     | - permite administrar las preguntas, ya sea restrigiendo palabras o         |
|                           |   a usuarios en especifico                                                  |
+---------------------------+-----------------------------------------------------------------------------+
| **Colaboradores**         | - **Componente:** Comentarios_Plugin_Comentarioos                           |
|                           |                                                                             |
+---------------------------+-----------------------------------------------------------------------------+
| **Notas**                 | El componente existe ajeno a la ejecucion del sistema                       |
|                           |                                                                             |
+---------------------------+-----------------------------------------------------------------------------+
| **Problemas**             |                                                                             |
+---------------------------+-----------------------------------------------------------------------------+

Sección de Interfaces
---------------------
En esta sección se describen y especifican los servicios o interfaces que provee el sistema.

Medicion
~~~~~~~~
+---------------------------+-----------------------------------------------------------------------------+
| **Interface**             | medicionController                                                          |
+---------------------------+-----------------------------------------------------------------------------+
| **Descripción**           | Permite acceder a mediciones, tanto de clima como de contaminacion          |
+---------------------------+-----------------------------------------------------------------------------+
| **Operaciones**           | - **Operación:** getMediciones( limite, fecha, estacion)                    |
|                           | - **Ruta:** api/medicion/data                                               |
|                           | - **Metodo:** GET                                                           |
|                           | - **Descripción:** Muestra las mediciones segun estacion y limite de acuerdo|
|                           |   a la fecha dada                                                           |
+                           +-----------------------------------------------------------------------------+
|                           | - **Operación:** getMp2(estacion)                                           |
|                           | - **Ruta:** api/medicion/mp2                                                |
|                           | - **Metodo:** GET                                                           |
|                           | - **Descripción:** obtiene el ultimo registro de mp2,5                      |
+                           +-----------------------------------------------------------------------------+
|                           | - **Operación:** getLastData(estacion)                                      |
|                           | - **Ruta:** api/medicion/lastdata                                           |
|                           | - **Metodo:** GET                                                           |
|                           | - **Descripción:** obtiene los ultimos datos de humedad y temperatura       |
|                           |                                                                             |
+                           +-----------------------------------------------------------------------------+
|                           | - **Operación:** getGases(estacion)                                         |
|                           | - **Ruta:** api/medicion/gas                                                |
|                           | - **Metodo:** GET                                                           |
|                           | - **Descripción:** 0btiene lo ultimos registros de gases segun la estacion  |
+---------------------------+-----------------------------------------------------------------------------+
| **Protocolo**             | No existen restricciones en el orden de las operaciones                     |
+---------------------------+-----------------------------------------------------------------------------+
| **Notas**                 | Esta interface es provista por el componente Controladores del backend      |
|                           |                                                                             |
+---------------------------+-----------------------------------------------------------------------------+
| **Problemas**             |                                                                             |
+---------------------------+-----------------------------------------------------------------------------+
