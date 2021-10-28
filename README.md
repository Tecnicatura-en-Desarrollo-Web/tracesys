![Image text](https://github.com/Tecnicatura-en-Desarrollo-Web/tracesys/blob/master/resources/img/LogoTracesys.png)

# Sistema de Trazabilidad - TraceSYS

Un sistema encargado en el seguimiento de trazabilidad de productos destinados a reparacion dentro de una misma empresa, pasando por distintas etapas las cuales se encargaran de administrar, diagnosticar, reparar y testar dicho producto para la finalizacion del circuito.

## Trabajo final de la Tecnicatura en Desarrollo Web

### _Universidad Nacional del Comahue_

## Instalacion

Este proyecto requiere tener instalado [Node.js](https://nodejs.org/), [Composer](https://getcomposer.org/)

Instalar las dependecias

```sh
cd tracesys
npm i
composer i
```

Una vez instaladas las dependecias debemos, por una parte ejecutar el backend

```sh
bin/cake server
```

Luego en otra terminal, levantar VueJS en modo dev

```sh
npm run watch
```

Seguramente querramos iniciar a probar el sistema pero para tal cuestion, debemos crear la base de datos con el nombre 'tracesys' y luego hacer la migracion de las tablas

```sh
bin/cake migrations migrate
```

### Integrantes:

> Jonathan Rios
> Franco Rodriguez
> Maximiliano Villalba

# Catedras

### Trabajo Final:

> Daniel Doltz
> Mauro Sagripanti

### Framework e Interoperabilidad:

> Rafeala Mazalu
> Sergio Cotal
