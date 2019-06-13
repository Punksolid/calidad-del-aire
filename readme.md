## Endpoints
La app tiene algunos endpoints de consumo básico como.
# Lectura de registros de minuto a minuto.
`https://api.calidaddelaire.org.mx/api/v1/registries`
Por default devuelve los ultimos tres días aceptando los parametros
`?start_date=2018/11/30%2000:00:01&end_date=2019/01/30%2000:00:01`
start_date y end_date donde ambos campos son date time. Si el array viene vacío es que no hay datos.

#Calidad de datos
Este enpoint lista los días y la cantidad de registros de ese día del año en curso
`https://api.calidaddelaire.org.mx/api/v1/uploaded_resume?year=2019`
donde el query param de `year` es el año que se quiere revisar. Si revisan el año 2018 pueden ver los unicos dos días ya precargados. Cada día devería mostrar una cantidad de 1440 registros que son los minutos que hay en un día. 
##

## Instalar en local

```
git clone https://github.com/Punksolid/calidad-del-aire.git
cd calidad-del-aire
composer update

```
el siguiente paso es configurar una base de datos mysql por ejemplo `calidad_del_aire_db`

luego entrar al archivo .env del root y configurar los keys que comienzan con `DB_`

el siguiente paso es recrear la base de datos corriendo las migraciones
```
php artisan migrate
```

Los pasos anteriores son los necesarios para correr el backend, si todo está correcto ya podrían correr los test unitarios desde el root con
```
/vendor/bin/phpunit
```
Si todo está bien serán todas las pruebas pasadas.
El ultimo paso para dejar activo el servidor de pruebas es correr 
```
php artisan serve
```
El cual correrá un servidor provisional en `http://localhost:8000`
La segunda parte es correr el frontend. El frontend es una aplicación completamente separada que está copiada en el mismo repositorio que en el backend bajo el directorio `/frontend` 
para instalarlo es necesario lo siguiente
```
cd /frontend
npm update
npm run watch 
```

el directorio frontend debe tener a su vez un archivo `.env` con el siguiente valor
```
VUE_APP_BACKEND_URL=http://localhost:8000

```
donde la url puede apuntar a su localhost o directamente al backend que está montado en estos momentos. `https://api.calidaddelaire.org.mx`

Si todo está bien podrían correr el servidor en localhost y subir los archivos reales de pruebas otorgados por el Gobierno del Estado de Sinaloa, que se encuentran en el directorio
`/storage/app/aire_culiacan.xls`

## Contributing
Revisa por favor si puedes contribuir primero con los issues solicitados en el apartado de issues del [repositorio en github](https://github.com/Punksolid/calidad-del-aire/labels/help%20wanted)
Considera contribuir al proyecto de cualquier forma. Un buen inicio es la documentación o agregando tu username de twitter o github en este documento. Las modificaciones son aceptadas por pull request en el siguiente repositorio. [Calidad del Aire](https://github.com/punksolid/calidad-del-aire).

## Security Vulnerabilities

Si descubres alguna falla de seguridad favor de twittear a punksolid @ twitter

## Tecnologias

PHP Javascript Laravel Vuejs
