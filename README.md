
# Desafio Bsale backend
Desarrollado por Agustin Gonzalorena.

En este proyecto se derrolla una api restfull creada en Php
y MySQL. En la cual se obtendran las solicitudes en formato JSON. 

Este proyecto esta deployado en Heroku:

    https://bsale-gonzalorena.herokuapp.com/api/products



## Productos
- Para obtener los Productos se tendra que utilizar el siguiente endpoint:
        
        /api/products

    utilizando el metodo GET.

- Para obtener un Producto se tendra que utilizar mediante GET:

        /api/products/3

    en este ejemplo se utiliza el 3 como id, pero en lugar del 3
    se podria remplazar por cualquir id de algun producto existente.


## Categorias
- Para obtener todas las Categorias se debera utilizar el siguiente endpoint:

        /api/categories

    utilizando el metodo GET.
## Filtros
- Se pueden filtrar los productos por categoria mediante el siguiente endpoint, metodo GET:
        
        /api/products?filter=2

    en la variable GET filter se tendra que indicar el ID de la categoria a filtrar

- Tambien se podra filtrar productos mediante un search, metodo GET:

        /api/products?search=ron
    
    el cual buscara en los nombres de los productos y los nombres de las categorias.