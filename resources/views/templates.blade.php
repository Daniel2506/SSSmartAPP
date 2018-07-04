<script type="text/template" id="add-user-tpl">
    <div class="row">
        <div class="form-group col-sm-4">
            <label>Nombre competo</label>
            <input type="text" name="user_name"  class="form-control input-sm input-toupper" placeholder="Nombre"value="<%- user_name %>" required>
        </div>
        <div class="form-group col-sm-4"> <br>
            <input type="text" name="user_lastname"  class="form-control input-sm input-toupper" placeholder="Apellidos"value="<%- user_lastname %>" required>
        </div>
        <div class="form-group col-sm-4">
            <label>Dirección</label>
            <input type="text" name="user_address"  class="form-control input-sm" placeholder="Dirección"value="<%- user_address %>">
        </div>
    </div>

    <div class="row">
        <div class="form-group col-sm-4">
            <label>Teléfono</label>
            <input type="text" name="user_telephone"  class="form-control" placeholder="Teléfono"value="<%- user_telephone %>">
        </div>
        <div class="form-group col-sm-5">
            <label>Email</label>
            <input type="email" name="user_email" class="form-control" placeholder="ejemplo@gmail.com" value="<%- user_email %>">
        </div>
    </div>
    <div class="row">
        <div class="form-group col-sm-6">
            <label>Usuario</label>
            <input type="text" name="username" class="form-control input-sm" placeholder="Nombre usuario" value="<%- username %>" required>
        </div>
        <div class="form-group col-sm-3">
            <label>Contraseña</label>
            <input type="password" name="password" class="form-control input-sm" required>
        </div>
        <div class="form-group col-sm-3">
            <label>Confirme Contraseña</label>
            <input type="password" name="password_confirmation input-sm" class="form-control" required>
        </div>
    </div>
</script>

<script type="text/template" id="add-machine-tpl">
    <div class="row">
        <div class="form-group col-sm-4">
            <label>Serie</label>
            <input type="text" name="maquina_serie"  class="form-control input-sm input-toupper" placeholder="Serie" value="<%- maquina_serie %>" required>
        </div>
        <div class="form-group col-sm-4">
            <label>Ubicación</label>
            <input type="text" name="maquina_ubicacion"  class="form-control input-sm input-toupper" placeholder="Ubicación" value="<%- maquina_ubicacion %>" >
        </div>
        <div class="form-group col-sm-3">
            <label>Documentos</label>
            <input type="text" name="maquina_documentos"  class="form-control input-sm input-toupper" placeholder="Documentos" value="<%- maquina_documentos %>" >
        </div>
        <div class="form-group col-sm-1">
            <label>Casillas</label>
            <input type="number" name="maquina_casillas"  class="form-control input-sm" value="<%- maquina_casillas %>" >
        </div>
    </div>
    <div class="row">
        <div class="form-group col-sm-3">
            <label>Contacto</label>
            <input type="text" name="maquina_contacto"  class="form-control input-sm input-toupper" placeholder="Contacto" value="<%- maquina_contacto %>">
        </div>
        <div class="form-group col-sm-3">
            <label>Email</label>
            <input type="email" name="maquina_email"  class="form-control input-sm" placeholder="ejemplo@gmail.com" value="<%- maquina_email %>">
        </div>
        <div class="form-group col-sm-3">
            <label>Dirección</label>
            <input type="text" name="maquina_direccion"  class="form-control input-sm input-toupper" placeholder="Dirección" value="<%- maquina_direccion %>">
        </div>
        <div class="form-group col-sm-3">
            <label>Teléfono</label>
            <input type="text" name="maquina_telefono"  class="form-control input-sm" value="<%- maquina_telefono %>" data-inputmask="'mask': '(999) 999-99-99  EXT 999'" data-mask required>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-sm-3">
            <label>Servidor</label>
            <input type="text" name="maquina_servidor"  class="form-control input-sm" value="<%- maquina_servidor %>" data-inputmask="'alias': 'ip'" data-mask required >
        </div>
        <div class="form-group col-sm-3">
            <label>Usuario</label>
            <input type="text" name="maquina_usuario"  class="form-control input-sm" placeholder="Usuario" value="<%- maquina_usuario %>" required>
        </div>
        <div class="form-group col-sm-3">
            <label>Contraseña</label>
            <input type="password" name="maquina_contraseña"  class="form-control input-sm" value="<%- maquina_contraseña %>" <%- _.isUndefined(id) && _.isNull(id) && id === '' ? "required" : "" %> >
        </div>
        <div class="form-group col-sm-3">
            <label>Directorio</label>
            <input type="text" name="maquina_directorio"  class="form-control input-sm" placeholder="Directorio" value="<%- maquina_directorio %>" required>
        </div>
    </div>
</script>
