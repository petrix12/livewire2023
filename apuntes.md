# Aprende Laravel Livewire desde cero
+ **URL**: https://codersfree.com/cursos/aprende-laravel-livewire-desde-cero
+ **Componentes tailwind**: https://tailwindcomponents.com/components
+ **Notificaciones SweetAlert2**: https://sweetalert2.github.io

## PARTE I: Crear proyecto
1. Crear proyecto (con livewire y phpunit):
    + $ laravel new livewire2023 --jet
3. Crear base de datos **livewire**.
4. Ajustar variables de entorno en **.env**.
4. Ejecutar migraciones:
    + $ php artisan migrate
5. Ejecutar el compilador de VITE:
    + $ npm run dev

## PARTE II: Listar registros
1. Crear componente livewire:
    + $ php artisan make:livewire ShowPosts
2. Diseñar vista **resources\views\livewire\show-posts.blade.php**.
3. Modificar vista **resources\views\dashboard.blade.php** para que invoque a nuestro primer componente livewire.
4. Modificar el archivo de rutas **routes\web.php** para que la ruta **dashboard** sea controlada por nuestro nuevo componente.
5. Crear modelo **Post**:
    + $ php artisan make:model Post -mf
6. Establecer campos de la table **posts** en su respectiva migración **database\migrations\2023_04_29_061509_create_posts_table.php**
7. Programar la creación de datos de prueba en el factory y en el seeder:
    + **database\factories\PostFactory.php**.
    + **database\seeders\DatabaseSeeder.php**.
8. Habilitar asignación masiva del modelo **Post**.
9. Ejecutar migraciones y seeder:
    + $ php artisan migrate
    + $ php artisan db:seed
10. Programar el controlador del componente livewire **app\Http\Livewire\ShowPosts.php**.
11. Crear componente blade **resources\views\components\propios\table.blade.php**.
12. Descargar la libreria de **Font Awesome**:
    + https://fontawesome.com/download
    + Descomprimirla y colocarla en la siguiente ubicación:
        + public\vendor\fontawesome-free-6.4.0-web
    + Modificar el layout **resources\views\layouts\app.blade.php** para indicarle que haga uso de la libreria de **Font Awesome**.

## PARTE III: Añadir registro
1. Crear componente para añadir registros:
    + $ php artisan make:livewire create-post
2. Diseñar el componente vista **resources\views\livewire\create-post.blade.php**.
3. Programar el componente controlador **app\Http\Livewire\CreatePost.php**.
4. Crear archivo de estilos **resources\css\form.css**.
5. Importar los nuevos estilos en **resources\css\app.css**.

## PARTE IV: Notificaciones
1. Agregar el CDN de **sweetalert2** en la plantilla principal **resources\views\layouts\app.blade.php**.
2. Agregar un script que escuche también en la plantilla principal, para que desencadene una notificación cuando se emita un evento **alert**.
3. Indicar el componente **CreatePost** que emita el evento **alert** una vez creado un registro.

## PARTE V: Editar registro
1. Crear componente para editar registro:
    + $ php artisan make:livewire edit-post
2. Programar controlador livewire **app\Http\Livewire\EditPost.php**.
3. Diseñar vista livewire **resources\views\livewire\edit-post.blade.php**.
4. Crear archivo de estilos **resources\css\buttons.css**.
5. Importar los nuevos estilos en **resources\css\app.css**.

## PARTE VI: Refactory para presindir de los componente CreatePost y EditPost
1. Modificar el controlador del componente livewire


 