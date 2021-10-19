<template>
<div class="d-flex justify-content-center mt-5">
    <div class="card p-3" style="width: 18rem;">
    <div class="columns align-content-end">
        <form >
            <div class="form-group ">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Ingrese email">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
            </div>
            <button type="submit" class="btn btn-primary" @click.prevent="$router.go(-1)">Inicar Sesion</button>
        </form>
    </div>
    </div>
</div>
</template>
