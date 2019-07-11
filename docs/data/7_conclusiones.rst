Conclusión
=================================
Durante la realización del proyecto hemos podido poner en práctica los conocimientos que desarrollamos durante todo el semestre sobre arquitectura de software. Una de las bases que se dieron en el ramo fue la discusión y durante el proyecto aportó en gran medida para poder tomar decisiones consensuadas. 

La arquitectura de software nos permitió ser metódicos, ordenados y tener una guía desde el comienzo para el desarrollo de la aplicación. Permitiendo calcular los tiempos y recursos necesarios para poder completar el proyecto.

Ventajas del Sistema
~~~~~~~~~~~~~~~~~~~~
La aplicación se desarrollo sobre una arquitectura RESTful en PHP utilizando el Framework Laravel para el Backend y el Framework Angular para el Frontend. A continuación, se listan algunas de sus ventajas y desventajas.

Ventajas de REST.
~~~~~~~~~~~~~~~~~~~~

1. Separación cliente servidor, como pasan a ser sistemas independientes que solo se comunican a través de un lenguaje de intercambio como JSON se puede desarrollar el proyecto en equipos autónomos uno de otro.
2. Independencia de tecnologías y lenguajes, si en algún momento se quiere añadir un nuevo sistema que necesite comunicarse con el actual se puede hacer con facilidad por el estándar que implica el uso de REST.
3. Tolerancia al cambio, como solo se necesita preocuparse por el nexo entre el cliente y el servidor se pueden hacer cambios en los lenguajes, servidores, base de datos, etc. mientras se mantengan los datos de la forma que corresponda.

Desventajas de REST.
~~~~~~~~~~~~~~~~~~~~

1. Como no mantiene estados hay que montar una infraestructura propia para poder conservar el conjunto de la aplicación, por ejemplo con el envió de tokens para autentificarse frente al servidor.

Ventajas de usar Laravel.
~~~~~~~~~~~~~~~~~~~~

1. Cuenta con un administrador de dependencias, lo que permite administrar los paquetes externos que se decidan implementar en el proyecto.
2. Incluye Artisan, interfaz de comandos para ejecutar diferentes tareas desde la consola.
3. Facilidad de mantenimiento versus otros Framework.
4. Fácil validación de formularios a través de la librería Validator.

Desventajas de usar Laravel.
~~~~~~~~~~~~~~~~~~~~

1. Ejecución lenta, el uso de un frameworks PHP agrega complejidad y sobrecarga en forma de clases y bibliotecas cargas antes de que su código sea llamado.
2. Visibilidad y control limitados, al usar un framework el nivel de abstracción aumenta ya que aunque muchas partes o plantillas del framework son pensadas a ser personalizadas, no se tiene mucho control sobre el núcleo del framework y las bibliotecas principales.


Ventajas de usar VueJS
~~~~~~~~~~~~~~~~~~~~
1.	El Framework trabaja con componentes independientes que pueden ser integrados en cualquier aplicación web.
2.	Tiene una documentación completa y con muchos ejemplos.
3.	Flexibilidad en cada componente, cada uno de estos tiene un template HTML, un script y un css propio.
4.	Su curva de aprendizaje es baja, por lo cual es bueno para empezar en el desarrollo de aplicaciones web.
5.	Es una solución liviana, el tamaño del proyecto en Kbs del core es bajo, pero aumenta cuando el proyecto escala demasiado.
6.	Posee Data Binding, el cual sincroniza automáticamente el modelo con el DOM.

Desventajas de usar VueJS
~~~~~~~~~~~~~~~~~~~~
1.	Falta de maduración respecto a otros Framworks como AngularJS y ReactJS.
2.	Administrar aplicaciones complejas, de una gran cantidad de componentes,  puede ser complicado. Esto se debe a que en el tema de componentes se pueden organizar como uno quiera dentro de la carpeta del proyecto.
3.	Riesgo de mantenimiento del Framwork ya que este es mantenido por su creador y un grupo pequeño.
