> [!IMPORTANT]
> Cocinemos >:D


Voy a intentar una fumada en el que aplicaremos node.js para trabajar con js en el backend y asi intentar
realizar el web srcaping deseado PASOS A REALIZAR:
>1- INSTALAMOS NodeJS:para eso teneis en recursos su instalador, le dais que si a todo y lo verificais cuando termines TANTO
EN EL TERMINAL DE VUESTRO ORDENADOR COMO EN EL DE VISUAL STUDIO: con el comando " node -v ", si os aparece los numerines guay 
si no me avisais. 
>2- INICIAMOS EL PROYECTO: con el comando:npm init -y.
> [!CAUTION]
> SI NO OS DEJA ES PORQUE SOIS UNOS PRINGAOS Y NO TENEIS PERMISOS EN VUESTRO ORDENADOR.
SOLUCION(en PowerShell):
Get-ExecutionPolicy:comprobad que pone "Restricted",si es asi sois unos pringaos y aseguramos que es el error
Set-ExecutionPolicy Unrestricted -$cope CurrentUser
Get-ExecutionPolicy:hecho este set deberia estar solucionado, probad a volver a iniciar el proyecto node

>3- INSTALAMOS DEPENDENCIA PLAYWRIGHT: 

> [!TIP]
> OBJETIVO: Json "products", cada unidad estaria almacenado tal que product:{tittle,description,price,image,category,store}

>4-Por lo que veo para ejecutar y ver si funciona bien el node(index.mjs) debes verlo mediante el comando
node index.mjs
> [!TIP]
> Para guardar los datos node a nuestras bbdd vamos a instalar mysql:npm install mysql2
