Propósito del Sistema
=================================
Es fundamental tener claro lo que el sistema debe hacer y cumplir. Es por esto que a continuación se describe el contexto del problema, la vision y los objetivos de este.

Contexto y Vision
--------------
El sistema construido pretende ofrecer al usuario una forma sencilla y organizada de ver datos de temperatura y humedad en la ciudad de Temuco - Chile. Disponer de graficos y tablas interactivas hacen al sitio web mucho mas agradable de usar, dandole la oportunidad al usuario de aplicar diferentes filtros que permitan agrupar los datos de varias maneras. Por otro lado, el sitio web ofrece al usuario poder realizar preguntas especificas con respecto al clima en la ciudad, que son visibles para todos, las cuales pueden ser respondidas por cualquier otro usuario.

Objetivos
--------------
1. Permitir la visualización organizada de tanto temperatura como humedad en distintos puntos de la ciudad de Temuco desde el año 2004 hasta la fecha.
2. Mostrar datos climaticos categorizados por fecha (dia, semana y mes).
3. Permitir la inserción de preguntas en el sitio web y que estas puedan ser respondidas por otros usuarios.

Historias de Usuario
--------------
Para representar de mejor manera lo que se puede hacer con el sistema se definen algunas historias de usuario que muestran los pasos que puede seguir un usuario cualquiera.

HU Usuario Web 1: El usuario busca conocer la temperatura y humedad de la semana pasada.
HU Usuario Web 2: El usuario desea responder una pregunta hecha por un usuario.
HU Usuario Web 3: El usuario busca conocer las temperaturas mas altas de un mes en especifico.

HU Usuario Móvil 1: El usuario desea hacer una pregunta sobre el clima en Temuco.
HU Usuario Móvil 2: El usuario busca conocer si el dia de hoy hay restricción o no.
HU Usuario Móvil 3: El usuario desea eliminar una pregunta que ya hizo.

HU Usuario Moderador 1: El moderador desea conocer cuantas preguntas se hicieron en un dia.
HU Usuario Moderador 2: El moderador desea eliminar los comentarios de otro usuario.

Selección de Historias de Usuario
--------------
Para la selección de las historias de usuarios mas apropiadas se consideraran 4 aspectos: 
**Prioridad:** Indica que tan importante es la historia para el sistema. Va del 1 al 5 (1 = Alta Prioridad, 5 = Baja Prioridad)
**Riesgo:** Indica posibles riesgos que pueden ocurrir a futuro con la historia. Va del 1 al 5 (1 = Bajo Riesgo, 5 = Alto Riesgo)
**Tiempo:** Indica que tanto tiempo se le debe dedicar a implementar la historia. Va del 1 al 5 (1 = Baja cantidad de Tiempo, 5 = Alta cantidad de Tiempo)
**Dificultad:** Indica la dificultad de implementación de la historia. Va del 1 al 5 (1 = Baja Dificultad, 5 = Alta Dificultad)

Historia de Usuario 1:
~~~~~~~~~~~~~
+---------------------------+-----------------------------------------------------------------------------+
| **Numero:** 1             | **Usuario:** Usuario Web                                                    |
+---------------------------+-----------------------------------------------------------------------------+
| **Nombre Historia:** 
+---------------------------+-----------------------------------------------------------------------------+
| Usuario Móvil             | - Usuario que ingresa al sitio web mediante un telefono móvil.              |
|                           | - Puede visualizar datos, hacer y responder preguntas.                      |
+---------------------------+-----------------------------------------------------------------------------+

